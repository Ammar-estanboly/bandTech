<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name"=> $this->name,
            "description" => $this->description,
            "price"=> $this->price,
            "is_active"=>(bool) $this->is_active,
            "slug"=> $this->slug,
            "image"=> $this->image

        ];
    }
}
