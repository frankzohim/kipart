<?php

namespace App\Http\Controllers\Api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailAdminController extends Controller
{
    public function infosAdmin(){

        $admin=Auth::guard('api-admin')->user();
        return $admin;
    }
}
