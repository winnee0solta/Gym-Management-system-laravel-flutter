<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;

class NotificaitonController extends Controller
{
    public function index()
    {

        $notifications = Notifications::orderBy('created_at', 'desc')->paginate(50);

        

        return view('notifications.index', compact(
            'notifications'
        ));
    }

    //send notice to user
    public function sendNotice(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'notice' => 'required',
        ]);

        $user = User::find($request->user_id);
        if ($user) {
            Notifications::create(
                [
                    'user_id' => $user->id,
                    'user_type' => $user->type,
                    'notice' => $request->notice,
                ]
            );
        }
        return back();
    }
}
