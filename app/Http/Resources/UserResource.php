<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'additional_phone' => $this->additional_phone,
            'moved_from_city' => $this->moved_from_city,
            'moved_to_city' => $this->moved_to_city,
            'refugee_requests' => new RequestsCollection($this->whenLoaded('refugeeRequests')),
            'worker_requests' => new RequestsCollection($this->whenLoaded('workerRequests')),
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
