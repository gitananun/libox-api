<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request                                          $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "title" => $this->title,
            "rating" => $this->rating,
            "price" => $this->price,
            "length" => $this->length,
            "language" => $this->language,
            "description" => $this->language,
            "last_updated" => $this->last_updated,
            "created_at" => $this->created_at,
        ];
    }
}