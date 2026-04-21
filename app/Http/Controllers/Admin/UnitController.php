<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class UnitController extends Controller
{

    /**
     * Display a paginated list of all units.
     *
     * @return \Illuminate\View\View
     */
    public function unitsAll()
    {
        // Set the current menu and submenu for active sidebar highlighting
        menuSubmenu('product', 'unitsAll');

        // Fetch latest units with pagination (30 per page)
        $units = Unit::latest()->paginate(30);

        // Return the view with data
        return view('admin.units.unitsAll', compact('units'));
    }

    /**
     * Show the form to create a new unit.
     *
     * @return \Illuminate\View\View
     */
    public function unitCreate()
    {
        // Set the current menu and submenu for sidebar highlighting
        menuSubmenu('product', 'unitsAll');

        // Return the view to create a new unit
        return view('admin.units.unitCreate');
    }

    /**
     * Store a newly created unit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unitStore(Request $request)
    {
        // Highlight correct menu in sidebar
        menuSubmenu('product', 'unitsAll');

        // Validate incoming request
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'nullable|string|max:255',
        ]);

        // Initialize new unit instance
        $unit = new Unit();
        $unit->name_en = $request->name_en;
        $unit->name_bn = $request->name_bn;
        $unit->active = $request->boolean('active', true);
        $unit->addedby_id = Auth::id();

        // Save unit
        $unit->save();

        // Clear cache
        Cache::flush();

        return redirect()->route('admin.unitsAll')->with('success', 'Unit successfully created');
    }

    /**
     * Show the form to edit the specified unit.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\View\View
     */
    public function unitEdit(Unit $unit)
    {
        // Set active menu/submenu for UI highlight
        menuSubmenu('product', 'unitsAll');

        // Return edit view with unit data
        return view('admin.units.unitEdit', compact('unit'));
    }

    /**
     * Update the specified unit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unitUpdate(Request $request, Unit $unit)
    {
        // Set active menu for admin sidebar
        menuSubmenu('product', 'unitsAll');

        // Validate incoming request data
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'nullable|string|max:255',
        ]);

        // Update unit fields
        $unit->name_en = $request->name_en;
        $unit->name_bn = $request->name_bn;
        $unit->active = $request->boolean('active');
        $unit->editedby_id = Auth::id();

        // Save the updated unit
        $unit->save();

        // Clear cache to reflect updates immediately
        Cache::flush();

        return redirect()->back()->with('success', 'Unit successfully updated');
    }

    /**
     * Delete the specified unit from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unitDelete(Unit $unit)
    {
        // Set active menu for admin sidebar
        menuSubmenu('product', 'unitsAll');

        // Delete the unit record from database
        $unit->delete();

        // Clear cache to update any cached data
        Cache::flush();

        return redirect()->back()->with('success', 'Unit successfully deleted');
    }

    /**
     * Toggle the active status of a unit via AJAX
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unitStatus(Request $request)
    {
        // Find unit by ID or fail with 404
        $unit = Unit::findOrFail($request->unit);

        // Toggle the active status
        $unit->active = !$unit->active;

        // Save the updated status
        $unit->save();

        // Return JSON response for AJAX success
        return response()->json([
            'success' => true,
            'active' => $unit->active,
        ]);
    }

    
    /**
     * Search entities based on type and query.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unitSearch(Request $request)
    {
        $type = $request->type;
        $q = $request->q;

        if ($type !== 'unit') {
            return response()->json([
                'success' => false,
                'message' => 'Invalid search type.',
            ], 400);
        }

        $units = Unit::where(function ($qq) use ($q) {
            $qq->orWhere('name_en', 'like', "%{$q}%")
                ->orWhere('name_bn', 'like', "%{$q}%")
                ->orWhere('id', 'like', "%{$q}%");
        })->orderBy('name_en')
            ->paginate(100);

        $units->appends($request->all());

        $page = View('admin.units.searchData', ['units' => $units])->render();

        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }

}
