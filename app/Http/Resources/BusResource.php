<?php

namespace App\Http\Resources;

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
        'registration'=>$this->registration,
        'agence'=>$this->agency,
        'number_of_places'=>$this->number_of_places,
        'class'=>$this->class,
        'plan'=>$this->plan

        ];
    }
}
