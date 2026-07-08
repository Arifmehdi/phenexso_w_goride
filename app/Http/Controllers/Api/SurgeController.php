<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SurgeZone;
use Illuminate\Http\Request;

class SurgeController extends Controller
{
    /**
     * GET /api/admin/surge — list all surge zones (for the admin panel).
     */
    public function index()
    {
        return response()->json(['success' => true, 'zones' => SurgeZone::orderByDesc('created_at')->get()]);
    }

    /**
     * POST /api/admin/surge — create/activate a surge zone.
     * body: { name, center_lat, center_lng, radius_km, multiplier, expires_at? }
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'center_lat'  => 'required|numeric',
            'center_lng'  => 'required|numeric',
            'radius_km'   => 'nullable|integer|min:1|max:50',
            'multiplier'  => 'required|numeric|min:1|max:5',
            'expires_at'  => 'nullable|date',
        ]);

        $zone = SurgeZone::create([
            'name'        => $request->name,
            'center_lat'  => $request->center_lat,
            'center_lng'  => $request->center_lng,
            'radius_km'   => $request->radius_km ?? 3,
            'multiplier'  => $request->multiplier,
            'is_active'   => true,
            'expires_at'  => $request->expires_at,
            'created_by'  => auth()->id(),
        ]);

        return response()->json(['success' => true, 'zone' => $zone], 201);
    }

    /**
     * PATCH /api/admin/surge/{id} — deactivate or update a zone.
     */
    public function update(Request $request, SurgeZone $zone)
    {
        $request->validate([
            'is_active'  => 'nullable|boolean',
            'multiplier' => 'nullable|numeric|min:1|max:5',
        ]);
        $zone->update($request->only(['is_active', 'multiplier']));
        return response()->json(['success' => true, 'zone' => $zone]);
    }
}
