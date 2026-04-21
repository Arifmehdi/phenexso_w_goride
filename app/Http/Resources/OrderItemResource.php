<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'product_price' => $this->product_price,
            'product_name' => $this->product_name,
            'total_cost' => $this->total_cost,
            'addedby_id' => $this->addedby_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product' => new ProductOverviewResource($this->whenLoaded('product')),
        ];
    }
}