<?php

namespace App\Http\Resources\Travel;

use App\Models\Bus;
use App\Http\Resources\Bus\BusResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelResource extends JsonResource
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
            'arrival'=>$this->path->arrival,
            'agence'=>$this->agency->name,
            'agency_id'=>$this->agency->id,
            'path_id'=>$this->path_id,
            'heure'=>$this->schedule->hours,
            'state'=>$this->state,
            'classe'=>$this->classe,
            'prix'=>$this->price,
        ];
    }
}
