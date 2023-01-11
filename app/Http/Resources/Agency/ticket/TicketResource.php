<?php

namespace App\Http\Resources\Agency\ticket;

use App\Models\Travel;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Travel\TravelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'name'=>$this->name,
            'seatNumber'=>$this->seatNumber,
            'cni'=>$this->cni,
            'telephone'=>$this->telephone,
            'Voyage'=>TravelResource::collection(Travel::where('id',$this->travel_id)->where('agency_id',Auth::guard('api-agent')->user()->agency_id)->get()),
        ];
    }
}
