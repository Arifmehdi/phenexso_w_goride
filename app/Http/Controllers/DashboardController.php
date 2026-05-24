<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin,driver,corporate');
    }

    public function index()
    {
        // 1. Check specialized guards first
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('corporate')->check()) {
            return redirect()->route('corporate.dashboard');
        }
        if (Auth::guard('driver')->check()) {
            return redirect()->route('driver.dashboard');
        }

        // 2. Fallback to web guard (User model)
        $user = Auth::guard('web')->user();

        if ($user) {
            // Check roles in the User table
            if ($user->hasRole('admin') || $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            switch ($user->role) {
                case 'corporate':
                    return redirect()->route('corporate.dashboard');
                case 'owner':
                    return redirect()->route('owner.dashboard');
                case 'driver':
                    return redirect()->route('driver.dashboard');
                case 'solo':
                case 'user':
                    return view('goride.user.dashboard');
                default:
                    // If no specific role, default to user dashboard
                    return view('goride.user.dashboard');
            }
        }

        return redirect()->route('login');
    }

    // --- Corporate Dashboard Methods ---
    
    public function corporateDashboard()
    {
        return view('goride.corporate.dashboard');
    }

    public function corporateFleet()
    {
        return view('goride.corporate.fleet');
    }

    public function corporateBilling()
    {
        return view('goride.corporate.billing');
    }

    public function corporateNewRequest()
    {
        return view('goride.corporate.new-request');
    }

    public function corporateHistory()
    {
        return view('goride.corporate.history');
    }

    public function corporateSettings()
    {
        return view('goride.corporate.settings');
    }

    // --- Owner Dashboard Methods ---

    public function ownerDashboard()
    {
        return view('goride.owner.dashboard');
    }

    public function ownerCars()
    {
        return view('goride.owner.cars');
    }

    public function ownerHistory()
    {
        return view('goride.owner.history');
    }

    public function ownerEarnings()
    {
        return view('goride.owner.earnings');
    }

    public function ownerProfile()
    {
        return view('goride.owner.profile');
    }

    public function ownerDocuments()
    {
        return view('goride.owner.documents');
    }

    public function driverDashboard()
    {
        // Drivers typically use the same UI as owners but with restricted data
        return view('goride.owner.dashboard');
    }

    // --- User (Solo) Specific Methods ---

    public function userTrips()
    {
        return view('goride.user.trips');
    }

    public function userSavedPlaces()
    {
        return view('goride.user.saved-places');
    }
}
