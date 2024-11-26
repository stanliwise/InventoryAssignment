<?php

namespace App\Http\Resources;

use App\Services\DiscountServiceEngine;
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
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            'sale_price' => DiscountServiceEngine::getSalesPrice($this->resource, auth()->user())
        ];
    }
}
