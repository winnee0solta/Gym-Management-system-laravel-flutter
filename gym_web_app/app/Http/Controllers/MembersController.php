<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Memberbodystatus;
use App\Models\Memberplans;
use App\Models\Memberschedules;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    public function index()
    {
        // $members = Member::get();

        $members = DB::table('members')
            ->join('users', 'users.id', '=', 'members.user_id')
            ->select('members.*', 'users.username')
            ->paginate(20);
        return view('members.members', compact('members'));
    }
    //adds member detail in db
    public function add(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        //check if username already exists
        if (User::where('username', $request->username)->count() > 0) {
            return  back()->withErrors(['Username Already Exists !']);
        }
        //create new user
        $user =  User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'type' => 'member'
        ]);

        $member = new Member();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $unique_id = uniqid();
            $filename =  $unique_id . '_photo.' . $file->getClientOriginalExtension();
            $file->move('images/pics', $filename);

            $member->image =  $filename;
        }

        $member->user_id =  $user->id;
        $member->fullname =  $request->fullname;
        $member->phone =  $request->phone;
        $member->address =  $request->address;
        $member->verified =  true;

        if ($request->has('shift_m') && $request->shift_m) {
            $member->shift_m =  true;
        }
        if ($request->has('shift_e') && $request->shift_e) {
            $member->shift_e =  true;
        }

        $member->save();

        return redirect('/members');
    }
    //updates members detail in db
    public function update(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'user_id' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'username' => 'required',
        ]);

        //check if user_id exists
        $user = User::find($request->user_id);
        // return $request;
        if ($user) {

            //update user db details
            $user->username =  $request->username;
            $user->save();

            //update members db data
            $member = Member::where('user_id', $user->id)->first();
            if ($member) {

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $unique_id = uniqid();
                    $filename =  $unique_id . '_photo.' . $file->getClientOriginalExtension();
                    $file->move('images/pics', $filename);
                    $member->image =  $filename;
                }
            }

            $member->fullname =  $request->fullname;
            $member->phone =  $request->phone;
            $member->address =  $request->address;
            $member->shift_m =  false;
            if ($request->has('shift_m')) {
                if ($request->shift_m) {
                    $member->shift_m =  true;
                }
            }
            $member->shift_e =  false;
            if ($request->has('shift_e')) {
                if ($request->shift_e) {
                    $member->shift_e =  true;
                }
            }
            $member->save();


            return redirect('/members/view/' . $member->id);
        } else {
            return  back()->withErrors(['User not found !']);
        }

        return redirect('/members');
    }

    //view single memeber details
    public function singleMember($memebr_id)
    {
        $member = Member::find($memebr_id);
        if ($member) {

            $user = User::find($member->user_id);

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

            //body status
            $bodystatus = Memberbodystatus::where('member_id', $member->id)->first();


            return view('members.single', compact(
                'nutrition_plans',
                'workout_plans',
                'bodystatus',
                'member',
                'user'
            ));
        }

        return redirect('/members');
    }

    //change member verified status 
    public function memberChangeStatus($memebr_id)
    {
        $member = Member::find($memebr_id);
        if ($member) {
            $member->verified = !$member->verified;
            $member->save();


            return redirect('/members/view/' . $member->id);
        }

        return redirect('/members');
    }
    //remove member
    public function removeMember(Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required',
        ]);
        $member = Member::find($request->member_id);
        if ($member) {
            //remove notifications
            Notifications::where('user_id', $member->user_id)->delete();
            //remove plans
            Memberplans::where('member_id', $member->id)->delete();
            //remove schedule
            Memberschedules::where('member_id', $member->id)->delete();
            //remove user
            User::where('id', $member->user_id)->delete();

            //remove member
            $member->delete();
        }

        return redirect('/members');
    }

    //add/update member nutrintion plan
    public function memberNutritionPlan($member_id, Request $request)
    {
        $member = Member::find($member_id);
        if ($member) {


            if ($request->has('sunday') && $request->sunday != '') {

                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'sunday')->count() == 0) {

                    $this->addNewPlan($member->id, 'nutrition', 'sunday', $request->sunday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'sunday', $request->sunday);
                }
            }
            if ($request->has('monday') && $request->monday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'monday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'nutrition', 'monday', $request->monday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'monday', $request->monday);
                }
            }
            if ($request->has('tuesday') && $request->tuesday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'tuesday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'nutrition', 'tuesday', $request->tuesday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'tuesday', $request->tuesday);
                }
            }
            if ($request->has('wednesday') && $request->wednesday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'wednesday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'nutrition', 'wednesday', $request->wednesday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'wednesday', $request->wednesday);
                }
            }
            if ($request->has('thursday') && $request->thursday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'thursday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'nutrition', 'thursday', $request->thursday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'thursday', $request->thursday);
                }
            }
            if ($request->has('friday') && $request->friday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'friday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'nutrition', 'friday', $request->friday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'friday', $request->friday);
                }
            }
            if ($request->has('saturday') && $request->saturday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'nutrition')->where('day', 'saturday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'nutrition', 'saturday', $request->saturday);
                } else {
                    $this->updatePlan($member->id, 'nutrition', 'saturday', $request->saturday);
                }
            }
            return redirect('/members/view/' . $member->id);
        }

        return redirect('/members');
    }
    //add/update member workout plan
    public function memberWorkoutPlan($member_id, Request $request)
    {
        $member = Member::find($member_id);
        if ($member) {


            if ($request->has('sunday') && $request->sunday != '') {

                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'sunday')->count() == 0) {

                    $this->addNewPlan($member->id, 'workout', 'sunday', $request->sunday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'sunday', $request->sunday);
                }
            }
            if ($request->has('monday') && $request->monday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'monday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'workout', 'monday', $request->monday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'monday', $request->monday);
                }
            }
            if ($request->has('tuesday') && $request->tuesday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'tuesday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'workout', 'tuesday', $request->tuesday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'tuesday', $request->tuesday);
                }
            }
            if ($request->has('wednesday') && $request->wednesday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'wednesday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'workout', 'wednesday', $request->wednesday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'wednesday', $request->wednesday);
                }
            }
            if ($request->has('thursday') && $request->thursday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'thursday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'workout', 'thursday', $request->thursday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'thursday', $request->thursday);
                }
            }
            if ($request->has('friday') && $request->friday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'friday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'workout', 'friday', $request->friday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'friday', $request->friday);
                }
            }
            if ($request->has('saturday') && $request->saturday != '') {
                if (Memberplans::where('member_id', $member->id)->where('type', 'workout')->where('day', 'saturday')->count() ==  0) {

                    $this->addNewPlan($member->id, 'workout', 'saturday', $request->saturday);
                } else {
                    $this->updatePlan($member->id, 'workout', 'saturday', $request->saturday);
                }
            }

            return redirect('/members/view/' . $member->id);
        }

        return redirect('/members');
    }

    //add/update member body status
    public function memberBodyStatus($member_id, Request $request)
    {
        $member = Member::find($member_id);
        if ($member) {

            if (Memberbodystatus::where('member_id', $member->id)->count() > 0) {
                $bodystatus = Memberbodystatus::where('member_id', $member->id)->first();
            } else {
                $bodystatus = new Memberbodystatus();
                $bodystatus->member_id = $member->id;
            }


            $bodystatus->weight = $request->weight;
            $bodystatus->height = $request->height;
            $bodystatus->chest = $request->chest;
            $bodystatus->stomach = $request->stomach;
            $bodystatus->biceps = $request->biceps;
            $bodystatus->thighs = $request->thighs;
            $bodystatus->save();




            return redirect('/members/view/' . $member->id);
        }

        return redirect('/members');
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
