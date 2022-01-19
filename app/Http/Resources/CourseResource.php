<?php

namespace App\Http\Resources;

use App\Models\Course;
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
            "price" => $this->price,
            "likes" => $this->likes,
            "rating" => $this->rating,
            "length" => $this->length,
            "status" => $this->status,
            "lessons" => $this->lessons,
            "language" => $this->language,
            "created_at" => $this->created_at,
            "description" => $this->description,
            "last_updated" => $this->last_updated,
            "badge" => $this->badge->name ?? null,
            "certification" => $this->certification,
            "viewers" => $this->statistic ? $this->statistic->record : null,
            "categories" => CategoryResource::collection($this->categories),
            "instructors" => InstructorResource::collection($this->instructors),
            "image_path" => $this->image_path ?? 'images/' . Course::DEFAULT_IMG_NAME,

            "published_at" => $this->published_at,
        ];
    }
}