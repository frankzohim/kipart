<?php
namespace App\Services\token;

use Laravel\Passport\Client as oClient;
use Exception;
use GuzzleHttp\Client;

class GetTokenAndRefreshToken{


     // Generate Bearer Token and Refresh Token
     public function getTokenAndRefreshToken($email, $password,$name) {
        $oClient = oClient::where('name', $name)->first();
        $http = new Client;
        $response = $http->request('POST', env('APP_URL').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
            ],
        ]);

        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }
}
