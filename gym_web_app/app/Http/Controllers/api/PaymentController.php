<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //memberPayments
    public function memberPayments($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $member = Member::where('user_id', $user->id)->first();



            $response = array(
                'status' => 200,
                'message' => 'OK',
                'member' => $member,
                'user' => $user,
                'payments' =>  Payments::where('member_id', $member->id)->orderBy('created_at', 'desc')->get(),
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
