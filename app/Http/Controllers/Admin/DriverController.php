<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('drivers', 'allDrivers');
        $drivers = Driver::latest()->paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('drivers', 'createDriver');
        $vehicles = \App\Models\Vehicle::where('status', 1)->get();
        return view('admin.drivers.create', compact('vehicles'));
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
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|unique:drivers',
            'email' => 'nullable|string|email|max:255|unique:drivers',
            'password' => 'required|string|min:8|confirmed',
            'license_no' => 'nullable|string|max:255',
            'nid' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'status' => 'required|integer|in:0,1',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Driver::create($data);

        return redirect()->route('admin.drivers.index')
                        ->with('success', 'Driver created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        menuSubmenu('drivers', 'allDrivers');
        $vehicles = \App\Models\Vehicle::where('status', 1)->get();
        return view('admin.drivers.edit', compact('driver', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|unique:drivers,mobile,' . $driver->id,
            'email' => 'nullable|string|email|max:255|unique:drivers,email,' . $driver->id,
            'password' => 'nullable|string|min:8|confirmed',
            'license_no' => 'nullable|string|max:255',
            'nid' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'status' => 'required|integer|in:0,1',
        ]);

        $data = $request->except(['password', 'password_confirmation']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully.');
    }
}

