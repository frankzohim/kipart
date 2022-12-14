<?php

namespace App\Http\Resources\Bus;

use Illuminate\Http\Resources\Json\JsonResource;

class BusDetailResource extends JsonResource
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
            'id'=>$this->id,
            'registration'=>$this->registration,
            'agencyName'=>$this->agency->name,
            'numberOfPlaces'=>$this->number_of_places,
            'classe'=>$this->classe,
            'plan'=>$this->plan
            ];
    }
}
