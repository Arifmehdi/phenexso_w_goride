<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductStockRequestController extends Controller
{




    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'collection_datetime' => 'required|date',
            'collection_location' => 'required|string|max:255',
        ]);

        ProductStockRequest::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'collection_datetime' => $request->collection_datetime,
            'collection_location' => $request->collection_location,
        ]);

        return redirect()->route('user.stock_requests.index')->with('success', 'Stock request created successfully.');
    }
}
