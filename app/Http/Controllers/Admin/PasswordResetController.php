<?php


namespace App\Http\Controllers\Admin;

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

class PasswordResetController extends Controller
{
    function admin_pasword_reset(Request $request)
    {
        return view('admin.passwordreset.password_reset');
    }


    function reset_password_submit(Request $request)
    {

        $request->validate([
            'email' => 'required | email | exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('admin.passwordreset.mailforget', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'we have e-mailed your password rest link!');
    }

    function show_reset_password_form($token)
    {
        return view('admin.passwordreset.show_reset_password_form', ['token' => $token]);
    }


    function new_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
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
            $responce = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

            if ($responce) {
                DB::table('password_resets')->where('email', $request->email)->delete();
                return redirect()->route('admin.login');
            }
        }
    }
}
