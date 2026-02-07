<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'mobile' => $this->mobile,
            'profile_image' => $this->profile_image,
            'owner_approval' => $this->owner_approval,
            'description' => $this->description,
            'address' => $this->address,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'role_id' => $this->role_id,
            'status' => $this->status,
            'created_id' => $this->created_id,
            'updated_id' => $this->updated_id,
            'deleted_id' => $this->deleted_id,
        ];
    }
}
