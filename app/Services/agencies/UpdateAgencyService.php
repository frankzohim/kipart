<?php

namespace App\Services\agencies;

use App\Models\Agency;


class UpdateAgencyService{

    public function update($id,$request){
        $agency=Agency::find($id);
        $input=$request->all();
        $update=$agency->update($input);
        if($update){
        return response()->json(['status'=>'success','message'=>'Agency update']);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'agency not found']);
        }
    }
}




