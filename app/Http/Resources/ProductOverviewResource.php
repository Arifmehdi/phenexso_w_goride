<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOverviewResource extends JsonResource
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
            'click_count' => $this->click_count,
            'name_en' => $this->name_en,
            // 'name_bn' => $this->name_bn,
            'sku' => $this->sku,
            'stock' => $this->stock,
            'slug' => $this->slug,
            'excerpt_en' => $this->excerpt_en,
            // 'excerpt_bn' => $this->excerpt_bn,
            'description_en' => $this->description_en,
            // 'description_bn' => $this->description_bn,
            'featured_image' => $this->fi(), // Using the accessor
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'final_price' => $this->final_price,
            // 'unit' => $this->unit,
            // 'tags' => $this->tags,
            'active' => $this->active,
            // 'feature' => $this->feature,
            // 'editor' => $this->editor,
            // 'addedby_id' => $this->addedby_id,
            // 'editedby_id' => $this->editedby_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'added_by' => new UserResource($this->whenLoaded('addedBy')), // Conditionally load
            'categories' => ProductCategoryResource::collection($this->whenLoaded('categories')), // Conditionally load
            'average_rating' => $this->averageRating(),
            // You can also include media, reviews, items if needed
        ];
    }
}