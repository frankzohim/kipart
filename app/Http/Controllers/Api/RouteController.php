<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class RouteController extends Controller
{
    public function routeList(){

        $routeCollection=Route::getRoutes();
        $val=[];
        $valmethod=[];

        foreach($routeCollection as $value){
            array_push($val,$value->uri,$value->methods);
        }

        return response()->json(['uri'=>$val]);
    }
}
