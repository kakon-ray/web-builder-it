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

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    function mycourse()
    {

        $activeCourse = ActiveCourse::where('student_id', Auth::guard('student')->user()->id)
            ->with('students')->with('add_course')->get();

        // return $activeCourse;

        $best_review_course = AddCourse::get()->sortByDesc('review_count');
        $best_selling_course = AddCourse::get()->sortByDesc('enrole_count');

        return view('student.mycourse', compact('activeCourse','best_review_course','best_selling_course'));
    }
    function wishlist()
    {

        $activeCourse = ActiveCourse::where('student_id', Auth::guard('student')->user()->id)
            ->with('students')->with('add_course')->get();

        // return $activeCourse;

        $best_review_course = AddCourse::get()->sortByDesc('review_count');
        $best_selling_course = AddCourse::get()->sortByDesc('enrole_count');

        return view('student.wishlist', compact('activeCourse','best_review_course','best_selling_course'));
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
    function cancle_enroll(Request $request)
    {
        
        $cancle_enroll = ActiveCourse::where('id', $request->id)->delete();

        if($cancle_enroll){
            toastr()->success('Course Enroll Cancle');
            return redirect()->route('student.wishlist');
        }else{
            toastr()->error('Course Cancle Faild');
        }
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

           $enroleCount = AddCourse::find($request->course_id);
           $enroleCount->enrole_count = $enroleCount->enrole_count + 1;
           $enroleCount->save();

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
        $studentRegModel = StudentRegModel::find($request->id);
        if (is_null($studentRegModel)) {
            return response()->json([
                'msg' => "Student Doesnt Exists",
                'status' => 404
            ], 404);
        } else {
            if ($request->image) {
                $arrayRequest = [
                    "student_name" => $request->student_name,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "image" => $request->image,
                ];

                $arrayValidate  = [
                    'student_name' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],
                ];
            } else {
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
            }

            $response = Validator::make($arrayRequest, $arrayValidate);

            if ($response->fails()) {
                $msg = '';
                foreach ($response->getMessageBag()->toArray() as $item) {
                    $msg = $item;
                };
                $arr = array('status' => 400, 'msg' => $msg);
                return \Response::json($arr);
            }

            DB::beginTransaction();

            try {


                $slug = Str::slug($request->student_name, '-');

                if ($request->image) {

                    // single thumbnail file delete kora hocce jodi image file delete hoy tarpor databse theke data delete kora hobe
                    $pathinfo = pathinfo($studentRegModel->image);
                    $filename = $pathinfo['basename'];
                    $image_path = public_path("/uploads/") . $filename;

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }


                    $file = $request->file('image');
                    $filename = $slug . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                    $img = Image::make($file);
                    $img->resize(200, 200)->save(public_path('uploads/' . $filename));

                    $host = $_SERVER['HTTP_HOST'];
                    $image = "http://" . $host . "/uploads/" . $filename;
                } else {
                    $image = $request->old_image;
                }


                $studentRegModel->student_name = $request->student_name;
                $studentRegModel->phone = $request->phone;
                $studentRegModel->address = $request->address;
                $studentRegModel->image = $image;
                $studentRegModel->save();

                DB::commit();
            } catch (\Exception $err) {

                DB::rollBack();
                $studentRegModel = null;
            }

            if (is_null($studentRegModel)) {
                return response()->json([
                    'status' => 500,
                    'msg' => 'Internal Server Error',
                    'err_msg' => $err->getMessage()
                ]);
            } else {
                return response()->json([
                    'status' => 200,
                    'msg' => 'Student Update Successfylly'
                ]);
            }
        }
    }
    function student_password_update(Request $request)
    {
        $studentRegModel = StudentRegModel::find($request->id);

        if (is_null($studentRegModel)) {
            return response()->json([
                'msg' => "Student Doesnt Exists",
                'status' => 404
            ]);
        } else {
            if (Hash::check($request->old_password, $studentRegModel->password)) {
                $arrayRequest = [
                    "password" => $request->password,
                    "password_confirmation" => $request->password_confirmation,
                ];

                $arrayValidate  = [
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

                DB::beginTransaction();

                try {

                    $studentRegModel->password = Hash::make($request->password);
                    $studentRegModel->save();

                    DB::commit();
                } catch (\Exception $err) {
                    DB::rollBack();
                    $studentRegModel = null;
                }

                if (is_null($studentRegModel)) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Internal Server Error',
                        'err_msg' => $err->getMessage()
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Password Update Successfylly'
                    ]);
                }
            } else {
                return response()->json([
                    'msg' => "Password not Match",
                    'status' => 404
                ]);
            }
        }
    }

    function classroom(Request $request)
    {
        $activeCourseDetails = ActiveCourse::where('id', $request->id)->with('add_course')->get()[0];
        $activeCourse = ActiveCourse::where('id', $request->id)->get();

        foreach ($activeCourse as $item) {
            $student_tutorial = Tutorial::where('course_id', $item->course_id)->with('add_course')->get();
        }
        // return $tutorial;
        return view('student.classroom', compact('student_tutorial', 'activeCourseDetails'));
    }
    function my_order(Request $request)
    {
        $myorder = Order::where('email', Auth::guard('student')->user()->email)->get();

        // return $tutorial;
        return view('student.my_order', compact('myorder'));
    }
}
