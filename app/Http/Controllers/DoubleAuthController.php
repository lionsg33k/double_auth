<?php

namespace App\Http\Controllers;

use App\Mail\AuthMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DoubleAuthController extends Controller
{
    //

    public function index()
    {
        return view("auth.2fa");
    }

    public function authSwitcher()
    {
        //* method 1

        $user = User::where("id", auth()->user()->id)->first();

        //* method 2
        // $user = Auth::user();

        $code = rand(100000, 999999);

        if ($user) {
            $user->double_auth = !$user->double_auth;
            $user->auth_validate = $user->double_auth ? false : true;
            $user->save();
            if ($user->double_auth) {

                Mail::to($user->email)->send(new AuthMailer($code));
                $user->validation_code = $code;
                $user->save();    
                return redirect()->route("2fa");

            }
        }
        return back();

    }

    public function validate2fa(Request $request)
    {

        request()->validate([
            "code" => "required"
        ]);
        //* method 1 
        // $user = $request->user();

        // 
        $user = User::where("id", auth()->user()->id)->first();

        if ($request->code == $user->validation_code) {

            $user->auth_validate = true;
            $user->save();
            return redirect()->route("dashboard");
        }else {
            return back();
        }

    }
}
