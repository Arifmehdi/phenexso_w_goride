<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource; // Import ProductResource
use App\Http\Resources\ProductOverviewResource; // Import ProductOverviewResource
use App\Http\Resources\ProductWithoutDescriptionResource; // Import ProductWithoutDescriptionResource
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Product::with(['addedBy', 'categories']);

        if ($request->has('seller_id')) {
            $query->where('seller_id', $request->seller_id);
        }

        $products = $query->paginate(10);
        return ProductResource::collection($products);
    }

    /**
     * Display products for the currently authenticated seller.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function sellerProducts()
    {
        $products = Product::with(['addedBy', 'categories'])
            ->where('seller_id', Auth::id())
            ->latest()
            ->paginate(10);

        return ProductResource::collection($products);
    }

    /**
     * Update a product specifically for a seller.
     */
    public function sellerUpdate(Request $request, Product $product)
    {
        // Log::info('Seller Product Update Request Data:', $request->all());
        // Log::info('Ownership Check:', [
        //     'auth_id' => Auth::id(),
        //     'product_seller_id' => $product->seller_id,
        //     'is_match' => (int)$product->seller_id === (int)Auth::id()
        // ]);

        if ((int)$product->seller_id !== (int)Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized. You do not own this product.',
                'debug' => [
                    'your_id' => Auth::id(),
                    'owner_id' => $product->seller_id
                ]
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name_en' => 'sometimes|required|string|max:255',
            'purchase_price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->except(['categories', 'category_id', 'featured_image']));

        if ($request->hasFile('featured_image')) {
            if ($product->featured_image) {
                Storage::disk('public')->delete('product_images/' . $product->featured_image);
            }
            $file = $request->file('featured_image');
            $imageName = $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
            $product->save();
        }

        $catId = $request->category_id;
        if ($catId) {
            $product->categories()->detach();
            ProductCat::create([
                'product_id' => $product->id,
                'product_category_id' => $catId,
                'addedby_id' => Auth::id(),
            ]);
        }

        return new ProductResource($product->load(['addedBy', 'categories']));
    }

    /**
     * Display a listing of all products without descriptions.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexWithoutDescription()
    {
        $products = Product::with(['addedBy', 'categories'])->paginate(10); // Fetch all products with eager loading
        return ProductWithoutDescriptionResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ProductResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categories' => 'nullable', 
            'category_id' => 'nullable',
            'seller_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = new Product();
        $product->name_en = $request->name_en;
        $product->name_bn = $request->name_bn;
        $product->purchase_price = $request->price;
        $product->stock = $request->stock ?? 1;
        $product->discount = $request->discount ?? 0;
        $product->discount_price = $request->discount ?? 0;
        $product->final_price = $request->price - ($request->discount ?? 0);
        $product->slug = getSlug($request->slug ?? $request->name_en, $product);
        $product->excerpt_en = $request->excerpt_en;
        $product->description_en = $request->description_en;
        $product->seller_id = $request->seller_id ?? Auth::id();
        $product->addedby_id = Auth::id();

        $product->save();

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $imageName = $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
            $product->save();
        }

        $catInput = $request->categories ?? $request->category_id;
        if ($catInput) {
            $categories = is_array($catInput) ? $catInput : explode(',', $catInput);
            foreach ($categories as $catId) {
                if (!empty($catId)) {
                    ProductCat::create([
                        'product_id' => $product->id,
                        'product_category_id' => trim($catId),
                        'addedby_id' => Auth::id(),
                    ]);
                }
            }
        }

        return new ProductResource($product->load(['addedBy', 'categories']));
    }


public function bulkStore(Request $request)
{
    $products = $request->products;

    if (!is_array($products) || empty($products)) {
        return response()->json([
            'message' => 'Products array is required'
        ], 422);
    }

    $createdProducts = [];

    foreach ($products as $index => $item) {

        $validator = Validator::make($item, [
            'name_en' => 'required|string|max:255',
            'selling_price' => 'required|numeric',
            'stock' => 'nullable|integer|min:0',
            'seller_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            continue;
        }

        $product = new Product();
        $product->name_en = $item['name_en'];
        $product->name_bn = $item['name_bn'] ?? null;
        $product->sku = $item['sku'] ?? null;
        $product->stock = $item['stock'] ?? 1;

        $product->slug = getSlug($item['slug'] ?? $item['name_en'], $product);

        $product->selling_price = $item['selling_price'] ?? 0;
        $product->purchase_price = $item['purchase_price'] ?? 0;
        $product->discount = $item['discount'] ?? 0;

        $product->discount_price = $item['discount'] ?? 0;
        $product->final_price = $product->selling_price - $product->discount;

        $product->unit = $item['unit'] ?? null;

        $product->excerpt_en = $item['excerpt_en'] ?? null;
        $product->description_en = $item['description_en'] ?? null;

        $product->feature = $item['feature'] ?? 0;
        $product->editor = $item['editor'] ?? 0;
        $product->active = $item['active'] ?? 1;

        $product->rider_id = $item['rider_id'] ?? null;
        $product->addedby_id = Auth::id();

        $product->save();

        /*
        |---------------------------------------
        | FEATURED IMAGE UPLOAD
        |---------------------------------------
        */
        if ($request->hasFile("products.$index.featured_image")) {

            $file = $request->file("products.$index.featured_image");
            $ext = '.' . $file->getClientOriginalExtension();

            $imageName = $product->id . '_' . time() . $ext;

            Storage::disk('public')->put(
                'product_images/' . $imageName,
                File::get($file)
            );

            $product->featured_image = $imageName;
            $product->save();
        }

        /*
        |---------------------------------------
        | ADDITIONAL IMAGES
        |---------------------------------------
        */
        if ($request->hasFile("products.$index.additional_images")) {

            foreach ($request->file("products.$index.additional_images") as $file) {

                $ext = '.' . $file->getClientOriginalExtension();
                $imageName = $product->id . '_' . time() . rand(1,100) . $ext;

                Storage::disk('public')->put(
                    'product_images/' . $imageName,
                    File::get($file)
                );

                Media::create([
                    'file_name' => $imageName,
                    'product_id' => $product->id,
                    'file_type' => 'image',
                    'addedby_id' => Auth::id(),
                ]);
            }
        }

        /*
        |---------------------------------------
        | CATEGORY INSERT
        |---------------------------------------
        */
        $catInput = $item['categories'] ?? $item['category_id'] ?? null;

        if ($catInput) {

            $categories = is_array($catInput) ? $catInput : explode(',', $catInput);

            foreach ($categories as $catId) {

                if (!empty($catId)) {

                    ProductCat::create([
                        'product_id' => $product->id,
                        'product_category_id' => trim($catId),
                        'addedby_id' => Auth::id(),
                    ]);
                }
            }
        }

        $createdProducts[] = $product;
    }

    return ProductResource::collection(
        Product::whereIn('id', collect($createdProducts)->pluck('id'))
        ->with(['addedBy','categories'])
        ->get()
    );
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductResource
     */
    public function show(Product $product)
    {
        $product->load(['addedBy', 'categories']); // Eager load relationships for a single product
        return new ProductResource($product);
    }

    /**
     * Display a minimal overview of the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductOverviewResource
     */
    public function overview(Product $product)
    {
        return new ProductOverviewResource($product);
    }

    /**
     * Display product details without descriptions.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductWithoutDescriptionResource
     */
    public function withoutDescription(Product $product)
    {
        return new ProductWithoutDescriptionResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        Log::info('Product Update Request Data:', $request->all());

        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (Auth::user()->role === 'seller' && $product->seller_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized. You can only modify your own products.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name_en' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categories' => 'nullable',
            'category_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->except(['categories', 'category_id', 'featured_image']));

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($product->featured_image) {
                Storage::disk('public')->delete('product_images/' . $product->featured_image);
            }

            $file = $request->file('featured_image');
            $imageName = $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
            $product->save();
        }

        $catInput = $request->categories ?? $request->category_id;
        if ($catInput) {
            $product->categories()->detach();
            $categories = is_array($catInput) ? $catInput : explode(',', $catInput);
            foreach ($categories as $catId) {
                if (!empty($catId)) {
                    ProductCat::create([
                        'product_id' => $product->id,
                        'product_category_id' => trim($catId),
                        'addedby_id' => Auth::id(),
                    ]);
                }
            }
        }

        return new ProductResource($product->load(['addedBy', 'categories']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 204);
    }

    /**
     * Get products by slug (either category slug or product slug).
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\App\Http\Resources\ProductResource|\Illuminate\Http\JsonResponse
     */
    public function getProductsBySlug(string $slug, Request $request)
    {
        $resourceType = $request->query('resource_type');

        // Determine which resource to use based on the resource_type query parameter
        $productResource = ProductResource::class;
        if ($resourceType === 'overview') {
            $productResource = ProductOverviewResource::class;
        } elseif ($resourceType === 'without_description') {
            $productResource = ProductWithoutDescriptionResource::class;
        }

        // Try to find products by product category slug
        $productCategory = ProductCategory::where('slug', $slug)->first();

        if ($productCategory) {
            $products = $productCategory->products()->with(['addedBy', 'categories'])->paginate(10);
            return $productResource::collection($products);
        }

        // If no product category found, try to find a single product by its slug
        $product = Product::where('slug', $slug)->with(['addedBy', 'categories'])->first();

        if ($product) {
            return new $productResource($product);
        }

        return response()->json(['message' => 'No products or categories found for the given slug.'], 404);
    }
}
