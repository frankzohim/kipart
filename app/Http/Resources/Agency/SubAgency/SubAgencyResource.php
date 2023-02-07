<?php

namespace App\Http\Resources\Agency\SubAgency;

use Illuminate\Http\Resources\Json\JsonResource;

class SubAgencyResource extends JsonResource
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
            'agency_id'=>$this->agency->id,
            'logo'=> URL($this->agency->logo),
            'localisation'=>$this->localisation,
            'email'=>$this->email,
            'phone'=>$this->phone,
        ];
    }
}
