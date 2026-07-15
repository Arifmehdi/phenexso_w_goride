<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SosAlert;
use App\Models\User;
use App\Services\FcmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SosController extends Controller
{
    public function trigger(Request $request)
    {
        $request->validate([
            'ride_request_id' => 'nullable|integer',
            'latitude'        => 'nullable|numeric',
            'longitude'       => 'nullable|numeric',
        ]);

        $user = auth()->user();

        // Store alert
        $alert = SosAlert::create([
            'user_id'         => $user->id,
            'ride_request_id' => $request->ride_request_id,
            'latitude'        => $request->latitude,
            'longitude'       => $request->longitude,
            'status'          => 'active',
        ]);

        // Notify all admins via FCM
        $fcm = new FcmService();
        User::where('role', 'admin')->whereNotNull('fcm_token')->each(function ($admin) use ($fcm, $user, $alert) {
            $fcm->send(
                $admin->fcm_token,
                '🚨 SOS Alert!',
                "{$user->name} triggered SOS" . ($alert->latitude ? " at {$alert->latitude},{$alert->longitude}" : ''),
                ['type' => 'sos_alert', 'alert_id' => $alert->id, 'user_id' => $user->id]
            );
        });

        // Task 51: SMS to emergency contact
        $emergencyPhone = $user->emergency_contact_phone ?? null;
        $emergencyName  = $user->emergency_contact_name  ?? 'Emergency Contact';

        if ($emergencyPhone) {
            $this->sendEmergencySms($emergencyPhone, $user->name, $alert);
        }

        Log::warning("SOS triggered by user {$user->id} ({$user->name}) — alert #{$alert->id}");

        return response()->json([
            'success'       => true,
            'alert_id'      => $alert->id,
            'emergency_contact_name'  => $emergencyName,
            'emergency_contact_phone' => $emergencyPhone,
        ]);
    }

    public function resolve(Request $request, SosAlert $alert)
    {
        $alert->update([
            'status'      => 'resolved',
            'resolved_at' => now(),
            'notes'       => $request->notes,
        ]);

        return response()->json(['success' => true]);
    }

    // Admin: list active SOS alerts
    public function index()
    {
        $alerts = SosAlert::with('user:id,name,mobile,emergency_contact_name,emergency_contact_phone')
            ->orderByRaw("FIELD(status,'active','resolved')")
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json(['success' => true, 'alerts' => $alerts]);
    }

    private function sendEmergencySms(string $phone, string $userName, SosAlert $alert): void
    {
        $mapsLink = $alert->latitude
            ? "https://maps.google.com/?q={$alert->latitude},{$alert->longitude}"
            : 'Location unavailable';

        $message = "URGENT: {$userName} has triggered an SOS emergency alert on GoRide. "
                 . "Last known location: {$mapsLink} "
                 . "Please check on them immediately or call 999.";

        // TODO: Replace with real SMS gateway (SSL Wireless / Twilio)
        // SSL Wireless example:
        // Http::post('https://sms.sslwireless.com/pushapi/dynamic/server.php', [
        //     'api_token' => env('SMS_API_TOKEN'),
        //     'sid'       => env('SMS_SID'),
        //     'msisdn'    => '880' . ltrim($phone, '0'),
        //     'sms'       => $message,
        //     'csmsid'    => 'SOS_' . $alert->id,
        // ]);

        Log::info("SOS SMS to {$phone}: {$message}");
    }
}
