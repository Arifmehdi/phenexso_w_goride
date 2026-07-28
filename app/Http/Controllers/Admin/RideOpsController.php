<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\RideRequest;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use App\Models\SurgeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Ride-share operations pages for the WEB admin panel:
 * live rides, support tickets, reports, surge zones.
 * (The Flutter admin area has the same features via the API.)
 */
class RideOpsController extends Controller
{
    // ── Live rides ─────────────────────────────────────────────

    public function liveRides()
    {
        $rides = RideRequest::with(['user:id,name,mobile', 'driver:id,name,mobile,vehicle_type'])
            ->whereIn('status', ['accepted', 'arriving', 'in_progress'])
            ->orderByDesc('accepted_at')
            ->get();

        return view('admin.ride_ops.live_rides', compact('rides'));
    }

    // ── Support tickets ────────────────────────────────────────

    public function tickets(Request $request)
    {
        $query = SupportTicket::withCount('replies')->orderByDesc('created_at');
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        $tickets = $query->paginate(20)->withQueryString();

        return view('admin.ride_ops.tickets', compact('tickets'));
    }

    public function ticketShow($id)
    {
        $ticket = SupportTicket::with('replies')->findOrFail($id);
        return view('admin.ride_ops.ticket_show', compact('ticket'));
    }

    public function ticketReply(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:2000']);
        $ticket = SupportTicket::findOrFail($id);

        SupportTicketReply::create([
            'ticket_id'   => $ticket->id,
            'sender_id'   => auth()->id(),
            'sender_type' => 'admin',
            'message'     => $request->message,
        ]);
        if ($ticket->status === 'open') {
            $ticket->update(['status' => 'in_progress']);
        }

        return back()->with('success', 'Reply sent.');
    }

    public function ticketStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:open,in_progress,resolved,closed']);
        SupportTicket::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Ticket status updated.');
    }

    // ── Reports ────────────────────────────────────────────────

    public function reports(Request $request)
    {
        $from = $request->filled('from')
            ? Carbon::parse($request->from)->startOfDay()
            : Carbon::now()->subDays(30)->startOfDay();
        $to = $request->filled('to')
            ? Carbon::parse($request->to)->endOfDay()
            : Carbon::now()->endOfDay();

        $completed = RideRequest::where('status', 'completed')
            ->whereBetween('completed_at', [$from, $to]);

        $totalRevenue = (float) (clone $completed)->sum('fare');
        $totalTrips   = (clone $completed)->count();

        $daily = (clone $completed)
            ->selectRaw("DATE_FORMAT(completed_at, '%Y-%m-%d') as period, SUM(fare) as revenue, COUNT(*) as trips")
            ->groupBy('period')->orderBy('period')->get();

        $byStatus = RideRequest::whereBetween('created_at', [$from, $to])
            ->selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status');

        $topDriverRows = (clone $completed)
            ->whereNotNull('driver_id')
            ->selectRaw('driver_id, COUNT(*) as trips, SUM(fare) as earnings')
            ->groupBy('driver_id')->orderByDesc('earnings')->limit(10)->get();
        $driverNames = Driver::whereIn('id', $topDriverRows->pluck('driver_id'))
            ->pluck('name', 'id');

        return view('admin.ride_ops.reports', [
            'from' => $from, 'to' => $to,
            'totalRevenue' => $totalRevenue,
            'totalTrips'   => $totalTrips,
            'daily'        => $daily,
            'byStatus'     => $byStatus,
            'topDrivers'   => $topDriverRows,
            'driverNames'  => $driverNames,
        ]);
    }

    // ── Driver payouts ─────────────────────────────────────────

    public function payouts()
    {
        // Reuse the API's dues computation (it upserts pending rows), then
        // render the same data server-side for the web panel.
        $data = app(\App\Http\Controllers\Api\DriverPayoutController::class)
            ->pending()->getData(true);

        return view('admin.ride_ops.payouts', [
            'totalPending' => (float) ($data['total_pending'] ?? 0),
            'payouts'      => $data['payouts'] ?? [],
        ]);
    }

    public function payoutProcess(Request $request)
    {
        $res = app(\App\Http\Controllers\Api\DriverPayoutController::class)
            ->process($request);
        $body = $res->getData(true);

        return back()->with(
            ($body['success'] ?? false) ? 'success' : 'error',
            ($body['success'] ?? false) ? 'Payout sent to driver wallet.' : ($body['message'] ?? 'Payout failed.')
        );
    }

    public function payoutsExport()
    {
        $payouts = \App\Models\DriverPayout::with('driver:id,name,mobile')
            ->orderByDesc('created_at')->get();

        $filename = 'driver-payouts-' . now()->format('Ymd-His') . '.csv';
        return response()->streamDownload(function () use ($payouts) {
            $h = fopen('php://output', 'w');
            fputcsv($h, ['Payout ID', 'Driver', 'Mobile', 'Period From', 'Period To', 'Gross', 'Commission', 'Net', 'Status', 'Paid At']);
            foreach ($payouts as $p) {
                fputcsv($h, [
                    $p->id, $p->driver?->name, $p->driver?->mobile,
                    $p->period_from, $p->period_to,
                    $p->gross_earnings, $p->commission, $p->net_amount,
                    $p->status, $p->paid_at,
                ]);
            }
            fclose($h);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    // ── SOS alerts (live map) ──────────────────────────────────

    public function sos()
    {
        $alerts = \App\Models\SosAlert::with('user:id,name,mobile,emergency_contact_name,emergency_contact_phone')
            ->orderByRaw("FIELD(status,'active','resolved')")
            ->orderByDesc('created_at')
            ->take(100)
            ->get();

        // Points with coordinates, for the map markers.
        $points = $alerts->filter(fn ($a) => $a->latitude && $a->longitude)
            ->map(fn ($a) => [
                'id'     => $a->id,
                'lat'    => (float) $a->latitude,
                'lng'    => (float) $a->longitude,
                'name'   => $a->user->name ?? 'Unknown',
                'mobile' => $a->user->mobile ?? '',
                'status' => $a->status,
                'time'   => $a->created_at->format('d M H:i'),
            ])->values();

        return view('admin.ride_ops.sos', compact('alerts', 'points'));
    }

    public function sosResolve($id)
    {
        $alert = \App\Models\SosAlert::findOrFail($id);
        $alert->update(['status' => 'resolved', 'resolved_at' => now()]);
        return back()->with('success', 'SOS alert marked resolved.');
    }

    // ── Surge zones ────────────────────────────────────────────

    public function surgeIndex()
    {
        $zones = SurgeZone::orderByDesc('created_at')->get();
        return view('admin.ride_ops.surge', compact('zones'));
    }

    public function surgeStore(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'center_lat' => 'required|numeric',
            'center_lng' => 'required|numeric',
            'radius_km'  => 'nullable|integer|min:1|max:50',
            'multiplier' => 'required|numeric|min:1|max:5',
        ]);

        SurgeZone::create([
            'name'       => $request->name,
            'center_lat' => $request->center_lat,
            'center_lng' => $request->center_lng,
            'radius_km'  => $request->radius_km ?? 3,
            'multiplier' => $request->multiplier,
            'is_active'  => true,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Surge zone created.');
    }

    public function surgeToggle($id)
    {
        $zone = SurgeZone::findOrFail($id);
        $zone->update(['is_active' => !$zone->is_active]);
        return back()->with('success', 'Surge zone ' . ($zone->is_active ? 'activated' : 'deactivated') . '.');
    }

    /**
     * Rewards & Referrals — the settings that drive point/bonus maths, plus a
     * leaderboard of who is actually inviting people.
     */
    public function rewards()
    {
        $ref = \App\Http\Controllers\Api\ReferralController::class;

        $settings = [
            'taka_per_point' => $ref::takaPerPoint(),
            'referral_bonus' => $ref::referralBonus(),
            'referee_bonus'  => $ref::refereeBonus(),
        ];

        // Top referrers across BOTH riders and drivers. Counted with a grouped
        // query so we don't need a relationship on the model.
        $riderCounts = \App\Models\User::whereNotNull('referred_by')
            ->where(function ($q) {
                $q->where('referred_by_type', 'user')->orWhereNull('referred_by_type');
            })
            ->selectRaw('referred_by, COUNT(*) as c')
            ->groupBy('referred_by')->pluck('c', 'referred_by');

        $topRiders = \App\Models\User::whereIn('id', $riderCounts->keys())
            ->get(['id', 'name', 'mobile', 'referral_code'])
            ->map(fn ($u) => (object) [
                'name' => $u->name, 'mobile' => $u->mobile, 'role' => 'Rider',
                'code' => $u->referral_code, 'count' => (int) ($riderCounts[$u->id] ?? 0),
            ]);

        $topDrivers = collect();
        if (\Schema::hasColumn('drivers', 'referral_code')) {
            $topDrivers = \App\Models\Driver::whereNotNull('referral_code')
                ->take(200)->get(['id', 'name', 'mobile', 'referral_code'])
                ->map(function ($d) {
                    $count = \App\Models\Driver::where('referred_by', $d->id)
                        ->where('referred_by_type', 'driver')->count()
                        + \App\Models\User::where('referred_by', $d->id)
                            ->where('referred_by_type', 'driver')->count();
                    return (object) [
                        'name' => $d->name, 'mobile' => $d->mobile, 'role' => 'Driver',
                        'code' => $d->referral_code, 'count' => $count,
                    ];
                })->filter(fn ($d) => $d->count > 0);
        }

        $leaders = $topRiders->concat($topDrivers)
            ->sortByDesc('count')->take(20)->values();

        // Programme totals.
        $stats = [
            'total_referred'  => \App\Models\User::whereNotNull('referred_by')->count()
                + (\Schema::hasColumn('drivers', 'referred_by')
                    ? \App\Models\Driver::whereNotNull('referred_by')->count() : 0),
            'total_credited'  => \App\Models\User::where('referral_credited', true)->count(),
        ];
        $stats['bonus_paid'] = $stats['total_credited']
            * ($settings['referral_bonus'] + $settings['referee_bonus']);

        return view('admin.ride_ops.rewards', compact('settings', 'leaders', 'stats'));
    }

    /** Saves the rewards/referral settings. */
    public function rewardsSave(Request $request)
    {
        $request->validate([
            'taka_per_point' => 'required|numeric|min:1',
            'referral_bonus' => 'required|numeric|min:0',
            'referee_bonus'  => 'required|numeric|min:0',
        ]);

        foreach (['taka_per_point', 'referral_bonus', 'referee_bonus'] as $key) {
            \App\Models\AppSetting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) $request->input($key)]
            );
        }

        return back()->with('success', 'Rewards settings saved.');
    }
}
