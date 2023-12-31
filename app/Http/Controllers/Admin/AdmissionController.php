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
use App\Models\Order;
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

class AdmissionController extends Controller
{
    function addmission(Request $request)
    {
        $activeCourse = ActiveCourse::with('students')->with('add_course')->get();
        // return $activeCourse;
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/admission/dashboard_addmission', ['activeCourse' => $activeCourse, 'current_user_data' => $current_user_data]);
    }

    function pement_request(Request $request)
    {
        $pement_request = Order::all();
        return view('admin/admission/pement_request', compact('pement_request'));
    }

    function delete_admission_sutdent(Request $request)
    {
        $id = $request->input('id');

        $responce = ActiveCourse::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Delete Student Successfully"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Student Faild"];
            return \Response::json($arr);
        }
    }

    function admission_sutdent_details(Request $request)
    {
        $id = $request->id;
        $course_request = ActiveCourse::where('id', $id)->with('students')->with('add_course')->get()[0];
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/admission/admission_dashboard_details', ['course_request' => $course_request, 'current_user_data' => $current_user_data]);
    }

    function active_admission_sutdent(Request $request)
    {
        $id = $request->input('id');

        $activeCourse = ActiveCourse::find($id);
        $activeCourse->status = true;
        $responce = $activeCourse->save();

        if ($responce) {
            $arr = ['status' => 200, 'msg' => "Course Active"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 400, 'msg' => "Course not active"];
            return \Response::json($arr);
        }
    }

    function deactive_admission_sutdent(Request $request)
    {
        $id = $request->input('id');

        $activeCourse = ActiveCourse::find($id);
        $activeCourse->status = false;
        $responce = $activeCourse->save();

        if ($responce) {
            $arr = ['status' => 200, 'msg' => "Course De-Actived"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 400, 'msg' => "Course not De-Active"];
            return \Response::json($arr);
        }
    }

    function add_pement_student_data(Request $request)
    {
        $id = $request->input('id');
        $add_pement_student_data = ActiveCourse::where('id', $id)->with('students')->with('add_course')->get()[0];
        if ($add_pement_student_data) {
            return \Response::json($add_pement_student_data);
        }
    }

    function add_pement_submit(Request $request)
    {
        $set_student_id = $request->input('set_student_id');
        $add_pement_amount = $request->input('add_pement_amount');

        if (!$set_student_id ||  !$add_pement_amount) {
            $arr = ['status' => 400, 'msg' => "Please all input field filup"];
            return \Response::json($arr);
        }

        $old_data = ActiveCourse::where('id', $set_student_id)->first();
        $add_pement_amount = $old_data->pement_clear + $add_pement_amount;


        $activeCourse = ActiveCourse::find($set_student_id);
        $activeCourse->pement_clear = $add_pement_amount;
        $responce = $activeCourse->save();


        if ($responce) {
            $arr = ['status' => 200, 'msg' => "Successfully Add Pement"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 400, 'msg' => "Pement not Add"];
            return \Response::json($arr);
        }
    }

    function add_account_main_account(Request $request)
    {

        // return $request->all();

        $activeCourse = ActiveCourse::find($request->active_course_id);
        $activeCourse->pement_clear = $activeCourse->pement_clear + $request->amount;
        $responce = $activeCourse->save();


        if ($responce) {
            $order = Order::find($request->id);
            $order->status = 'Approved';
            $ordermodyfyres = $order->save();

            if ($ordermodyfyres) {
                $arr = ['status' => 200, 'msg' => "Successfully Add Pement"];
                return \Response::json($arr);
            } else {
                $arr = ['status' => 400, 'msg' => "Pement not Add"];
                return \Response::json($arr);
            }
        } else {
            $arr = ['status' => 400, 'msg' => "Pement not Add"];
            return \Response::json($arr);
        }
    }
    function unaccepted_account_main_account(Request $request)
    {

        // return $request->all();

        $activeCourse = ActiveCourse::find($request->active_course_id);
        $activeCourse->pement_clear = $activeCourse->pement_clear - $request->amount;
        $responce = $activeCourse->save();


        if ($responce) {
            $order = Order::find($request->id);
            $order->status = 'Pending';
            $ordermodyfyres = $order->save();

            if ($ordermodyfyres) {
                $arr = ['status' => 200, 'msg' => "Successfully Unaccepted Pement"];
                return \Response::json($arr);
            } else {
                $arr = ['status' => 400, 'msg' => "Invalide Pement"];
                return \Response::json($arr);
            }
        } else {
            $arr = ['status' => 400, 'msg' => "Pement not Add"];
            return \Response::json($arr);
        }
    }

    function delete_pement_request(Request $request)
    {
        $id = $request->input('id');

        $responce = Order::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Delete Student Successfully"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Student Faild"];
            return \Response::json($arr);
        }
    }
    function all_student(Request $request)
    {
        $students = StudentRegModel::all();
        $activeCourseWithSudents = StudentRegModel::with('active_course')->get();
       return view('admin.admission.all_student',compact('students','activeCourseWithSudents'));
    }

    function course_activity(Request $request)
    {
        $allCourse = AddCourse::all();
        $addCourseWithActiveCourse= AddCourse::with('active_course')->get();
       return view('admin.admission.all_course_activity',compact('allCourse','addCourseWithActiveCourse'));
    }

    function course_activity_details(Request $request)
    {
        $activeCourse = ActiveCourse::with('students')->with('add_course')->get();
        $course_id = $request->id;
       return view('admin.admission.course_activity_details',compact('activeCourse','course_id'));
    }
}
