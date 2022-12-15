<?php

namespace App\Http\Controllers\Api\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailUserLoginController extends Controller
{
    public function infosUser(){

        $User=Auth::guard('api')->user();
        return $User;
    }
}
