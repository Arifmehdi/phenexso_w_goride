<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverProfileController extends Controller
{
    /**
     * Fields that count toward profile completion, grouped by step.
     * 'image' => true means it is stored as a file path.
     */
    private array $steps = [
        'personal' => [
            'father_name', 'mother_name', 'dob', 'blood_group', 'present_address',
            'permanent_address', 'emergency_contact_name', 'emergency_contact_phone',
        ],
        'nid' => [
            'nid', 'nid_front_image', 'nid_back_image',
        ],
        'license' => [
            'license_no', 'license_image', 'license_expiry',
        ],
        'vehicle' => [
            'vehicle_type', 'vehicle_model', 'vehicle_plate', 'vehicle_color', 'vehicle_year',
        ],
        'photo' => [
            'profile_image',
        ],
    ];

    private array $imageFields = [
        'profile_image', 'nid_front_image', 'nid_back_image', 'license_image',
    ];

    private function driver(): ?Driver
    {
        $user = auth()->user();
        if ($user instanceof Driver) return $user;
        // Fallback: linked driver row
        return Driver::where('user_id', $user->id ?? 0)->first();
    }

    public function status()
    {
        $driver = $this->driver();
        if (!$driver) {
            return response()->json(['success' => false, 'message' => 'Driver profile not found'], 404);
        }

        $this->recompute($driver);

        $stepStatus = [];
        foreach ($this->steps as $step => $fields) {
            $filled = 0;
            foreach ($fields as $f) {
                if ($this->filled($driver->{$f})) $filled++;
            }
            $stepStatus[$step] = [
                'total'    => count($fields),
                'filled'   => $filled,
                'complete' => $filled === count($fields),
            ];
        }

        return response()->json([
            'success' => true,
            'profile_completion'  => $driver->profile_completion,
            'verification_status' => $driver->verification_status,
            'rejection_reason'    => $driver->rejection_reason,
            'steps'   => $stepStatus,
            'data'    => $this->presentData($driver),
        ]);
    }

    public function update(Request $request)
    {
        $driver = $this->driver();
        if (!$driver) {
            return response()->json(['success' => false, 'message' => 'Driver profile not found'], 404);
        }

        // Text fields
        $textFields = [
            'father_name', 'mother_name', 'dob', 'blood_group', 'present_address', 'permanent_address',
            'emergency_contact_name', 'emergency_contact_phone', 'nid', 'license_no',
            'license_expiry', 'vehicle_type', 'vehicle_model', 'vehicle_plate',
            'vehicle_color', 'vehicle_year',
        ];

        foreach ($textFields as $f) {
            if ($request->filled($f)) {
                $driver->{$f} = $request->input($f);
            }
        }

        // Image uploads
        foreach ($this->imageFields as $f) {
            if ($request->hasFile($f)) {
                // Delete old file
                if ($driver->{$f} && Storage::disk('public')->exists($driver->{$f})) {
                    Storage::disk('public')->delete($driver->{$f});
                }
                $path = $request->file($f)->store("driver-verification/{$driver->id}", 'public');
                $driver->{$f} = $path;
            }
        }

        $driver->save();
        $this->recompute($driver);

        return response()->json([
            'success' => true,
            'message' => 'Profile saved',
            'profile_completion'  => $driver->profile_completion,
            'verification_status' => $driver->verification_status,
            'data' => $this->presentData($driver),
        ]);
    }

    /** Recalculate completion %, auto-move to 'pending' review at 100%. */
    private function recompute(Driver $driver): void
    {
        $total = 0;
        $filled = 0;
        foreach ($this->steps as $fields) {
            foreach ($fields as $f) {
                $total++;
                if ($this->filled($driver->{$f})) $filled++;
            }
        }
        $pct = $total > 0 ? (int) round(($filled / $total) * 100) : 0;

        $driver->profile_completion = $pct;

        // Don't override admin decisions (verified/rejected)
        if (!in_array($driver->verification_status, ['verified', 'rejected'])) {
            $driver->verification_status = $pct >= 100 ? 'pending' : 'incomplete';
        }
        $driver->saveQuietly();
    }

    private function filled($value): bool
    {
        return $value !== null && trim((string) $value) !== '';
    }

    /** Return data with image fields as full URLs. */
    private function presentData(Driver $driver): array
    {
        $out = [];
        foreach ($this->steps as $fields) {
            foreach ($fields as $f) {
                $val = $driver->{$f};
                if (in_array($f, $this->imageFields) && $val) {
                    $out[$f] = asset('storage/' . $val);
                } else {
                    $out[$f] = $val;
                }
            }
        }
        return $out;
    }

    // ── Admin ──

    public function verificationList(Request $request)
    {
        $query = Driver::query()->select([
            'id', 'name', 'mobile', 'email', 'profile_completion',
            'verification_status', 'license_no', 'nid', 'created_at',
        ]);

        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

        $drivers = $query->orderByDesc('created_at')->paginate(20);
        return response()->json(['success' => true, 'drivers' => $drivers]);
    }

    public function adminShow(Driver $driver)
    {
        return response()->json([
            'success' => true,
            'driver'  => $driver,
            'data'    => $this->presentData($driver),
            'profile_completion' => $driver->profile_completion,
            'verification_status' => $driver->verification_status,
        ]);
    }

    public function review(Request $request, Driver $driver)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'reason' => 'required_if:status,rejected|nullable|string',
        ]);

        $driver->verification_status = $request->status;
        $driver->rejection_reason = $request->status === 'rejected' ? $request->reason : null;

        // Activate driver account on verification (status 1 = available)
        if ($request->status === 'verified') {
            $driver->status = 1;
        }
        $driver->save();

        return response()->json(['success' => true]);
    }
}
