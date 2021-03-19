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

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'notifications' =>  Notifications::where('user_id', $user_id)->orderBy('created_at', 'desc')->get(),
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
