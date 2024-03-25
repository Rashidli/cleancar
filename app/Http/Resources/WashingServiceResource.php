<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WashingServiceResource extends JsonResource
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
            'service_id' => $this->pivot->service_id,
            'title' => $this->title,
            'icon' => $this->image,
            'price' => $this->pivot->price,
        ];
    }
}
