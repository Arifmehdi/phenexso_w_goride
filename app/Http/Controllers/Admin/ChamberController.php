<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChamberLocation;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ChamberController extends Controller
{
    public function index()
    {
        menuSubmenu('chambers','allchambers');
        $chambers = ChamberLocation::latest()->paginate(10);
        return view('admin.chambers.index', compact('chambers'));
    }

    public function create()
    {
        menuSubmenu('chambers','createchambers');
        $doctors = Doctor::get();
        return view('admin.chambers.create',compact('doctors'));
    }

    public function store(Request $request)
    {
        menuSubmenu('chambers','createchambers');

        $request->validate([
            'doctor_id'     => 'required|exists:doctors,id',
            'chamber_title' => 'required|string|max:255',
            'address'       => 'required|string',
            'day'           => 'required|array',
            'day.*'         => 'required|string',
            'time'          => 'required|array',
            'time.*'        => 'required|string',
        ]);

        $schedules = [];
        foreach ($request->day as $index => $day) {
            $schedules[] = [
                'day'  => $day,
                'time' => $request->time[$index],
            ];
        }

        ChamberLocation::create([
            'doctor_id'     => $request->doctor_id,
            'chamber_title' => $request->chamber_title,
            'schedules'     => $schedules,
            'address'       => $request->address,
        ]);

        return redirect()->route('chambers.index')->with('success', 'Chamber created successfully.');
    }


    public function edit(ChamberLocation $chamber)
    {
        menuSubmenu('chambers','createchambers');
        $doctors = Doctor::all();
        return view('admin.chambers.edit', compact('chamber', 'doctors'));
    }

    public function update(Request $request, ChamberLocation $chamber)
    {
        menuSubmenu('chambers','createchambers');

        $request->validate([
            'doctor_id'     => 'required|exists:doctors,id',
            'chamber_title' => 'required|string|max:255',
            'address'       => 'required|string',
            'day'           => 'required|array',
            'day.*'         => 'required|string',
            'time'          => 'required|array',
            'time.*'        => 'required|string',
        ]);

        $schedules = [];
        foreach ($request->day as $index => $day) {
            $schedules[] = [
                'day'  => $day,
                'time' => $request->time[$index],
            ];
        }

        $chamber->update([
            'doctor_id'     => $request->doctor_id,
            'chamber_title' => $request->chamber_title,
            'schedules'     => $schedules,
            'address'       => $request->address,
        ]);

        return redirect()->route('chambers.index')->with('success', 'Chamber updated successfully.');
    }

    public function destroy(ChamberLocation $chamber)
    {
        $chamber->delete();

        return redirect()->route('chambers.index')
            ->with('success', 'Chamber Location deleted successfully.');
    }

    public function doctorChambers(Doctor $doctor)
    {
        
        $chambers = ChamberLocation::where('doctor_id', $doctor->id)->get();

        return view('admin.chambers.doctor_chambers', compact('doctor', 'chambers'));
    }
}
