<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource; // Import ProductCategoryResource
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = ProductCategory::with(['parent', 'children'])->paginate(10); // Example with pagination and eager loading
        return ProductCategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ProductCategoryResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = ProductCategory::create($request->all()); // Ensure fillable properties are set in ProductCategory model

        return new ProductCategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \App\Http\Resources\ProductCategoryResource
     */
    public function show(ProductCategory $productCategory)
    {
        $productCategory->load(['parent', 'children']); // Eager load relationships for a single category
        return new ProductCategoryResource($productCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \App\Http\Resources\ProductCategoryResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:product_categories,slug,' . $productCategory->id,
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $productCategory->update($request->all());

        return new ProductCategoryResource($productCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return response()->json(['message' => 'Product category deleted successfully'], 204);
    }
}
