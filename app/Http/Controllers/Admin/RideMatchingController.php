<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use Illuminate\Http\Request;

class RideMatchingController extends Controller
{
    /**
     * Display a paginated list of all ride requests with their offer statistics.
     */
    public function index(Request $request)
    {
        menuSubmenu('ride_matching', 'rideMatching');

        $status = $request->query('status', 'all');

        // Load offers normally (don't aggregate via eager load grouping — 
        // that breaks Laravel's model hydration). Count in the view instead.
        $query = RideRequest::with([
            'user:id,name,mobile',
            'driver:id,name,mobile',
            'offers',
        ]);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $rides = $query->orderBy('created_at', 'desc')->paginate(20);

        // Build stats cards
        $stats = [
            'total' => RideRequest::count(),
            'pending' => RideRequest::where('status', 'pending')->count(),
            'accepted' => RideRequest::where('status', 'accepted')->count(),
            'completed' => RideRequest::where('status', 'completed')->count(),
            'cancelled' => RideRequest::where('status', 'cancelled')->count(),
        ];

        return view('admin.ride-matching.index', compact('rides', 'stats', 'status'));
    }

    /**
     * Show detailed offer timeline for a specific ride.
     */
    public function show($id)
    {
        menuSubmenu('ride_matching', 'rideMatching');

        $ride = RideRequest::with([
            'user:id,name,mobile,email',
            'driver:id,name,mobile',
            'offers' => function ($q) {
                $q->with('driver:id,name,mobile')
                  ->orderBy('priority_order');
            },
        ])->findOrFail($id);

        return view('admin.ride-matching.show', compact('ride'));
    }
}
