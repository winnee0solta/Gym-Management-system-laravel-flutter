<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\Trainers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainersController extends Controller
{
    public function index()
    { 
        $trainers = DB::table('trainers')
        ->join('users', 'users.id', '=', 'trainers.user_id')
        ->select('trainers.*', 'users.username')
        ->paginate(20);
        return view('trainers.trainers', compact('trainers')); 
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
            'type' => 'trainer'
        ]);

        $trainer = new Trainers();

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $unique_id = uniqid();
        //     $filename =  $unique_id . '_photo.' . $file->getClientOriginalExtension();
        //     $file->move('images/pics', $filename);

        //     $trainer->image =  $filename;
        // }

        $trainer->user_id =  $user->id;
        $trainer->fullname =  $request->fullname;
        $trainer->phone =  $request->phone;
        $trainer->address =  $request->address;


        if ($request->has('shift_m') && $request->shift_m) {
            $trainer->shift_m =  true;
        }
        if ($request->has('shift_e') && $request->shift_e) {
            $trainer->shift_e =  true;
        }
        $trainer->save();

        return redirect('/trainers');
    }
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

            //update   db data
            $trainer = Trainers::where('user_id', $user->id)->first();
            if ($trainer) {

                $trainer->fullname =  $request->fullname;
                $trainer->phone =  $request->phone;
                $trainer->address =  $request->address;
                $trainer->shift_m =  false;
                if ($request->has('shift_m')) {
                    if ($request->shift_m) {
                        $trainer->shift_m =  true;
                    }
                }
                $trainer->shift_e =  false;
                if ($request->has('shift_e')) {
                    if ($request->shift_e) {
                        $trainer->shift_e =  true;
                    }
                }
                $trainer->save();


                return redirect('/trainers/view/' . $trainer->id);

               
            }

         
        } else {
            return  back()->withErrors(['User not found !']);
        }

        return redirect('/trainers');
    }

    //view single memeber details
    public function singleTrainers($memebr_id)
    {
        $trainer = Trainers::find($memebr_id);
        if ($trainer) {

            $user = User::find($trainer->user_id);

            return view('trainers.single', compact(
                'trainer',
                'user'
            ));
        }

        return redirect('/trainers');
    }
    //remove  
    public function remove(Request $request)
    {
        $this->validate($request, [
            'trainer_id' => 'required',
        ]);
        $trainer = Trainers::find($request->trainer_id);
        if ($trainer) {
 
            //remove notifications
            Notifications::where('user_id', $trainer->user_id)->delete();

            //remove user
            User::where('id', $trainer->user_id)->delete();

            //remove member
            $trainer->delete();
        }

        return redirect('/trainers');
    }
}
