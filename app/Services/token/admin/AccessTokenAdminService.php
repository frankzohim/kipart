<?php

namespace App\Services\token\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class AccessTokenAdminService{

    public  function  accessToken(){
        $result = Http::post('http://kipart.stillforce.tech/oauth/token', [
            'grant_type'    => 'password',
            'username' => Auth::guard('admin')->user()->email,
            'password' =>decrypt(Auth::guard('admin')->user()->password),
            'client_secret' => '5OIvyt0vYo5UbZ29PRhdor9R9imZKru9Nij2EMUb',
            'client_id'=>4
        ]);

        $access_token = json_decode((string) $result->getBody(), true)['access_token'];

        return $access_token;
    }
}
