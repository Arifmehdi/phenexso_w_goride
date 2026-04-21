<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'address_title' => $this->address_title,
            'subtotal' => $this->subtotal,
            'grand_total' => $this->grand_total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'payment_gateway' => $this->payment_gateway,
            'delivery_cost' => $this->delivery_cost,
            'order_note' => $this->order_note,
            'payment_trx_id' => $this->payment_trx_id,
            'order_status' => $this->order_status,
            'pending_at' => $this->pending_at,
            'confirmed_at' => $this->confirmed_at,
            'ready_to_ship_at' => $this->ready_to_ship_at,
            'shiped_at' => $this->shiped_at,
            'delivered_at' => $this->delivered_at,
            'canceled_at' => $this->canceled_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'order_items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'payments' => $this->whenLoaded('payments'), // Assuming Payment model doesn't need a specific resource for now
            'due_amount' => $this->due(),
            'paid_amount' => $this->paid(),
        ];
    }
}