<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Attendances;
use App\Models\Member;
use App\Models\Trainers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function trainerAttendance($user_id)
    {
        $user = User::find($user_id);
        $trainer = Trainers::where('user_id', $user->id)->first();
        if ($trainer) {

            $trainer_attendances = array();
            foreach (Attendances::where('trainer_id', $trainer->id)->orderBy('created_at', 'desc')->get() as $attendance) {
                array_push($trainer_attendances, array(
                    'attendance_id' => $attendance->id,
                    'status' => $attendance->status,
                    'date' => $attendance->created_at->format('Y-m-d'),
                ));
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'trainer_attendances' => $trainer_attendances,
            );

            return response()->json($response);
        }

        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }

    public function trainerAttendanceToday($user_id)
    {
        $user = User::find($user_id);
        $trainer = Trainers::where('user_id', $user->id)->first();
        if ($trainer) {

            //todays attendance
            $attendance = 'NONE';
            $date = Carbon::today()->toDateString();
            $at =  Attendances::where('trainer_id', $trainer->id)
                ->whereDate('created_at', '=',   $date)
                ->first();
            if ($at) {
                $attendance = $at->status;
            }
            $response = array(
                'status' => 200,
                'message' => 'OK',
                'attendance' => $attendance,
            );

            return response()->json($response);
        }

        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }


    public function memberAttendance($user_id)
    {
        $user = User::find($user_id);
        $member = Member::where('user_id', $user->id)->first();
        if ($member) {

            $member_attendances = array();
            foreach (Attendances::where('member_id', $member->id)->orderBy('created_at', 'desc')->get() as $attendance) {
                array_push($member_attendances, array(
                    'attendance_id' => $attendance->id,
                    'status' => $attendance->status,
                    'date' => $attendance->created_at->format('Y-m-d'),
                ));
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'member_attendances' => $member_attendances,
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
