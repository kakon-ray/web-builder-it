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

class AdminController extends Controller
{


    function user_maintain()
    {
        $all_user = User::get();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/admin_role/user_maintain', ['all_user' => $all_user, 'current_user_data' => $current_user_data]);
    }
    function delete_user(Request $request)
    {
        $id = $request->input('id');
        $responce = User::where('id', $id)->delete();

        if ($responce == true) {
            $arr = ['status' => 200, 'msg' => "Deleted Admin Request"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Faild"];
            return \Response::json($arr);
        }
    }
    function make_admin(Request $request)
    {
        $id = $request->input('id');

        $user = User::find($id);
        $user->role = 'admin';
        $responce = $user->save();

        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => 'Make Admin Successfully');
            return \Response::json($arr);
        } else {
            $arr = array('status' => 200, 'msg' => 'Faild');
            return \Response::json($arr);
        }
    }
    function cancle_admin(Request $request)
    {
        $id = $request->input('id');

        $user = user::find($id);
        $user->role = '';
        $responce = $user->save();

        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => 'Cancle Admin Successfully');
            return \Response::json($arr);
        } else {
            $arr = array('status' => 200, 'msg' => 'Faild');
            return \Response::json($arr);
        }
    }
}
