<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name_en, // Assuming 'name' is an attribute of ProductCategory
            'slug' => $this->slug, // Assuming 'slug' is an attribute of ProductCategory
            'image' => $this->fi(), // Using the accessor
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'parent' => new ProductCategoryResource($this->whenLoaded('parent')), // Conditionally load parent category
            'children' => ProductCategoryResource::collection($this->whenLoaded('children')), // Conditionally load child categories
            // 'products' => ProductResource::collection($this->whenLoaded('products')), // Conditionally load products
        ];
    }
}