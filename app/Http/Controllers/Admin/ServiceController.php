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

class ServiceController extends Controller
{
    function add_services_submit(Request $request)
    {
        $arrayRequest = [
            "services_title" => $request->services_title,
            "services_img" => $request->services_img,
            "description" => $request->description,
        ];

        $arrayValidate  = [
            'services_title' => 'required',
            'services_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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


        $img = $request->services_img;
        $services_img =  $img->store('/public/services_img');
        $services_img = (explode('/', $services_img))[2];
        $host = $_SERVER['HTTP_HOST'];
        $services_img = "http://" . $host . "/storage/services_img/" . $services_img;

        // insert data to AddCourse Model

        $addServices = new AddServices();
        $addServices->services_title = $request->services_title;
        $addServices->desc = $request->description;
        $addServices->services_img = $services_img;


        $responce = $addServices->save();


        if ($responce == 1) {
            $arr = array('status' => 200, 'msg' => 'Successflly Add Services');
            return \Response::json($arr);
        }
    }

    function add_services()
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/services/add_services', ['current_user_data' => $current_user_data]);
    }

    function dashboard_services()
    {
        $course_admission = ServicesModel::get();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/services/dashboard_services', ['course_admission' => $course_admission, 'current_user_data' => $current_user_data]);
    }

    function delete_services_message(Request $request)
    {
        $id = $request->input('id');

        $responce = ServicesModel::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Services Message"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Services Message Faild"];
            return \Response::json($arr);
        }
    }

    function manage_services(Request $request)
    {
        $allServices = AddServices::get()->reverse();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/services/manage_services', ['allServices' => $allServices, 'current_user_data' => $current_user_data]);
    }

    function delete_services(Request $request)
    {
        $id = $request->input('id');

        $responce = AddServices::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Services Item"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Services Item Faild"];
            return \Response::json($arr);
        }
    }

    function edit_services(Request $request)
    {
        $id = $request->id;
        $services_details = AddServices::where('id', $id)->first();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/services/edit_services', ['services_details' => $services_details, 'current_user_data' => $current_user_data]);
    }

    function edit_services_submit(Request $request)
    {

        $arrayRequest = [
            "services_title" => $request->services_title,
            "description" => $request->description,
        ];

        $arrayValidate  = [
            'services_title' => 'required',
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

        if ($request->services_img_link) {
            $addServices = AddServices::find($request->id);
            $addServices->services_title = $request->services_title;
            $addServices->desc = $request->description;
            $addServices->services_img = $request->services_img_link;

            $responce = $addServices->save();
        }

        $img = $request->services_img;
        if ($img) {
            $services_img =  $img->store('/public/services_img');
            $services_img = (explode('/', $services_img))[2];
            $host = $_SERVER['HTTP_HOST'];
            $services_img = "http://" . $host . "/storage/services_img/" . $services_img;


            $addServices = AddServices::find($request->id);
            $addServices->services_title = $request->services_title;
            $addServices->desc = $request->description;
            $addServices->services_img = $services_img;

            $responce = $addServices->save();
        }




        if ($responce == 1) {
            $arr = array('status' => 200, 'msg' => 'Course Edit Successfully');
            return \Response::json($arr);
        }
    }
}
