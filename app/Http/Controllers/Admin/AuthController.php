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

class AuthController extends Controller
{
    function admin_registaion(Request $request)
    {

        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('admin.login');
        } else {
            $notify[] = ['error', 'Registation Faild'];
            return back()->withNotify($notify);
        }
    }


    function admin_login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $responce1 = User::where('email', $request->email)->where('role', 'admin')->count();
        $responce2 = User::where('email', $request->email)->where('role', 'superadmin')->count();

        if ($responce1 == 1 || $responce2 == 1) {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // return redirect('dashboard');
                $arr = array('status' => 200, 'msg' => 'Successflly Login');
                return \Response::json($arr);
            } else {
                // return back()->with('error','Login Faild Username and Password not Match'); 
                $arr = array('status' => 400, 'msg' => 'Username and Password not Match');
                return \Response::json($arr);
            }
        } else {
            // return back()->with('error','Login Faild Please Check Admin');  
            $arr = array('status' => 400, 'msg' => 'Please Check Admin');
            return \Response::json($arr);
        }
    }

    function register()
    {
        return view('admin.auth.register');
    }


    function login()
    {
        return view('admin.auth.login');
    }

    function admin_logout(Request $request)
    {
        Auth::guard('web')->logout();
        return 1;
    }
}
