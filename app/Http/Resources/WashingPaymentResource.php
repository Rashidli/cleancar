<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WashingPaymentResource extends JsonResource
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
            'washing_name' => $this->washing_name,
            'packages' => PackageResource::collection($this->packages),
        ];
    }
}


