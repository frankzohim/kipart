<?php

namespace App\Http\Resources\Travel;

use App\Models\Bus;
use App\Http\Resources\Bus\BusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
            'date'=>$this->date->format('Y-m-d'),
            'departure'=>$this->path->departure,
            'arrival'=>$this->path->arrival,
            'agence'=>$this->bus->agency->name,
            'logo'=>URL($this->bus->agency->logo),
            'heure'=>$this->schedule->hours,
            'classe'=>$this->classe,
            'prix'=>$this->price,
        ];
    }
}
