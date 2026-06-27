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
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'emergency_contact_name'  => $this->emergency_contact_name,
            'emergency_contact_phone' => $this->emergency_contact_phone,
            'blood_group' => $this->blood_group,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}