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
use App\Models\Order;

use App\Models\User;
use App\Models\StudentRegModel;
use App\Models\SeminerModel;
use App\Models\Tutorial;
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

class StudentController extends Controller
{

    function mycourse()
    {

        $activeCourse = ActiveCourse::where('student_id', Auth::guard('student')->user()->id)
            ->with('students')->with('add_course')->get();

        // return $activeCourse;
        return view('student.mycourse', ['activeCourse' => $activeCourse]);
    }

    function profile()
    {
        return view('student.profile');
    }


    function checkout(Request $request)
    {
        $course_details = ActiveCourse::where('id', $request->id)->with('add_course')->get()[0];
        $course_details =  $course_details->add_course;
        $active_course_id = $request->id;
        return view('student.checkout', ['course_details' => $course_details, 'active_course_id' => $active_course_id]);
    }


    function student_logout(Request $request)
    {
        Auth::guard('student')->logout();
        return 1;
    }

    function active_course_add(Request $request)
    {

        $already_id = ActiveCourse::where('student_id', Auth::guard('student')
            ->user()->id)->where('course_id', $request->course_id)->count();
        $count = ActiveCourse::count();


        if ($already_id == 0) {
            $responce = ActiveCourse::create([
                'student_id' => Auth::guard('student')->user()->id,
                'course_id' => $request->course_id,
                'pement_clear' => 0,
                'status' => false,
            ]);

            if ($responce) {
                $arr = array('status' => 200, 'id' => $count + 1, 'msg' => 'Course Add Your Profile');
                return \Response::json($arr);
            }
        } else {
            $arr = array('status' => 400, 'msg' => 'Already Add this Course');
            return \Response::json($arr);
        }
    }

    // student profile update

    function student_profile_update(Request $request)
    {


        $arrayRequest = [
            "student_name" => $request->student_name,
            "phone" => $request->phone,
            "address" => $request->address,
        ];

        $arrayValidate  = [
            'student_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
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

        $studentRegModel = StudentRegModel::find($request->id);
        $studentRegModel->student_name = $request->student_name;
        $studentRegModel->phone = $request->phone;
        $studentRegModel->address = $request->address;


        $responce = $studentRegModel->save();

        if ($responce) {
            $arr = array('status' => 200, 'msg' => 'Your Profile Updated');
            return \Response::json($arr);
        } else {
            $arr = array('status' => 400, 'msg' => 'Profile Updated Faild');
            return \Response::json($arr);
        }
    }

    function classroom(Request $request)
    {
        $activeCourse = ActiveCourse::where('id', $request->id)->get();

        foreach ($activeCourse as $item) {
            $student_tutorial = Tutorial::where('course_id', $item->course_id)->with('add_course')->get();
        }
        // return $tutorial;
        if(isset($student_tutorial)){
            return view('student.classroom', ['student_tutorial' => $student_tutorial]);
        }else{
            return view('student.classroom');
        }
        
    }
    function my_order(Request $request)
    {
        $myorder = Order::where('email', Auth::guard('student')->user()->email)->get();

        // return $tutorial;
        return view('student.my_order', compact('myorder'));
    }
}
