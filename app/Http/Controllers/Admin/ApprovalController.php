<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;

class ApprovalController extends Controller
{
    /**
     * Show pending approval requests.
     */
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');

        $query = User::query()->where(function($q) {
            $q->whereIn('status', ['pending', 0, '0', 'inactive'])
              ->orWhere(function($q2) {
                  $q2->where('is_approve', 0)
                     ->orWhere('is_approve', false);
              });
        })->orderBy('created_at', 'desc');

        if ($type !== 'all') {
            $query->where('role', $type);
        }

        $users = $query->paginate(20);

        // Add profile completion for each user
        $users->map(function($user) {
            $completionFields = $this->getCompletionFields($user);
            $filledCount = 0;
            foreach ($completionFields as $field) {
                if (!empty($user->{$field})) {
                    $filledCount++;
                }
            }
            $totalFields = count($completionFields);
            $user->profile_completion = $totalFields > 0 ? round(($filledCount / $totalFields) * 100) : 0;
            return $user;
        });

        // Get stats
        $stats = [
            'total_pending' => User::where(function($q) {
                $q->whereIn('status', ['pending', 0, '0', 'inactive'])
                  ->orWhere('is_approve', 0);
            })->count(),
            'pending_drivers' => User::where('role', 'driver')->where(function($q) {
                $q->whereIn('status', ['pending', 0, '0', 'inactive'])
                  ->orWhere('is_approve', 0);
            })->count(),
            'pending_corporates' => User::where('role', 'corporate')->where(function($q) {
                $q->whereIn('status', ['pending', 0, '0', 'inactive'])
                  ->orWhere('is_approve', 0);
            })->count(),
            'active_drivers' => User::where('role', 'driver')->where('status', 'active')->where('is_approve', true)->count(),
            'active_corporates' => User::where('role', 'corporate')->where('status', 'active')->where('is_approve', true)->count(),
        ];

        menuSubmenu('approvals', 'approvals');

        return view('admin.approvals.index', compact('users', 'stats'));
    }

    /**
     * Approve a user.
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->is_approve = true;
        $user->save();

        // Update related driver record if exists
        if ($user->role === 'driver' && $user->driver) {
            $user->driver->status = 'active';
            $user->driver->save();
        }

        return back()->with('success', $user->name . ' has been approved successfully.');
    }

    /**
     * Reject a user.
     */
    public function reject(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->is_approve = false;
        $user->save();

        if ($user->role === 'driver' && $user->driver) {
            $user->driver->status = 0;
            $user->driver->save();
        }

        $reason = $request->input('reason', '');
        $message = $user->name . ' has been rejected.';
        if ($reason) {
            $message .= ' Reason: ' . $reason;
        }

        return back()->with('success', $message);
    }

    private function getCompletionFields($user)
    {
        $fields = ['father_name', 'dob', 'nid', 'address', 'blood_group'];
        
        if ($user->role === 'driver') {
            $fields = array_merge($fields, ['license_no', 'vehicle_type']);
        }
        
        if ($user->role === 'corporate') {
            $fields = array_merge($fields, ['company_name', 'tin_number']);
        }

        return $fields;
    }
}
