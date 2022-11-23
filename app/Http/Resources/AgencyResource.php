<?php

namespace App\Http\Resources;

use App\Http\Resources\PathResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'id'=> $this->id,
            'name'=>$this->name,
            'logo'=>$this->logo,
            'headquarters'=>$this->headquarters,
            'state'=>$this->state,
            'nbreDeBus'=>$this->buses->count(),
            'bus'=>$this->buses,
            'Itineraire' => PathResource::collection($this->whenLoaded('paths')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
