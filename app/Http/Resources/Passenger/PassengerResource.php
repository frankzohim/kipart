<?php

namespace App\Http\Resources\Passenger;

use App\Http\Resources\Agency\AgencyResource;
use App\Http\Resources\Travel\TravelDetailResource;
use App\Http\Resources\Travel\TravelResource;
use App\Models\Agency;
use App\Models\Travel;
use Illuminate\Http\Resources\Json\JsonResource;

class PassengerResource extends JsonResource
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
            'nom'=>$this->name,
            'seatNumber'=>$this->seatNumber,
            'cniNumber'=>$this->cni,
            'telephone'=>$this->telephone,
            'etat_de_paiement'=>$this->isCheckPayment,
            'infosVoyage'=>TravelResource::collection(Travel::where('id',$this->travel_id)->get())
        ];
    }
}
