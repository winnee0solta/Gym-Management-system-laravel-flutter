<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Member;
use App\Models\Trainers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //home page
    public function index(Request $request)
    {

        if ($request->has('date')) {
            $date = Carbon::parse($request->date)->toDateString();
        } else {

            $date = Carbon::today()->toDateString();
        }

        //trainer attendance 
        $trainer_attendances = array();
        foreach (Trainers::all() as $trainer) {

            $status = 'NONE';
            $attendance =  Attendances::where('trainer_id', $trainer->id)
                ->whereDate('created_at', '=',   $date)
                ->first();

            if ($attendance) {
                $status = $attendance->status;
            }

            array_push($trainer_attendances, array(
                'trainer_id' => $trainer->id,

                'user_id' => $trainer->user_id,
                'image' => $trainer->image,
                'fullname' => $trainer->fullname,
                'phone' => $trainer->phone,
                'address' => $trainer->address,
                'shift_m' => $trainer->shift_m,
                'shift_e' => $trainer->shift_e,

                'status' => $status,
            ));
        }

        //member attendance
        $member_attendances = array();
        foreach (Member::all() as $member) {

            $status = 'NONE';
            $attendance =  Attendances::where('member_id', $member->id)
                ->whereDate('created_at', '=',   $date)
                ->first();

            if ($attendance) {
                $status = $attendance->status;
            }

            array_push($member_attendances, array(
                'member_id' => $member->id,

                'user_id' => $member->user_id,
                'image' => $member->image,
                'fullname' => $member->fullname,
                'phone' => $member->phone,
                'address' => $member->address,
                'shift_m' => $member->shift_m,
                'shift_e' => $member->shift_e,

                'status' => $status,
            ));
        }


        return view('attendance.attendance', compact(
            'member_attendances',
            'trainer_attendances',
            'date'
        ));
    }

    public function setTrainerAttendaceStatus($trainer_id, $status, Request $request)
    {
        $trainer = Trainers::find($trainer_id);
        if ($trainer) {
            $user = User::find($trainer->user_id);

            $attendance =  Attendances::where('trainer_id', $trainer->id)
                ->whereDate('created_at', '=', $request->date)
                ->first();

            if ($attendance) {
                $attendance->status =  $status;
                $attendance->save();
            } else {
                Attendances::create([
                    'user_id' => $user->id,
                    'trainer_id' => $trainer->id,
                    'status' =>    $status,
                    'type' => 'trainer',
                ]);
            }
        }

        return redirect('/attendance?date=' . $request->date);
    }
    public function setMemberAttendaceStatus($member_id, $status, Request $request)
    {
        $member = Member::find($member_id);
        if ($member) {
            $user = User::find($member->user_id);

            $attendance =  Attendances::where('member_id', $member->id)
                ->whereDate('created_at', '=', $request->date)
                ->first();

            if ($attendance) {
                $attendance->status =  $status;
                $attendance->save();
            } else {
                Attendances::create([
                    'user_id' => $user->id,
                    'member_id' => $member->id,
                    'status' =>    $status,
                    'type' => 'member',
                ]);
            }
        }

        return redirect('/attendance?date=' . $request->date);
    }
}
