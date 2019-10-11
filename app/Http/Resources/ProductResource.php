<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'rating' => ($this->reviews->count() > 0) ? $this->reviews->sum('rating')/$this->reviews->count() : 'No reviews' ,
            'review' => $this->reviews,
            'href' => [
                'review' => route('reviews.index', $this->id),
            ],
        ];
    }
}
