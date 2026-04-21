<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\shippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index()
    {
        menuSubmenu('shipping','shippingMethod');
        $methods = ShippingMethod::orderBy('id', 'desc')->get();
        return view('admin.shipping.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'is_free' => 'nullable|boolean',
        ]);

        ShippingMethod::create($request->all());
        return redirect()->route('shipping.index')->with('success', 'Shipping Method created successfully.');
    }

    public function edit($id)
    {
        
        $shippingMethod = ShippingMethod::findOrFail($id);
      
        return view('admin.shipping.edit', compact('shippingMethod'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'is_free' => 'nullable|boolean',
        ]);

        $shippingMethod = ShippingMethod::findOrFail($id);

        // ✅ Ensure is_free always has a defined value
        $data = $request->all();
        $data['is_free'] = $request->has('is_free') ? 1 : 0;

        $shippingMethod->update($data);

        return redirect()->route('shipping.index')->with('success', 'Shipping Method updated successfully.');
    }


    public function destroy($id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->delete();
        return redirect()->route('shipping.index')->with('success', 'Shipping Method deleted successfully.');
    }
}
