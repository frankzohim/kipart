<?php

namespace App\Http\Resources\Agency;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
            'logo'=> URL($this->logo),
            'headquarters'=>$this->headquarters,
            'email'=>$this->email,
            'phone_number' =>$this->phone_number,
            'state'=>$this->state,
        ];
    }
}
