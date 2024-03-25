<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeWashingResource extends JsonResource
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
            'status' => $this->status,
            'title' => $this->washing_name,
            'payment_status' => $this->payment_status,
            'phone' => $this->phone,
            'start_hour' => $this->start_date,
            'end_hour' => $this->end_date,
            'address' => $this->address,
            'description' => $this->description,
            'rating' => $this->average_rating,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'distance' => $this->distance,
            'main_image' => $this->main_image,
            'images' => WashingImagesResource::collection($this->images),
            'services' => $this->groupedServices->map(function ($services, $key) {
                return [
                    'ban_id' =>  $key,
                    'services' => SingleWashingServiceResource::collection($services),
                ];
            })->values(),
        ];
    }
}
