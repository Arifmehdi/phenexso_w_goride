<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductStockRequest; // Import the model
use App\Models\Product; // Import the Product model for the create/edit forms
use App\Models\User; // Import the User model for admin to select user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Needed for user_id in store method

class ProductStockRequestController extends Controller
{
    public function index()
    {
        menuSubmenu('stock_requests', 'allStockRequests');
        $stockRequests = ProductStockRequest::with(['user', 'product'])->latest()->paginate(20);
        return view('admin.product_stock_requests.index', compact('stockRequests'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all(); // Fetch all users for admin to assign
        return view('admin.product_stock_requests.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Admin might create for a specific user
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'collection_datetime' => 'required|date',
            'collection_location' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        ProductStockRequest::create($request->all());

        return redirect()->route('admin.stock_requests.index')->with('success', 'Stock request created successfully.');
    }

    public function edit(ProductStockRequest $productStockRequest)
    {
        $products = Product::all();
        $users = User::all(); // Fetch all users for admin to assign
        return view('admin.product_stock_requests.edit', compact('productStockRequest', 'products', 'users'));
    }

    public function update(Request $request, ProductStockRequest $productStockRequest)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'collection_datetime' => 'required|date',
            'collection_location' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $productStockRequest->update($request->all());

        return redirect()->route('admin.stock_requests.index')->with('success', 'Stock request updated successfully.');
    }

    public function destroy(ProductStockRequest $productStockRequest)
    {
        $productStockRequest->delete();
        return redirect()->route('admin.stock_requests.index')->with('success', 'Stock request deleted successfully.');
    }
}
