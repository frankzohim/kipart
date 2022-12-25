<?php

namespace App\Http\Resources\Passenger;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'name'=>$this->name,
            'seatNumber'=>$this->seatNumber,
            'cni'=>$this->cni,
            'telephone'=>$this->telephone,
            'isCheckPayment'=>$this->isCheckPayment,
        ];
}}
