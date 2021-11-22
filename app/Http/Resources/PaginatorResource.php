<?php

namespace App\Http\Resources;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginatorResource extends JsonResource
{
    public function __construct(public string $jsonResource, public LengthAwarePaginator $data)
    {}

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request                                          $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'total' => $this->data->total(),
            'perPage' => $this->data->perPage(),
            'lastPage' => $this->data->lastPage(),
            'currentPage' => $this->data->currentPage(),
            'items' => $this->jsonResource::collection($this->data->items()),
        ];
    }
}