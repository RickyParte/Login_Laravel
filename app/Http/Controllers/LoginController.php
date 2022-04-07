<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;

class LoginController extends Controller
{
    function login(Request $request)
    {
        // First Logic
        // Validation
        $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

        // Retrieve Data From Table and check where condition
        $check=DB::select('select * from users where email = ?',[$request->email]);

        // Check which user has same password as inputed password
        foreach($check as $c)
        {
        $password=$c->password;
        $sessionUser=$c->name;
            // if password match then redirected to dashboard else give error
            if(Hash::check($request->password, $password))
            {
                $request->session()->put('user', $sessionUser);
                return redirect('/dashboard');
            }
            else{
                return redirect('/')->with("error","Please Enter Correct Credentials!");
            }
        }



    }

    // Second Logic
    function loginUser(Request $request)
    {
        // get user where email same as inputed email
        $getCredential=User::where('email',$request->email)->first();

        // user is not null and password same as database password then login otherwise error
        if($getCredential && Hash::check($request->password, $getCredential->password))
        {
            $sessionUser=$getCredential->name;
            $request->session()->put('user', $sessionUser);
            return redirect('/dashboard');
        }
        else
        {
            return redirect('/')->with("error","Please Enter Correct Credentials!");
        }

    }

    function makeLogin()
    {
        // get user where email same as inputed email
        $getCredential=User::where('email',$request->email)->get();

        $data=compact($getCredential);

        // user is not null and password same as database password then login otherwise error
        if(count($getCredential)>0 && Hash::check($request->password, $data['password']))
        {
            $sessionUser=$data['name'];
            $request->session()->put('user', $sessionUser);
            return redirect('/dashboard');
        }
        else
        {
            return redirect('/')->with("error","Please Enter Correct Credentials!");
        }
    }

    //Logout Function
    function logout()
    {
        // User has session then reset to null and redirect
        if(session()->has('user'))
        {
            session()->pull('user', null);
        }
        return redirect('/')->with("message","Logout Successfully!!");
    }
}
