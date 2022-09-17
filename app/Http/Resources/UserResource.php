<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid'=>$this->uuid,
            'role' => $this->role->title,
            'name' => $this->name,
            'status' => $this->status,
            'email' => $this->email,
            'seller_profile'=>SellerProfileResource::make($this->whenLoaded('sellerProfile'))
        ];
    }
}
