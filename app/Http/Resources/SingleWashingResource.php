<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleWashingResource extends JsonResource
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
            'title' => $this->washing_name,
            'phone' => $this->phone,
            'start_hour' => $this->start_date,
            'end_hour' => $this->end_date,
            'address' => $this->address,
            'description' => $this->description,
            'rating' => $this->average_rating,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'distance' => $this->distance,
            'images' => WashingImagesResource::collection($this->images),
            'services' => $this->groupedServices->map(function ($services) {
                return SingleWashingServiceResource::collection($services);
            }),

        ];
    }
}
