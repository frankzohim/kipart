<?php

namespace App\Http\Resources\Passenger;

use App\Models\Travel;
use App\Http\Resources\Travel\TravelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PassengerBuyResource extends JsonResource
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
            'nom'=>$this->name,
            'Place'=>$this->seatNumber,
            'cniNumber'=>$this->cni,
            'infosVoyage'=>TravelResource::collection(Travel::where('id',$this->travel_id)->get())
        ];
    }
}
