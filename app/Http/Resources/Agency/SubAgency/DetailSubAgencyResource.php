<?php

namespace App\Http\Resources\Agency\SubAgency;

use App\Http\Resources\Agency\AgencyResource;
use App\Models\Agency;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailSubAgencyResource extends JsonResource
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
            'agence'=>AgencyResource::collection(Agency::where('id',$this->agency_id)->get())
        ];
    }
}
