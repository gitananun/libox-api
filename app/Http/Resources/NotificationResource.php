<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    private function getWithouNamespace(string $withNamespace): string
    {
        return ($c = explode('\\', $withNamespace))[sizeof($c) - 1];
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request                                          $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->getWithouNamespace($this->type),
            'notifiable_type' => $this->getWithouNamespace($this->notifiable_type),
            'notifiable_id' => $this->notifiable_id,
            'data' => $this->data,
            'read_at' => $this->read_at,
        ];
    }
}