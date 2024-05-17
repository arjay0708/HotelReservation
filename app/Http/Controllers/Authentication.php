<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\userVerify;
use App\Mail\userVerifyMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Authentication extends Controller
{
    // ROUTING
    public function login()
    {
        return view('login');
    }

    public function registration()
    {
        return view('registration');
    }

    public function adminLogin()
    {
        return view('adminLogin');
    }

    public function privacyPolicy()
    {
        return view('privacyPolicy');
    }
    public function dataPrivacy()
    {
        return view('dataPrivacy');
    }
    public function notesRemarks()
    {
        return view('notedAndRemarks');
    }
    // ROUTING

    // FUNCTION FOR REGISTRATION
    public function registrationFunction(Request $request)
    {
        $existingEmail = User::select('email')->where('email', '=', $request->userEmailAddress)->get();
        if ($existingEmail->isNotEmpty()) {
            return response()->json(2);
        } else {
            $registration = User::create([
                'photos' => '/storage/userPhotos/defaultImage.jpg',
                'lastname' => $request->userLastName,
                'firstname' => $request->userFirstName,
                'middlename' => $request->userMiddleName,
                'extention' => $request->userExtension,
                'email' => $request->userEmailAddress,
                'phoneNumber' => $request->userPhone,
                'birthday' => $request->userBirthdate,
                'age' => $request->userAge,
                'password' => Hash::make($request->userPassword),
                'is_active' => 1,
                'is_admin' => 0,
                'email_verified' => 0,
            ]);

            $token = Str::random(64);

            userVerify::create([
                'user_id' => $registration->user_id,
                'token' => $token
            ]);

            $email = $request->userEmailAddress;
            Mail::send('layouts.emailVerificationEmail', ['token' => $token], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Verify your Email');
            });

            return response()->json(1);
        }
    }

    // FUNCTION FOR REGISTRATION

    // EMAIL VERIFICATION
    public function userVerify($token)
    {
        $verifyUser = userVerify::where('token', $token)->first();

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user_id;
            User::where([['user_id', '=', $user]])
                ->update(['email_verified' => 1]);
            return redirect()->to('login')->with('message', 'Email verified successfully!');
        }
    }
    // EMAIL VERIFICATION

    // FUNCTION FOR USER LOGIN
    protected function userCredentials(Request $request)
    {
        return [
            'email' => request()->userEmail,
            'password' => request()->userLoginPassword,
        ];
    }

    public function userLoginFunction(Request $request)
    {
        if (auth()->guard('userModel')->attempt($this->userCredentials($request))) {
            if (auth()->guard('userModel')->user()->is_active != 0) {
                if (auth()->guard('userModel')->user()->is_admin !== 1) {
                    if (auth()->guard('userModel')->user()->email_verified == 1) {
                        $request->session()->regenerate();
                        return response()->json(1);
                    } else {
                        return response()->json(2); // NOT VERIFIED EMAIL
                    }
                } else {
                    return response()->json(0);  // IS ADMIN
                }
            } else {
                return response()->json(3);  // INACTIVE ACCOUNT
            }
        } else {
            return response()->json(0); // WRONG CREDENTIALS
        }
    }
    // FUNCTION FOR USER LOGIN

    // FUNCTION FOR ADMIN LOGIN
    protected function adminCredentials(Request $request)
    {
        return [
            'email' => request()->adminEmail,
            'password' => request()->adminPassword,
        ];
    }

    public function adminLoginFunction(Request $request)
    {
        if (auth()->guard('userModel')->attempt($this->adminCredentials($request))) {
            if (auth()->guard('userModel')->user()->is_admin === 1) {
                $request->session()->regenerate();
                return response()->json(1);
            } else {
                return response()->json(0);  // NOT ADMIN
            }
        } else {
            return response()->json(0); // WRONG CREDENTIALS
        }
    }
    // FUNCTION FOR ADMIN LOGIN

    // LOGOUT FUNCTION
    public function logoutFunction()
    {
        $updateUtilized = User::where('user_id', '=', auth()->guard('userModel')->user()->user_id)
            ->update(array('updated_at' => now()));
        if ($updateUtilized) {
            Session::flush();
            Auth::logout();
            return response()->json(1);
        }
    }
    // LOGOUT FUNCTION

}
