<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

/**
 * Admin CRUD for promo codes. Codes created here feed the same `promo_codes`
 * table that the app's PromoCodeController@checkCode (POST /api/promo/validate)
 * reads — so a code added here is immediately usable by passengers in the app.
 */
class PromoCodeController extends Controller
{
    public function index()
    {
        if (function_exists('menuSubmenu')) {
            menuSubmenu('promo_codes', 'promoCodesSM');
        }
        $promoCodes = PromoCode::orderByDesc('id')->paginate(15);
        return view('admin.promo_codes.index', compact('promoCodes'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        PromoCode::create($data);
        return redirect()->back()->with('success', 'Promo code created successfully.');
    }

    public function update(Request $request, $id)
    {
        $promo = PromoCode::findOrFail($id);
        $data = $this->validated($request, $promo->id);
        $promo->update($data);
        return redirect()->back()->with('success', 'Promo code updated successfully.');
    }

    public function destroy($id)
    {
        PromoCode::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Promo code deleted.');
    }

    /**
     * Validate + normalise the request into a save-ready array.
     */
    private function validated(Request $request, $ignoreId = null): array
    {
        $rules = [
            'code'         => 'required|string|max:30|unique:promo_codes,code' . ($ignoreId ? ",{$ignoreId}" : ''),
            'type'         => 'required|in:flat,percent',
            'value'        => 'required|numeric|min:0',
            'min_fare'     => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_uses'     => 'nullable|integer|min:0',
            'expires_at'   => 'nullable|date',
        ];
        $request->validate($rules);

        return [
            'code'         => strtoupper(trim($request->code)),
            'type'         => $request->type,
            'value'        => $request->value,
            'min_fare'     => $request->min_fare ?? 0,       // column is NOT NULL (default 0)
            'max_discount' => $request->max_discount ?: null,
            'max_uses'     => $request->max_uses ?: null,
            'expires_at'   => $request->expires_at ?: null,
            'is_active'    => $request->has('is_active'),
        ];
    }
}
