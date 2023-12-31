<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// course admission and service admission
use App\Models\CourseModel;
use App\Models\ServicesModel;

// home page course and service
use App\Models\AddCourse;
use App\Models\AddServices;

use App\Models\User;
use App\Models\StudentRegModel;
use App\Models\SeminerModel;
use App\Models\GalleryModel;
use App\Models\ActiveCourse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Views\Components\header;
use Illuminate\Validation\Rules;

// password reset to import
use Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

// login with google
use Laravel\Socialite\Facades\Socialite;

class PasswordResetController extends Controller
{
    // password reset code
    function password_reset(Request $request)
    {
        return view('student.passwordreset.password_reset');
    }

    function reset_password_submit(Request $request)
    {

        $request->validate([
            'email' => 'required | email | exists:student_reg_models',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('student.reset.password',['token'=>$token,'email'=>$request->email]);
        Mail::send('student.passwordreset.mailforget', ['action_link'=>$action_link], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'we have e-mailed your password rest link!');
    }

    function show_reset_password_form(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('student.passwordreset.show_reset_password_form', ['token' => $token,'email'=>$email]);
    }

    function new_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:student_reg_models',
            'password' => 'required|string|min:8|',
            'confirm_password' => 'required',
        ]);

        $updatepassword = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$updatepassword) {
            return back()->with('error', 'Invalid');
        } else {
            $responce = StudentRegModel::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

            if ($responce) {
                DB::table('password_resets')->where('email', $request->email)->delete();
                return redirect()->route('student.login');
            }
        }
    }
}
