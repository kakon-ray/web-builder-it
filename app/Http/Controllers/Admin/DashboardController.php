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
use App\Models\Order;
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

class DashboardController extends Controller
{

    function dashboard(Request $request)
    {

        // return $course_message->count();
        $activeCourse = ActiveCourse::with('students')->with('add_course')->get();
        $students = StudentRegModel::all();
        $order = Order::all();
        $ApprovedPementRequest = Order::where('status','Approved')->count();
        $PendingPementRequest = Order::where('status','Pending')->count();


        $total_course_fee = 0;
        $total_pement_clear = 0;
        $active_course = 0;
        $un_active_course = 0;


        foreach ($activeCourse as $item) {
            if (isset($item->add_course->course_fee) != null) {
                $total_course_fee = $total_course_fee + $item->add_course->new_course_fee;
                $total_pement_clear = $total_pement_clear + $item->pement_clear;
                $active_course = ActiveCourse::where('status', true)->count();
                $un_active_course = ActiveCourse::where('status', false)->count();
            }
        }

        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/dashboard/dashboard', [
            'current_user_data' => $current_user_data,
            'total_course_fee' => $total_course_fee,
            'total_pement_clear' => $total_pement_clear,
            'active_course' => $active_course,
            'un_active_course' => $un_active_course,
            'students'=>$students,
            'order'=>$order,
            'ApprovedPementRequest'=>$ApprovedPementRequest,
            'PendingPementRequest'=>$PendingPementRequest
        ]);
    }


    function get_chart_data(Request $request)
    {
        $activeCourse = ActiveCourse::with('students')->with('add_course')->get();

        $total_course_fee = 0;
        $total_pement_clear = 0;

        foreach ($activeCourse as $item) {
            $total_course_fee = $total_course_fee + $item->add_course->course_fee;
            $total_pement_clear = $total_pement_clear + $item->pement_clear;
        }

        return \Response::json(['total_course_fee' => $total_course_fee, 'total_pement_clear' => $total_pement_clear]);
    }
}
