<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Path;
use Illuminate\Http\Request;
use App\Http\Requests\PathRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Path\PathResource;
use App\Http\Resources\Path\PathDetailResource;

class PathController extends Controller
{
    public function list(){
        return PathResource::collection(Path::all());
    }

    public function store(PathRequest $request){
        $path=Path::create([
            'departure'=>$request->departure,
        'arrival'=>$request->arrival,
        'agency_id'=>Auth::guard('api-agent')->user()->id,
        'state'=>$request->state,
        ]);

        $path->agencies()->attach($request->agency_id);


        return new PathResource($path);
    }

    public function update(PathRequest $request,$id){

            $path=Path::find($id);
            if($path->agence_id=Auth::guard('api-agent')->user()->id){
        $input=$request->all();
        $update=$path->update($input);
        if($update){
        return response()->json(['status'=>'success','message'=>'chemin mis a jour']);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'chemin non trouvé']);
        }

        }else{
            return response()->json(['status'=>'fail!','message'=>'Unauthorized'],403);
        }
    }

    public function destroy($id)
    {

        $path=Path::find($id);

        if($path->agence_id==Auth::guard('api-agent')->user()->id){
            if($path){
                $path->delete();
            return response()->json(["message"=>"Path deleted"],204);
            }else{
                return response()->json(["message"=>"Path not found"],404);
            }
        }else{
                return response()->json(['status'=>'fail!','message'=>'Unauthorized'],403);
            }

    }

}
