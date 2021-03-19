<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Trainerassignedmembers;
use App\Models\Trainers;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    //trainersSchedule
    public function trainersSchedule($user_id)
    {

        $user = User::find($user_id);
        if ($user) {
            $trainer = Trainers::where('user_id', $user->id)->first();
            //assigned members
            $assigned_members = array();
            foreach (Trainerassignedmembers::where('trainer_id', $trainer->id)->get() as $item) {
                $member = Member::find($item->member_id);
                if ($member) {
                    $user = User::find($member->user_id);
                    array_push($assigned_members, array(
                        'user_id' => $user->id,
                        'member_id' => $member->id,
                        'image' => $member->image,
                        'fullname' => $member->fullname,
                        'phone' => $member->phone,
                        'address' => $member->address,
                        'username' => $user->username,
                        'shift_m' => $member->shift_m,
                        'shift_e' => $member->shift_e,
                    ));
                }
            }


            $response = array(
                'status' => 200,
                'message' => 'OK',
                'datas' => $assigned_members
            );

            return response()->json($response);
        }

        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
    public function trainerdata($user_id)
    {

        $user = User::find($user_id);
        if ($user) {
            $trainer = Trainers::where('user_id', $user->id)->first();
          

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'trainer' => $trainer,
                'user' => $user,
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
