<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminApprovalController extends Controller
{
    private function checkAdmin($user)
    {
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized: Admin access required');
        }
    }

    public function pendingApprovals(Request $request)
    {
        $this->checkAdmin($request->user());

        $type = $request->query('type', 'all');
        $query = User::query();

        if ($type !== 'all') {
            $query->where('role', $type);
        }

        $pendingUsers = $query->where(function ($q) {
            $q->whereIn('status', ['pending', 0, '0', 'inactive'])
              ->orWhere(function ($q2) {
                  $q2->where('is_approve', 0)
                     ->orWhere('is_approve', false);
              });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        $users = collect($pendingUsers->items())->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'role' => $user->role,
                'status' => $user->status,
                'is_approve' => (bool) $user->is_approve,
                'vehicle_type' => $user->vehicle_type,
                'company_name' => $user->company_name,
                'created_at' => $user->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'pending_users' => $users,
            'pagination' => [
                'current_page' => $pendingUsers->currentPage(),
                'last_page' => $pendingUsers->lastPage(),
                'per_page' => $pendingUsers->perPage(),
                'total' => $pendingUsers->total(),
            ],
        ]);
    }

    public function approveReject(Request $request, $id)
    {
        $this->checkAdmin($request->user());

        $request->validate([
            'action' => 'required|in:approve,reject,suspend',
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $action = $request->input('action');

        switch ($action) {
            case 'approve':
                $user->status = 'active';
                $user->is_approve = true;
                $message = 'User approved successfully';
                break;
            case 'reject':
                $user->status = 'rejected';
                $user->is_approve = false;
                $message = 'User rejected';
                break;
            case 'suspend':
                $user->status = 'suspended';
                $user->is_approve = false;
                $message = 'User suspended';
                break;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => $message,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'status' => $user->status,
                'is_approve' => (bool) $user->is_approve,
            ],
        ]);
    }

    public function stats(Request $request)
    {
        $this->checkAdmin($request->user());

        $pendingDrivers = User::where('role', 'driver')
            ->where(function ($q) {
                $q->whereIn('status', ['pending', 0, '0', 'inactive'])
                  ->orWhere('is_approve', 0);
            })->count();

        $pendingCorporates = User::where('role', 'corporate')
            ->where(function ($q) {
                $q->whereIn('status', ['pending', 0, '0', 'inactive'])
                  ->orWhere('is_approve', 0);
            })->count();

        $activeDrivers = User::where('role', 'driver')
            ->where('status', 'active')
            ->where('is_approve', true)
            ->count();

        $activeCorporates = User::where('role', 'corporate')
            ->where('status', 'active')
            ->where('is_approve', true)
            ->count();

        return response()->json([
            'success' => true,
            'stats' => [
                'pending_drivers' => $pendingDrivers,
                'pending_corporates' => $pendingCorporates,
                'total_pending' => $pendingDrivers + $pendingCorporates,
                'active_drivers' => $activeDrivers,
                'active_corporates' => $activeCorporates,
            ],
        ]);
    }
}
