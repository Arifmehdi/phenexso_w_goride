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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'mobile' => 'required|string|max:20|unique:drivers',
        //     'email' => 'nullable|string|email|max:255|unique:drivers',
        //     'password' => 'required|string|min:8|confirmed',
        //     'license_no' => 'nullable|string|max:255',
        //     'nid' => 'nullable|string|max:255',
        //     'address' => 'nullable|string|max:500',
        //     'status' => 'required|integer|in:0,1',
        // ]);

        // $data = $request->all();

        $request->validate($this->rules());

        // Only keep columns that actually exist on the table (migration-safe)
        $data = $this->filterToColumns($request->except([
            'password', 'password_confirmation', '_token',
            'profile_image', 'nid_front_image', 'nid_back_image', 'license_image',
        ]));
        
        $data['password'] = Hash::make($request->password);

        $driver = Driver::create($data);

        $this->handleImages($request, $driver);
        $driver->recalcCompletion();

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
        $request->validate($this->rules($driver->id, false));

        $data = $this->filterToColumns($request->except([
            'password', 'password_confirmation', '_token', '_method',
            'profile_image', 'nid_front_image', 'nid_back_image', 'license_image',
        ]));
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $driver->update($data);

        $this->handleImages($request, $driver);
        $driver->recalcCompletion();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    /** Shared validation rules. */
    private function rules($ignoreId = null, bool $passwordRequired = true): array
    {
        $unique = $ignoreId ? ',' . $ignoreId : '';
        return [
            'name'        => 'required|string|max:255',
            'mobile'      => 'required|string|max:20|unique:drivers,mobile' . $unique,
            'email'       => 'nullable|string|email|max:255|unique:drivers,email' . $unique,
            'password'    => ($passwordRequired ? 'required' : 'nullable') . '|string|min:8|confirmed',
            'status'      => 'required|integer|in:0,1',
            // Optional verification fields
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'dob'         => 'nullable|date',
            'blood_group' => 'nullable|string|max:5',
            'present_address'   => 'nullable|string|max:500',
            'permanent_address' => 'nullable|string|max:500',
            'emergency_contact_name'  => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'license_no'     => 'nullable|string|max:255',
            'license_expiry' => 'nullable|date',
            'nid'            => 'nullable|string|max:255',
            'vehicle_type'   => 'nullable|string|max:50',
            'vehicle_model'  => 'nullable|string|max:100',
            'vehicle_plate'  => 'nullable|string|max:50',
            'vehicle_color'  => 'nullable|string|max:50',
            'vehicle_year'   => 'nullable|string|max:4',
            'profile_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'nid_front_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'nid_back_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'license_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ];
    }

    /** Keep only keys that map to existing columns on the drivers table. */
    private function filterToColumns(array $data): array
    {
        $cols = \Schema::getColumnListing('drivers');
        return array_intersect_key($data, array_flip($cols));
    }

    /** Store any uploaded document/photo images on the driver. */
    private function handleImages(Request $request, Driver $driver): void
    {
        foreach (['profile_image', 'nid_front_image', 'nid_back_image', 'license_image'] as $field) {
            if (!\Schema::hasColumn('drivers', $field)) continue;
            if ($request->hasFile($field)) {
                if ($driver->{$field} && \Storage::disk('public')->exists($driver->{$field})) {
                    \Storage::disk('public')->delete($driver->{$field});
                }
                $driver->{$field} = $request->file($field)->store("driver-verification/{$driver->id}", 'public');
            }
        }
        $driver->save();
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

    /**
     * Approve / disapprove a driver directly from the list (AJAX switch).
     */
    public function toggleStatus(Request $request, Driver $driver)
    {
        $approve = $request->boolean('approve');

        $hasVeriCol = \Schema::hasColumn('drivers', 'verification_status');

        if ($approve) {
            $driver->status = 1; // active / available
            if ($hasVeriCol) {
                $driver->verification_status = 'verified';
                $driver->rejection_reason = null;
            }
        } else {
            $driver->status = 0; // inactive
            if ($hasVeriCol) {
                if ($request->filled('reason')) {
                    // Explicit rejection with a reason (from verification page)
                    $driver->verification_status = 'rejected';
                    $driver->rejection_reason = $request->input('reason');
                } elseif ($driver->verification_status === 'verified') {
                    $driver->verification_status = 'pending';
                }
            }
        }
        $driver->save();

        // Notify the driver (in-app inbox + FCM push)
        if ($approve) {
            notify()->toDriver($driver, '✅ Account Approved',
                'Congratulations! Your account has been verified. You can now go online and accept rides.',
                'account_approved');
        } else {
            notify()->toDriver($driver, 'Account Set Inactive',
                $driver->rejection_reason
                    ? "Your account needs attention: {$driver->rejection_reason}"
                    : 'Your account has been set to inactive. Please contact support.',
                'account_inactive');
        }

        return response()->json([
            'success' => true,
            'approved' => $approve,
            'message' => $approve
                ? "{$driver->name} has been approved and can now go online."
                : "{$driver->name} has been set to inactive.",
        ]);
    }

    /**
     * Show a driver's full verification details (documents + profile).
     */
    public function verification(Driver $driver)
    {
        menuSubmenu('drivers', 'allDrivers');
        return view('admin.drivers.verification', compact('driver'));
    }
}

