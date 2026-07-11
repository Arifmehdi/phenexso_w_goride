<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    /**
     * Named checkCode() rather than validate() — the base Controller class
     * uses the ValidatesRequests trait, whose validate() has an incompatible
     * signature. Overriding it fatals at class-load time.
     */
    public function checkCode(Request $request)
    {
        $request->validate([
            'code'     => 'required|string',
            'fare'     => 'required|numeric|min:0',
        ]);

        $promo = PromoCode::where('code', strtoupper($request->code))
            ->where('is_active', true)
            ->first();

        if (!$promo) {
            return response()->json(['success' => false, 'message' => 'Invalid promo code'], 404);
        }

        if ($promo->expires_at && $promo->expires_at->isPast()) {
            return response()->json(['success' => false, 'message' => 'Promo code has expired'], 422);
        }

        if ($promo->max_uses && $promo->used_count >= $promo->max_uses) {
            return response()->json(['success' => false, 'message' => 'Promo code usage limit reached'], 422);
        }

        if ($request->fare < $promo->min_fare) {
            return response()->json([
                'success' => false,
                'message' => "Minimum fare ৳{$promo->min_fare} required for this code",
            ], 422);
        }

        $discount = $promo->type === 'percent'
            ? ($request->fare * $promo->value / 100)
            : $promo->value;

        if ($promo->max_discount) {
            $discount = min($discount, $promo->max_discount);
        }

        $discount = min($discount, $request->fare);

        return response()->json([
            'success'       => true,
            'discount'      => round($discount, 2),
            'final_fare'    => round($request->fare - $discount, 2),
            'promo_id'      => $promo->id,
            'description'   => $promo->type === 'percent'
                ? "{$promo->value}% off (max ৳" . ($promo->max_discount ?? '∞') . ')'
                : "৳{$promo->value} flat discount",
        ]);
    }
}
