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
use Illuminate\Support\Facades\Validator;
// password reset to import
use Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

// login with google
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    function student_login_form()
    {
        return view('student.student_login_form');
    }


    function student_registation()
    {
        return view('student.student_reg');
    }

    function student_registation_sub(Request $request)
    {

        $arrayRequest = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "password_confirmation" => $request->password_confirmation,
        ];

        $arrayValidate  = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . StudentRegModel::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $response = Validator::make($arrayRequest, $arrayValidate);

        if ($response->fails()) {
            $msg = '';
            foreach ($response->getMessageBag()->toArray() as $item) {
                $msg = $item;
            };
            $arr = array('status' => 400, 'msg' => $msg);
            return \Response::json($arr);
        }


        $user = StudentRegModel::create([
            'student_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        if ($user) {
            $arr = array('status' => 200, 'msg' => 'Registation Completed');
            return \Response::json($arr);
        } else {
            $arr = array('status' => 400, 'msg' => 'Registation Faild');
            return \Response::json($arr);
        }
    }

    function student_login_sub(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // return redirect('dashboard');
            $arr = array('status' => 200, 'msg' => 'Successflly Login');
            return \Response::json($arr);
        } else {
            // return back()->with('error','Login Faild Username and Password not Match'); 
            $arr = array('status' => 400, 'msg' => 'Username and Password not Match');
            return \Response::json($arr);
        }
    }
}
