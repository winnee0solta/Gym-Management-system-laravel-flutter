<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //notificaitons
    public function notificaitons($user_id)
    {
        $user = User::find($user_id);
        if ($user) {

            $notifications = Notifications::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

            //make all notice seen
            foreach ($notifications as $notification) {
                $notification->seen = true;
                $notification->save();
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'notifications' =>  $notifications,
            );

            return response()->json($response);
        }

        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
    public function notificaitonsCount($user_id)
    {
        $user = User::find($user_id);
        if ($user) {

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'noticecount' =>  Notifications::where('user_id', $user_id)->where('seen', false)->count(),
            );

            return response()->json($response);
        }

        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
}