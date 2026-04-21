<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleAssignment; // Import the model
use App\Models\Vehicle; // Import Vehicle model
use App\Models\Driver;   // Import Driver model
use App\Models\Product;  // Import Product model
use App\Models\User;     // Import User model (for farmer)
use Illuminate\Http\Request;

class VehicleAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('vehicle_assignments', 'allVehicleAssignments');
        $vehicleAssignments = VehicleAssignment::with(['vehicle', 'driver', 'product', 'farmer'])->latest()->paginate(10);
        return view('admin.vehicle_assignments.index', compact('vehicleAssignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('vehicle_assignments', 'createVehicleAssignment');

        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $products = Product::all();
        $farmers = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'farmer'); // Assuming a 'farmer' role
        })->get();
        return view('admin.vehicle_assignments.create', compact('vehicles', 'drivers', 'products', 'farmers'));
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
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'product_id' => 'required|exists:products,id',
            'farmer_id' => 'required|exists:users,id',
            'quantity' => 'required|numeric|min:0',
            'delivery_location' => 'required|string|max:255',
            'delivery_time' => 'required|date',
            'status' => 'required|integer|in:1,2,3', // 1=assigned, 2=on_the_way, 3=delivered
        ]);

        VehicleAssignment::create($request->all());

        return redirect()->route('admin.vehicle_assignments.index')->with('success', 'Vehicle assignment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleAssignment  $vehicleAssignment
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleAssignment $vehicleAssignment)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $products = Product::all();
        $farmers = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'farmer');
        })->get();
        return view('admin.vehicle_assignments.edit', compact('vehicleAssignment', 'vehicles', 'drivers', 'products', 'farmers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleAssignment  $vehicleAssignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleAssignment $vehicleAssignment)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'product_id' => 'required|exists:products,id',
            'farmer_id' => 'required|exists:users,id',
            'quantity' => 'required|numeric|min:0',
            'delivery_location' => 'required|string|max:255',
            'delivery_time' => 'required|date',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $vehicleAssignment->update($request->all());

        return redirect()->route('admin.vehicle_assignments.index')->with('success', 'Vehicle assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleAssignment  $vehicleAssignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleAssignment $vehicleAssignment)
    {
        $vehicleAssignment->delete();
        return redirect()->route('admin.vehicle_assignments.index')->with('success', 'Vehicle assignment deleted successfully.');
    }
}
