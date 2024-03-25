<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Enum\Status;
class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $locale = app()->getLocale();
        return [
            'id' => $this->id,
            'price' => $this->price,
            'phone' => $this->user->phone,
            'day' => $this->day,
            'time' => $this->time,
            'status' => $this->reservation_statuses->last()->status,
            'status_label' => $this->getStatusLabel($locale),
            'washing' => [
                'id' => $this->washing->id,
                'washing_name' => $this->washing->washing_name,
                'washing_address' => $this->washing->address,
                'lat' => $this->washing->lat,
                'lon' => $this->washing->lon,
            ],
            'car' => new CarResource($this->car),
            'service' => [
                'id' => $this->service->id,
                'title' => $this->service->title
            ],
        ];
    }

    protected function getStatusLabel($locale)
    {
        switch ($locale) {
            case 'az':
                return constant("App\\Enum\\Status::LABEL_" . $this->reservation_statuses->last()->status . "_AZ");
            case 'en':
                return constant("App\\Enum\\Status::LABEL_" . $this->reservation_statuses->last()->status . "_EN");
            case 'ru':
                return constant("App\\Enum\\Status::LABEL_" . $this->reservation_statuses->last()->status . "_RU");
            // Add more cases for other languages as needed
            default:
                return $this->reservation_statuses->last()->status;
        }
    }
}

