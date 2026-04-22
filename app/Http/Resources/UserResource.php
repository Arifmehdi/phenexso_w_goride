<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'father_name' => $this->father_name,
            'email' => $this->email,
            'address' => $this->address,
            'bkash_number' => $this->bkash_number,
            'dob' => $this->dob,
            'blood' => $this->blood,
            'nid' => $this->nid,
            'short_bio' => $this->short_bio,
            'mobile' => $this->mobile,
            'role' => $this->role,
            'status' => $this->status,
            'is_approve' => $this->is_approve,
            // Add any other user attributes you want to expose
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Example of adding a custom attribute
            ];
    }
}