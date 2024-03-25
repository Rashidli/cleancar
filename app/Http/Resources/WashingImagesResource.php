<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class WashingImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

//        $imagePath = str_replace('https://cleancar.az/', '', $this->image);
//        $imagePath = public_path( $imagePath);
//        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
//        $data = file_get_contents($imagePath);
//        $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return [
            'id' => $this->id,
            'image' => $this->image,
//            'base_64' => $base64Image
        ];
    }
}
