<?php

namespace App\Http\Resources\Agency\SubAgency;

use Illuminate\Http\Resources\Json\JsonResource;

class SubAgencyByAgencyResource extends JsonResource
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
            'localisation'=>$this->localisation,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'logo'=>$this->agency->logo,
            'agency_id'=>$this->agency->id,
            'agence'=>$this->agency->name,
        ];
    }
}
