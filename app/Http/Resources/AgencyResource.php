<?php

namespace App\Http\Resources;

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
            'numberOfBus'=>$this->numberOfBus,
            'headquarters'=>$this->headquarters,
            'state'=>$this->state,
            'bus'=>$this->buses,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
