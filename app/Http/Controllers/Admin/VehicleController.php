<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle; // Import the Vehicle model
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('vehicles', 'allVehicles');
        $vehicles = Vehicle::latest()->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('vehicles', 'createVehicle');
        $riders = \App\Models\User::where('role', 'rider')->get();
        return view('admin.vehicles.create', compact('riders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
            'plate_number' => 'required|string|max:255|unique:vehicles',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|numeric',
            'rider_id' => 'nullable|exists:users,id',
        ]);

        $vehicle = Vehicle::create($request->all());

        if ($request->rider_id) {
            $rider = \App\Models\User::find($request->rider_id);
            $rider->vehicle_id = $vehicle->id;
            $rider->save();
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $riders = \App\Models\User::where('role', 'rider')->get();
        return view('admin.vehicles.edit', compact('vehicle', 'riders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number,' . $vehicle->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|numeric',
            'rider_id' => 'nullable|exists:users,id',
        ]);

        $vehicle->update($request->all());

        // Update rider assignment
        if ($request->has('rider_id')) {
            // Remove vehicle from current rider(s) if any (optional, depends on if 1 vehicle can have many riders)
            // \App\Models\User::where('vehicle_id', $vehicle->id)->update(['vehicle_id' => null]);
            
            if ($request->rider_id) {
                $rider = \App\Models\User::find($request->rider_id);
                $rider->vehicle_id = $vehicle->id;
                $rider->save();
            }
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
