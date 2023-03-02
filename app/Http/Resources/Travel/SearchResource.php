<?php

namespace App\Http\Resources\Travel;

use App\Models\Bus;
use App\Models\Travel;
use App\Models\Passenger;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $placeBusy=[];
        $listPlace=[];
        $travels=Passenger::where('travel_id',$this->id)
        ->where('isCheckPayment',1)
        ->get();
        $travel_search=Travel::find($this->id);
        $bus=Bus::find($travel_search->bus_id);

        // for($i=1;$i<=$bus->number_of_places;$i++){
        //     array_push($listPlace,$i);
        // }

            foreach($travels as $travel){
                array_push($placeBusy,$travel->seatNumber);
            }

                 //return count($travelArray);
            $placeAvailable=$bus->number_of_places - count($placeBusy);
        return [
            'id'=>$this->id,
            'date'=>$this->date->format('Y-m-d'),
            'price'=>$this->price,
            'classe'=>$this->classe,
            'name'=>$this->name,
            'agency_id'=>$this->agency_id,
            'path_id'=>$this->path_id,
            'arrival'=>$this->arrival,
            'departure'=>$this->departure,
            'hours'=>$this->hours,
            'number_of_places'=>$this->number_of_places,
            'placeAvailable'=>$placeAvailable
        ];

    }

    public static function list($id){

        $placeBusy=[];
        $listPlace=[];
        $travels=Passenger::where('travel_id',$id)
        ->where('isCheckPayment',1)
        ->get();
        $travel_search=Travel::find($id);
        $bus=Bus::find($travel_search->bus_id);

        // for($i=1;$i<=$bus->number_of_places;$i++){
        //     array_push($listPlace,$i);
        // }

            foreach($travels as $travel){
                array_push($placeBusy,$travel->seatNumber);
            }

                 //return count($travelArray);
            $placeAvailable=$bus->number_of_places - count($placeBusy);

            return $placeAvailable;

    }
}
