<?php

namespace App\Http\Controllers\Api\agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailAgentController extends Controller
{
    public function infosAgent(){

        $agent=Auth::guard('api-agent')->user();
        return $agent;
    }
}
