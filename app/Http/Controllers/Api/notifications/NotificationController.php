<?php

namespace App\Http\Controllers\Api\notifications;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function sendNotification(){

        $fields['include_player_ids'] =['1c0d80af-bcc5-4b26-8c51-2f329491676d'];
        $message = 'Hello!! A tiny web push notification.!';
        $send=OneSignal::sendPush($fields, $message);

        return response()->json(['message' =>$send],200);
    }

    public function getNotifications(){

        $notifications=OneSignal::getNotifications();

        return response()->json(['datas'=>$notifications]);
    }
}
