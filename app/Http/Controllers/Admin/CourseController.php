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
use Illuminate\Support\Facades\Validator;

// password reset to import
use Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    function course_message()
    {
        $course_admission = CourseModel::get();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/course/course_message', ['course_admission' => $course_admission, 'current_user_data' => $current_user_data]);
    }


    function add_course()
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/course/add_course', ['current_user_data' => $current_user_data]);
    }


    function add_course_submit(Request $request)
    {
        $arrayRequest = [
            "course_title" => $request->course_title,
            "course_fee" => $request->course_fee,
            "course_img" => $request->course_img,
            "description" => $request->description,
        ];

        $arrayValidate  = [
            'course_title' => 'required',
            'course_fee' => ['required', 'integer'],
            'course_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => 'required',
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


        $img = $request->course_img;
        $course_img =  $img->store('/public/course_img');
        $course_img = (explode('/', $course_img))[2];
        $host = $_SERVER['HTTP_HOST'];
        $course_img = "http://" . $host . "/storage/course_img/" . $course_img;

        // insert data to AddCourse Model

        $addCourse = new AddCourse();
        $addCourse->course_title = $request->course_title;
        $addCourse->course_fee = $request->course_fee;
        $addCourse->course_img = $course_img;
        $addCourse->desc = $request->description;

        $responce = $addCourse->save();


        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => 'Successflly Add Course');
            return \Response::json($arr);
        }
    }


    function delete_course_message(Request $request)
    {
        $id = $request->input('id');

        $responce = CourseModel::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Course Message"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Course Message Faild"];
            return \Response::json($arr);
        }
    }

    function manage_course(Request $request)
    {
        $allCourse = AddCourse::get();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/course/manage_course', ['allCourse' => $allCourse, 'current_user_data' => $current_user_data]);
    }

    function delete_course(Request $request)
    {
        $id = $request->input('id');

        $responce = AddCourse::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Course"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Course Faild"];
            return \Response::json($arr);
        }
    }

    function edit_course(Request $request)
    {
        $id = $request->id;
        $course_details = AddCourse::where('id', $id)->first();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/course/edit_course', ['course_details' => $course_details, 'current_user_data' => $current_user_data]);
    }

    function edit_course_submit(Request $request)
    {

        $arrayRequest = [
            "course_title" => $request->course_title,
            "course_fee" => $request->course_fee,
            "description" => $request->description,
        ];

        $arrayValidate  = [
            'course_title' => 'required',
            'course_fee' => ['required', 'integer'],
            'description' => 'required',
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


        // insert data to AddCourse Model

        if ($request->course_img_link) {
            $addCourse = AddCourse::find($request->id);
            $addCourse->course_title = $request->course_title;
            $addCourse->course_fee = $request->course_fee;
            $addCourse->course_img = $request->course_img_link;
            $addCourse->desc = $request->description;

            $responce = $addCourse->save();
        }



        $img = $request->course_img;
        if ($img) {
            $course_img =  $img->store('/public/course_img');
            $course_img = (explode('/', $course_img))[2];
            $host = $_SERVER['HTTP_HOST'];
            $course_img = "http://" . $host . "/storage/course_img/" . $course_img;


            $addCourse = AddCourse::find($request->id);
            $addCourse->course_title = $request->course_title;
            $addCourse->course_fee = $request->course_fee;
            $addCourse->course_img = $course_img;
            $addCourse->desc = $request->description;

            $responce = $addCourse->save();
        }




        if ($responce) {
            $arr = array('status' => 200, 'msg' => 'Course Edit Successfully');
            return \Response::json($arr);
        }
    }

    // add course  ck editor image upload
    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('img/course'), $fileName);

            $url = asset('img/course/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    function active_course(Request $request)
    {
        $id = $request->input('id');

        $addCourse = AddCourse::find($id);
        $addCourse->status = true;
        $responce = $addCourse->save();

        if ($responce) {
            $arr = ['status' => 200, 'msg' => "Course Active Success"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 400, 'msg' => "Course not active"];
            return \Response::json($arr);
        }
    }
    function deactive_course(Request $request)
    {
        $id = $request->input('id');

        $addCourse = AddCourse::find($id);
        $addCourse->status = false;
        $responce = $addCourse->save();

        if ($responce) {
            $arr = ['status' => 200, 'msg' => "Course Inactiveted"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 400, 'msg' => "Course not Inactive"];
            return \Response::json($arr);
        }
    }
}
