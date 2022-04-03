<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginController extends Controller
{
    function login(Request $request)
    {
        // First Logic
        // Retrieve Data From Table and check where condition
        $check=DB::select('select * from users where email = ?',[$request->email]);

        // Check which user has same password as inputed password
        foreach($check as $c)
        {
            $pass=$c->pass;
            $sessionUser=$c->name;
            // if password match then redirected to dashboard else give error
            if(Hash::check($request->password, $pass))
            {
                $request->session()->put('user', $sessionUser);
                return redirect('/dashboard');
            }
            else{
                return redirect('/')->with("error","Please Enter Correct Credentials!");
            }
        }

    }
    function logout()
    {
        if(session()->has('user'))
        {
            session()->pull('user', null);
        }
        return redirect('/')->with("message","Logout Successfully!!");
    }
}
