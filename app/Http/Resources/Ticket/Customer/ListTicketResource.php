<?php

namespace App\Http\Resources\Ticket\Customer;

use App\Models\Travel;
use App\Models\Passenger;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Travel\TravelResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Passenger\PassengersDetailResource;

class ListTicketResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'nameUser'=>Auth::guard('api')->user()->name,
            'type'=>$this->type,
            'SousAgence'=>$this->subAgency->name,
            'Voyage'=>TravelResource::collection(Travel::where('id',$this->travel_id)->get()),
            'Passager'=>PassengersDetailResource::collection(Passenger::where('id',$this->passenger_id)->get()),

        ];
    }
}
