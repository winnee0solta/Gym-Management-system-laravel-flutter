<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Member;
use App\Models\Trainers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $member_count = Member::count();
        $new_member_count = Member::count();
        $trainer_count = Trainers::whereMonth('created_at', Carbon::now()->month)->count();


        $date = Carbon::today()->toDateString();

        $member_present_count = 0;
        $member_absent_count = 0;
        $trainee_present_count = 0;
        $trainee_absent_count = 0;


        //absent trainers & members
        $absent_trainers = array();
        $absent_members = array();

        //trainer attendance
        foreach (Trainers::all() as $trainer) {


            $status = 'NONE';
            $attendance =  Attendances::where('trainer_id', $trainer->id)
                ->whereDate('created_at', '=',   $date)
                ->first();

            if ($attendance) {
                $status = $attendance->status;

                if ($attendance->status == "PRESENT") {
                    $trainee_present_count =  $trainee_present_count + 1;
                }
                if ($attendance->status == "ABSENT") {
                    $trainee_absent_count =  $trainee_absent_count + 1;

                    //add to absent array
                    array_push($absent_trainers, $trainer);
                }
            }
        }
        //member attendance
        foreach (Member::with('user')->get() as $member) {

            $status = 'NONE';
            $attendance =  Attendances::where('member_id', $member->id)
                ->whereDate('created_at', '=',   $date)
                ->first();

            if ($attendance) {
                $status = $attendance->status;

                if ($attendance->status == "PRESENT") {
                    $member_present_count =  $member_present_count + 1;
                }
                if ($attendance->status == "ABSENT") {
                    $member_absent_count =  $member_absent_count + 1;

                    //add to absent array
                    array_push($absent_members, $member);
                }
            }
        }

        // return $absent_members;

        return view('dashboard', compact(
            'member_count',
            'new_member_count',
            'trainer_count',
            'member_present_count',
            'member_absent_count',
            'trainee_present_count',
            'trainee_absent_count',
            'absent_trainers',
            'absent_members'
        ));
    }
}