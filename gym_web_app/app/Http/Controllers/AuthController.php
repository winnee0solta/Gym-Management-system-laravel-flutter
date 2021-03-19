<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginView()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // return $request;
        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];
        // return $credentials;    
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            return  back()->withErrors(['Invalid Credentials !']);
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
