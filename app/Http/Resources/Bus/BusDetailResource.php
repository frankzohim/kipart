<?php

namespace App\Http\Resources\Bus;

use App\Http\Resources\Travel\TravelResource;
use App\Models\Travel;
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
            'Voyage'=>TravelResource::collection(Travel::where('id',$this->travel_id)->get()),
            'numberOfPlaces'=>$this->number_of_places,
            'classe'=>$this->classe,
            'plan'=>$this->plan
            ];
    }
}
