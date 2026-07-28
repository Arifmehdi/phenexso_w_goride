<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Corporate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CorporateController extends Controller
{
    public function index()
    {
        menuSubmenu('corporates', 'allCorporates');
        $corporates = Corporate::latest()->paginate(10);
        return view('admin.corporates.index', compact('corporates'));
    }

    public function create()
    {
        menuSubmenu('corporates', 'createCorporate');
        return view('admin.corporates.create');
    }

    /**
     * One company's account: their trips, this month's bill, and the staff
     * they book for. `corporate_id` is the only safe way to scope these —
     * corporates have their own id space, separate from users.
     */
    public function show(Corporate $corporate, Request $request)
    {
        menuSubmenu('corporates', 'allCorporates');

        $month = $request->get('month', now()->format('Y-m'));
        $start = \Illuminate\Support\Carbon::parse($month . '-01')->startOfMonth();
        $end   = (clone $start)->endOfMonth();

        $rides = \App\Models\RideRequest::where('corporate_id', $corporate->id)
            ->whereBetween('created_at', [$start, $end])
            ->orderByDesc('created_at')
            ->get();

        $driverNames = \App\Models\Driver::whereIn('id', $rides->pluck('driver_id')->filter()->unique())
            ->pluck('name', 'id');

        $employees = \App\Models\CorporateEmployee::where('corporate_id', $corporate->id)
            ->orderBy('name')->get();

        $stats = [
            'month_rides'  => $rides->count(),
            'month_total'  => (float) $rides->sum('fare'),
            'unpaid'       => (float) $rides->where('payment_status', '!=', 'paid')->sum('fare'),
            'all_time'     => (float) \App\Models\RideRequest::where('corporate_id', $corporate->id)
                                ->where('status', 'completed')->sum('fare'),
        ];

        return view('admin.corporates.show', compact(
            'corporate', 'rides', 'employees', 'stats', 'month', 'driverNames'
        ));
    }

    /** Marks a company's completed-but-unpaid trips as settled for a month. */
    public function settleBills(Corporate $corporate, Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $start = \Illuminate\Support\Carbon::parse($month . '-01')->startOfMonth();
        $end   = (clone $start)->endOfMonth();

        $count = \App\Models\RideRequest::where('corporate_id', $corporate->id)
            ->where('status', 'completed')
            ->where(function ($q) {
                $q->where('payment_status', '!=', 'paid')->orWhereNull('payment_status');
            })
            ->whereBetween('created_at', [$start, $end])
            ->update(['payment_status' => 'paid']);

        return back()->with('success', "Marked {$count} trip(s) as paid for {$month}.");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:corporates',
            'mobile' => 'required|string|max:20|unique:corporates',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:500',
        ]);

        Corporate::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'status' => 'active',
        ]);

        return redirect()->route('admin.corporates.index')->with('success', 'Corporate user created successfully.');
    }

    public function edit(Corporate $corporate)
    {
        menuSubmenu('corporates', 'allCorporates');
        return view('admin.corporates.edit', compact('corporate'));
    }

    public function update(Request $request, Corporate $corporate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:corporates,email,' . $corporate->id,
            'mobile' => 'required|string|max:20|unique:corporates,mobile,' . $corporate->id,
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string|max:500',
            'status' => 'required|string|in:active,pending,inactive',
        ]);

        $data = $request->only(['name', 'company_name', 'email', 'mobile', 'address', 'status']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $corporate->update($data);

        return redirect()->route('admin.corporates.index')->with('success', 'Corporate user updated successfully.');
    }

    public function destroy(Corporate $corporate)
    {
        $corporate->delete();
        return redirect()->route('admin.corporates.index')->with('success', 'Corporate user deleted successfully.');
    }
}
