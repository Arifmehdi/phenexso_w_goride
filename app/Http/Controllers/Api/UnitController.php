<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of active units.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $units = Unit::where('active', 1)
            ->select('id', 'name_en', 'name_bn')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $units,
            'message' => 'Units retrieved successfully'
        ]);
    }
}