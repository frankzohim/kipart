<?php

namespace App\Http\Controllers\Api;

use App\Models\Path;
use Illuminate\Http\Request;
use App\Http\Requests\PathRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PathResource;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PathResource::collection(Path::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PathRequest $request)
    {
        $path=Path::create([
            'departure'=>$request->departure,
        'arrival'=>$request->arrival,
        'state'=>$request->state,
        ]);


        return new PathResource($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $path=Path::find($id);

        if($path){
            return new PathResource($path);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'path not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PathRequest $request, $id)
    {
        $path=Path::find($id);
        $input=$request->all();
        $update=$path->update($input);
        if($update){
        return response()->json(['status'=>'success','message'=>'Path update']);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'Path not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Path $path)
    {
        if($path){
            $path->delete();
        return response()->json(["message"=>"Path deleted"],204);
        }else{
            return response()->json(["message"=>"Path not found"],404);
        }
    }
}
