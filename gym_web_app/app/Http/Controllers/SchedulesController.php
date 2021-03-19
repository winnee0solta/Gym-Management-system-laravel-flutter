<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Memberschedules;
use App\Models\Trainerassignedmembers;
use App\Models\Trainers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    public function index()
    {

        $trainers = DB::table('trainers')
            ->join('users', 'users.id', '=', 'trainers.user_id')
            ->select('trainers.*', 'users.username')
            ->get();
        $members = DB::table('members')
            ->join('users', 'users.id', '=', 'members.user_id')
            ->select('members.*', 'users.username')->get();

        return view('schedule.schedule', compact(
            'trainers',
            'members',
        ));
    }
    public function singleTrainerSchedule($trainer_id)
    {
        $trainer = Trainers::find($trainer_id);
        if ($trainer) {

            $members = DB::table('members')
                ->join('users', 'users.id', '=', 'members.user_id')
                ->select('members.*', 'users.username')
                ->get();

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
                    ));
                }
            }

            return view('schedule.trainer-schedule', compact(
                'trainer',
                'assigned_members',
                'members'
            ));
        }

        return redirect('/schedule');
    }
    public function singleTrainerAssignMember($trainer_id, $member_id)
    {

        if (Trainerassignedmembers::where('trainer_id', $trainer_id)->where('member_id', $member_id)->count() == 0) {
            Trainerassignedmembers::create([
                'trainer_id' => $trainer_id,
                'member_id' => $member_id
            ]);
        }


        return redirect('/schedule/trainer/' . $trainer_id);
    }
    public function singleTrainerRemoveAssignedMember($trainer_id, $member_id)
    {
        Trainerassignedmembers::where('trainer_id', $trainer_id)->where('member_id', $member_id)->delete();
        return redirect('/schedule/trainer/' . $trainer_id);
    }


    public function singleMemberSchedule($member_id)
    {
        $member = Member::find($member_id);
        if ($member) {

            $morning_schedules = array(
                'sunday' => 'no',
                'monday' => 'no',
                'tuesday' => 'no',
                'wednesday' => 'no',
                'thursday' => 'no',
                'friday' => 'no',
                'saturday' => 'no',
            );
            foreach (Memberschedules::where('member_id', $member->id)->where('shift', 'morning')->get() as $plan) {
                $morning_schedules[$plan->day] = $plan->detail;
            }
            $evening_schedules = array(
                'sunday' => 'no',
                'monday' => 'no',
                'tuesday' => 'no',
                'wednesday' => 'no',
                'thursday' => 'no',
                'friday' => 'no',
                'saturday' => 'no',
            );
            foreach (Memberschedules::where('member_id', $member->id)->where('shift', 'evening')->get() as $plan) {
                $evening_schedules[$plan->day] = $plan->detail;
            }


            return view('schedule.member-schedule', compact(
                'morning_schedules',
                'evening_schedules',
                'member'
            ));
        }

        return redirect('/schedule');
    }
    public function memberScheduleUpdate($member_id, $shift, Request $request)
    {
        $member = Member::find($member_id);
        if ($member) {

            if ($request->has('sunday') && $request->sunday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'sunday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'sunday', $request->sunday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'sunday', $request->sunday);
                }
            }
            if ($request->has('monday') && $request->monday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'monday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'monday', $request->monday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'monday', $request->monday);
                }
            }
            if ($request->has('tuesday') && $request->tuesday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'tuesday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'tuesday', $request->tuesday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'tuesday', $request->tuesday);
                }
            }
            if ($request->has('wednesday') && $request->wednesday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'wednesday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'wednesday', $request->wednesday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'wednesday', $request->wednesday);
                }
            }
            if ($request->has('thursday') && $request->thursday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'thursday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'thursday', $request->thursday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'thursday', $request->thursday);
                }
            }
            if ($request->has('friday') && $request->friday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'friday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'friday', $request->friday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'friday', $request->friday);
                }
            }
            if ($request->has('saturday') && $request->saturday != '') {

                if (Memberschedules::where('member_id', $member->id)->where('shift', $shift)->where('day', 'saturday')->count() == 0) {

                    $this->addNewSchedule($member->id, $shift, 'saturday', $request->saturday);
                } else {
                    $this->updateSchedule($member->id, $shift, 'saturday', $request->saturday);
                }
            }


            return redirect('/schedule/member/' . $member->id);
        }
        return redirect('/schedule');
    }



    /**
     * MISC FUNCTIONS
     */
    function addNewSchedule($member_id, $shift, $day, $detail)
    {
        Memberschedules::create([
            'member_id' => $member_id,
            'shift' => $shift,
            'day' => $day,
            'detail' => $detail,
        ]);
    }
    function updateSchedule($member_id, $shift, $day, $detail)
    {
        $plan = Memberschedules::where('member_id', $member_id)->where('shift', $shift)->where('day', $day)->first();

        if ($plan) {
            $plan->detail = $detail;
            $plan->save();
        }
    }
}
