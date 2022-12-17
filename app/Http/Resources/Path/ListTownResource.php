<?php

namespace App\Http\Resources\Path;

use Illuminate\Http\Resources\Json\JsonResource;

class ListTownResource extends JsonResource
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
            'ville'=>$this->departure
        ];
    }
}
