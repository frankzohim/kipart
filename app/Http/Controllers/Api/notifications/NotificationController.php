<?php

namespace App\Http\Controllers\Api\notifications;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function sendNotification($message){

        $fields['include_player_ids'] =Auth::guard('api')->user()->id;
        $message = 'Hello!! A tiny web push notification.!';
        OneSignal::sendPush($fields, $message);

        return response()->json(['message' =>'message has been send'],200);
    }

    public function getNotifications(){

        $notifications=OneSignal::getNotifications();

        return response()->json(['datas'=>$notifications]);
    }
}
