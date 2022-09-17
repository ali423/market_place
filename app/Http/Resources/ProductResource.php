<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'uuid' => $this->uuid,
            'title' => $this->title,
            'image' =>  asset(str_replace('public', 'storage', $this->image)),
            'count' => $this->count,
            'price' => $this->price,
            'discount' => $this->discount,
            'final_price' => $this->final_price,
        ];
    }
}
