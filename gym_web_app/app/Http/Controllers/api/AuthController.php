<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login user
    public function loginUser(Request $request)
    {
        //validate
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (User::where('username', $request->username)->count() == 0) {
            $response = array(
                'status' => 404,
                'message' => 'Username doesnt exist.',
            );
            return response()->json($response);
        }
        $user = User::where('username', $request->username)->first();
        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                // The passwords match...
                //check if rehash needed
                if (Hash::needsRehash($user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                }

                if ($user->type == 'admin') {
                    $response = array(
                        'status' => 404,
                        'message' => 'Invalid Credentials.',
                    );
                    return response()->json($response);
                }

                //check if is member ie verified member

                if ($user->type == 'member') {
                    //check if verified
                    $member = Member::where('user_id', $user->id)->first();
                    if (!$member->verified) {
                        $response = array(
                            'status' => 404,
                            'message' => 'Unverified User',
                        );
                        return response()->json($response);
                    }
                }

                $response = array(
                    'status' => 200,
                    'message' => 'OK',
                    'user' => $user
                );

                return response()->json($response);
            } else {
                $response = array(
                    'status' => 404,
                    'message' => 'Invalid Credentials.',
                );
                return response()->json($response);
            }
        }

        $response = array(
            'status' => 404,
            'message' => 'Some error occured.',
        );
        return response()->json($response);
    }
    public function registerUser(Request $request)
    {
        //validate
        $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if (User::where('username', $request->username)->count() > 0) {
            $response = array(
                'status' => 404,
                'message' => 'Username already exist.',
            );
            return response()->json($response);
        }

        $user =  User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'type' => 'member'
        ]);

        $member = new Member();
        $member->user_id =  $user->id;
        $member->fullname =  $request->fullname;
        $member->phone =  'no';
        $member->address =  'no';
        $member->save();

        $response = array(
            'status' => 200,
            'message' => 'OK',
            'user' => $user,
            'member' => $member,
        );
        return response()->json($response);
    }
}
