<?php

namespace App\Http\Resources\Passenger;

use App\Models\Travel;
use App\Http\Resources\Travel\TravelResource;
use App\Models\Passenger;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailTravelResource extends JsonResource
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
            'Voyageurs'=>PassengerResource::collection(Passenger::where('payment_id',$this->id)->get()),
            'InfosVoyages'=>TravelResource::collection(Travel::where('id',$this->travel_id)->get()),
        ];
    }
}
