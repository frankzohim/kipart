<?php

namespace App\Http\Resources\Passenger;

use Illuminate\Http\Resources\Json\JsonResource;

class PassengersDetailResource extends JsonResource
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
            "id"=>$this->id,
            'nom'=>$this->name,
            'type'=>$this->type,
            'seatNumber'=>$this->seatNumber,
            'cniNumber'=>$this->cniNumber,
            'telephone'=>$this->telephone
        ];
    }
}
