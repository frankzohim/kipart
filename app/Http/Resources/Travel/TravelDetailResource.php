<?php

namespace App\Http\Resources\Travel;

use App\Models\Bus;
use App\Http\Resources\Bus\BusResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelDetailResource extends JsonResource
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
            'date'=>$this->date,
            'departure'=>$this->path->departure,
            'prix'=>$this->price,
            'arrival'=>$this->path->arrival,
            'Information_of_Bus'=>BusResource::collection(Bus::where('travel_id', $this->id)->get()),
            'classe'=>$this->classe,


        ];
    }
}
