<?php

namespace App\Http\Resources\Ticket\Agent;

use App\Models\Passenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Passenger\PassengersDetailResource;

class TicketByAgencyResource extends JsonResource
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
            'sub_agency'=>Auth::guard('api-agent')->user()->id,
            'Passager'=>PassengersDetailResource::collection(Passenger::where('id',$this->passenger_id)->get()),
            'type'=>$this->type,

        ];
    }
}
