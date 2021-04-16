<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Attendances;
use App\Models\Member;
use App\Models\Memberbodystatus;
use App\Models\Memberplans;
use App\Models\Memberschedules;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //memberdata
    public function memberdata($member_id)
    {
        $member = Member::find($member_id);
        if ($member) {

            $user = User::find($member->user_id);

            //profile data
            $bodystatus = array(
                'weight' => 0,
                'height' => 0,
                'chest' => 0,
                'stomach' => 0,
                'biceps' => 0,
                'thighs' => 0,
            );

            $bs = Memberbodystatus::where('member_id', $member->id)->first();
            if ($bs) {
                $bodystatus['weight'] = $bs->weight;
                $bodystatus['height'] = $bs->height;
                $bodystatus['chest'] = $bs->chest;
                $bodystatus['stomach'] = $bs->stomach;
                $bodystatus['biceps'] = $bs->biceps;
                $bodystatus['thighs'] = $bs->thighs;
            }

            //nutrition plans
            $nutrition_plans = array(
                'sunday' => 'no',
                'monday' => 'no',
                'tuesday' => 'no',
                'wednesday' => 'no',
                'thursday' => 'no',
                'friday' => 'no',
                'saturday' => 'no',
            );
            foreach (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->get() as $plan) {
                $nutrition_plans[$plan->day] = $plan->detail;
            }

            //work out plans
            $workout_plans = array(
                'sunday' => 'no',
                'monday' => 'no',
                'tuesday' => 'no',
                'wednesday' => 'no',
                'thursday' => 'no',
                'friday' => 'no',
                'saturday' => 'no',
            );
            foreach (Memberplans::where('member_id', $member->id)->where('type', 'workout')->get() as $plan) {
                $workout_plans[$plan->day] = $plan->detail;
            }

            //todays attendance
            $attendance = 'NONE';
            $date = Carbon::today()->toDateString();
            $at =  Attendances::where('member_id', $member->id)
                ->whereDate('created_at', '=',   $date)
                ->first();
            if ($at) {
                $attendance = $at->status;
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'member' => $member,
                'user' => $user,
                'bodystatus' => $bodystatus,
                'nutrition_plans' => $nutrition_plans,
                'workout_plans' => $workout_plans,
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
    public function singleMemberdata($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $member = Member::where('user_id', $user->id)->first();

            //profile data
            $bodystatus = array(
                'weight' => '0',
                'height' => '0',
                'chest' => '0',
                'stomach' => '0',
                'biceps' => '0',
                'thighs' => '0',
            );

            $bs = Memberbodystatus::where('member_id', $member->id)->first();
            if ($bs) {
                $bodystatus['weight'] = $bs->weight;
                $bodystatus['height'] = $bs->height;
                $bodystatus['chest'] = $bs->chest;
                $bodystatus['stomach'] = $bs->stomach;
                $bodystatus['biceps'] = $bs->biceps;
                $bodystatus['thighs'] = $bs->thighs;
            }

            //nutrition plans
            $nutrition_plans = array(
                'sunday' => 'no',
                'monday' => 'no',
                'tuesday' => 'no',
                'wednesday' => 'no',
                'thursday' => 'no',
                'friday' => 'no',
                'saturday' => 'no',
            );
            foreach (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->get() as $plan) {
                $nutrition_plans[$plan->day] = $plan->detail;
            }

            //work out plans
            $workout_plans = array(
                'sunday' => 'no',
                'monday' => 'no',
                'tuesday' => 'no',
                'wednesday' => 'no',
                'thursday' => 'no',
                'friday' => 'no',
                'saturday' => 'no',
            );
            foreach (Memberplans::where('member_id', $member->id)->where('type', 'workout')->get() as $plan) {
                $workout_plans[$plan->day] = $plan->detail;
            }

            //todays attendance
            $attendance = 'NONE';
            $date = Carbon::today()->toDateString();
            $at =  Attendances::where('member_id', $member->id)
                ->whereDate('created_at', '=',   $date)
                ->first();
            if ($at) {
                $attendance = $at->status;
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
                'member' => $member,
                'user' => $user,
                'bodystatus' => $bodystatus,
                'nutrition_plans' => $nutrition_plans,
                'workout_plans' => $workout_plans,
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

    public function updateBodyStatus(Request $request)
    {
        //validate
        $request->validate([
            'member_id' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'chest' => 'required',
            'stomach' => 'required',
            'biceps' => 'required',
            'thighs' => 'required',
        ]);

        $member = Member::find($request->member_id);
        if ($member) {

            $bs = Memberbodystatus::where('member_id', $member->id)->first();
            if ($bs) {
                $bs->weight = $request->weight;
                $bs->height = $request->height;
                $bs->chest = $request->chest;
                $bs->stomach = $request->stomach;
                $bs->biceps = $request->biceps;
                $bs->thighs = $request->thighs;
                $bs->save();
            } else {
                Memberbodystatus::create([
                    'member_id' => $request->member_id,
                    'weight' => $request->weight,
                    'height' => $request->height,
                    'chest' => $request->chest,
                    'stomach' => $request->stomach,
                    'biceps' => $request->biceps,
                    'thighs' => $request->thighs,
                ]);
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
            );

            return response()->json($response);
        }
        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
    public function updateNutritionPlans(Request $request)
    {
        //validate
        $request->validate([
            'member_id' => 'required',
            'sunday' => 'required',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
        ]);

        $member = Member::find($request->member_id);
        if ($member) {


            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'sunday')->count() == 0) {

                $this->addNewPlan($member->id, 'nutrition', 'sunday', $request->sunday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'sunday', $request->sunday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'monday')->count() ==  0) {

                $this->addNewPlan($member->id, 'nutrition', 'monday', $request->monday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'monday', $request->monday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'tuesday')->count() ==  0) {

                $this->addNewPlan($member->id, 'nutrition', 'tuesday', $request->tuesday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'tuesday', $request->tuesday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'wednesday')->count() ==  0) {

                $this->addNewPlan($member->id, 'nutrition', 'wednesday', $request->wednesday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'wednesday', $request->wednesday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'thursday')->count() ==  0) {

                $this->addNewPlan($member->id, 'nutrition', 'thursday', $request->thursday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'thursday', $request->thursday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'friday')->count() ==  0) {

                $this->addNewPlan($member->id, 'nutrition', 'friday', $request->friday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'friday', $request->friday);
            }

            if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'saturday')->count() ==  0) {

                $this->addNewPlan($member->id, 'nutrition', 'saturday', $request->saturday);
            } else {
                $this->updatePlan($member->id, 'nutrition', 'saturday', $request->saturday);
            }


            $response = array(
                'status' => 200,
                'message' => 'OK',
            );

            return response()->json($response);
        }
        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
    public function updateWorkoutPlans(Request $request)
    {
        //validate
        $request->validate([
            'member_id' => 'required',
            'sunday' => 'required',
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
        ]);

        $member = Member::find($request->member_id);
        if ($member) {


            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'sunday')->count() == 0) {

                $this->addNewPlan($member->id, 'workout', 'sunday', $request->sunday);
            } else {
                $this->updatePlan($member->id, 'workout', 'sunday', $request->sunday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'monday')->count() ==  0) {

                $this->addNewPlan($member->id, 'workout', 'monday', $request->monday);
            } else {
                $this->updatePlan($member->id, 'workout', 'monday', $request->monday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'tuesday')->count() ==  0) {

                $this->addNewPlan($member->id, 'workout', 'tuesday', $request->tuesday);
            } else {
                $this->updatePlan($member->id, 'workout', 'tuesday', $request->tuesday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'wednesday')->count() ==  0) {

                $this->addNewPlan($member->id, 'workout', 'wednesday', $request->wednesday);
            } else {
                $this->updatePlan($member->id, 'workout', 'wednesday', $request->wednesday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'thursday')->count() ==  0) {

                $this->addNewPlan($member->id, 'workout', 'thursday', $request->thursday);
            } else {
                $this->updatePlan($member->id, 'workout', 'thursday', $request->thursday);
            }


            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'friday')->count() ==  0) {

                $this->addNewPlan($member->id, 'workout', 'friday', $request->friday);
            } else {
                $this->updatePlan($member->id, 'workout', 'friday', $request->friday);
            }

            if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'saturday')->count() ==  0) {

                $this->addNewPlan($member->id, 'workout', 'saturday', $request->saturday);
            } else {
                $this->updatePlan($member->id, 'workout', 'saturday', $request->saturday);
            }


            $response = array(
                'status' => 200,
                'message' => 'OK',
            );

            return response()->json($response);
        }
        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
    public function updateAttendance(Request $request)
    {
        //validate
        $request->validate([
            'member_id' => 'required',
            'status' => 'required',
        ]);

        $member = Member::find($request->member_id);
        if ($member) {
            $user = User::find($member->user_id);

            $date = Carbon::today()->toDateString();

            $attendance =  Attendances::where('member_id', $member->id)
                ->whereDate('created_at', '=',  $date)
                ->first();

            if ($attendance) {
                $attendance->status =  $request->status;
                $attendance->save();
            } else {
                Attendances::create([
                    'user_id' => $user->id,
                    'member_id' => $member->id,
                    'status' =>    $request->status,
                    'type' => 'member',
                ]);
            }

            $response = array(
                'status' => 200,
                'message' => 'OK',
            );

            return response()->json($response);
        }
        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }

    //membersSchedule
    public function membersSchedule($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $member = Member::where('user_id', $user->id)->first();

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



            $response = array(
                'status' => 200,
                'message' => 'OK',
                'member' => $member,
                'user' => $user,
                'morning_schedules' => $morning_schedules,
                'evening_schedules' => $evening_schedules,
            );

            return response()->json($response);
        }
        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }




    /**
     * MISC FUNCTIONS
     */

    function addNewPlan($member_id, $type, $day, $detail)
    {
        Memberplans::create([
            'member_id' => $member_id,
            'type' => $type,
            'day' => $day,
            'detail' => $detail,
        ]);
    }
    function updatePlan($member_id, $type, $day, $detail)
    {
        $plan = Memberplans::where('member_id', $member_id)->where('type', $type)->where('day', $day)->first();

        if ($plan) {
            $plan->detail = $detail;
            $plan->save();
        }
    }
}