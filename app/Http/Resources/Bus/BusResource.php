<?php

namespace App\Http\Resources\Bus;

use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
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
            'Immatriculation'=>$this->registration,
            'number_of_places'=>$this->number_of_places,
            'classe'=>$this->class,
            'plan'=>$this->plan
            ];
    }
}
