<?php

namespace App\Http\Controllers\Api\notifications;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function sendNotification($message){

        $fields['include_player_ids'] =["1fee3f5a-1c5d-40a9-8c80-aa22cd91b59d"];
        $message = 'Hello!! A tiny web push notification.!';
        $send=OneSignal::sendPush($fields, $message);

        return response()->json(['message' =>$send],200);
    }

    public function getNotifications(){

        $notifications=OneSignal::getNotifications();

        return response()->json(['datas'=>$notifications]);
    }
}
