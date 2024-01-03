<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// course admission and service admission
use App\Models\CourseModel;
use App\Models\ServicesModel;

// home page course and service
use App\Models\AddCourse;
use App\Models\AddServices;

use App\Models\User;
use App\Models\AdmissionModel;
use App\Models\SeminerModel;
use App\Models\GalleryModel;
use App\Models\StudentRegModel;
use App\Models\ActiveCourse;
use App\Models\Blog;
use App\Models\ClientReview;
use Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function home()
    {
        $allCourse = AddCourse::get()->reverse();
        $allServices = AddServices::get()->reverse();
        $allClientReview = ClientReview::get()->reverse();
        $gallery_image = GalleryModel::get();
        $blog = Blog::get()->slice(0,3);
        return view('users.home', compact('allCourse','allServices','allClientReview','gallery_image','blog'));
    }

    function all_course()
    {
        $allCourse = AddCourse::get()->reverse();
        return view('users.all_course', ['allCourse' => $allCourse]);
    }
    function all_services()
    {
        $allServices = AddServices::get()->reverse();

        return view('users.all_services', ['allServices' => $allServices]);
    }
    function all_blog()
    {
        $allBlog = Blog::get()->reverse();
        return view('users.blog.all_blog',compact('allBlog'));
    }

    function web_design_details()
    {

        return view('users.web_design_details');
    }
    function course_details(Request $request)
    {
        $id = $request->id;
        $course_details = AddCourse::where('id', $id)->first();
        return view('users.course_details', ['course_details' => $course_details]);
    }
    function services_detials(Request $request)
    {
        $id = $request->id;
        $services_details = AddServices::where('id', $id)->first();
        return view('users.services_details', ['services_details' => $services_details]);
    }

    function blog_details(Request $request)
    {
        $allBlog = Blog::all()->reverse();
        $blogDetails = Blog::find($request->id);
        return view('users.blog.blog_details', compact('blogDetails','allBlog'));
    }
    function free_seminer()
    {
        $allSeminar = SeminerModel::get();
        return view('users.free_seminer', ['allSeminar' => $allSeminar]);
    }

    function course_admission()
    {
        return view('users.course_admission');
    }

    function services_contact()
    {

        return view('users.services_contact');
    }

    function gallery_img()
    {
        $gallery_image = GalleryModel::get();
        return view('users.gallery_img', ['gallery_image' => $gallery_image]);
    }




    function submit_course_admission(Request $request)
    {
        $arrayRequest = [
            "name" => $request->name,
            "phone" => $request->phone,
            "course_name" => $request->course_name,
            "message" => $request->message,
        ];

        $arrayValidate  = [
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'course_name' => 'required',
            'message' => 'required',
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

        $courseModel = new CourseModel();
        $courseModel->name = $request->name;
        $courseModel->phone = $request->phone;
        $courseModel->course_name = $request->course_name;
        $courseModel->message = $request->message;

        $responce = $courseModel->save();


        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => 'Seminer Confirm');
            return \Response::json($arr);
        } else {
            $arr = array('status' => 400, 'msg' => 'Form not Submit');
            return \Response::json($arr);
        }
    }


    function submit_services_admission(Request $request)
    {
        $arrayRequest = [
            "name" => $request->name,
            "phone" => $request->phone,
            "services_name" => $request->services_name,
            "message" => $request->message,
        ];

        $arrayValidate  = [
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'services_name' => 'required',
            'message' => 'required',
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

        $servicesModel = new ServicesModel();
        $servicesModel->name = $request->name;
        $servicesModel->phone = $request->phone;
        $servicesModel->services_name = $request->services_name;
        $servicesModel->message = $request->message;

        $responce = $servicesModel->save();


        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => 'Your Message Send');
            return \Response::json($arr);
        } else {
            $arr = array('status' => 200, 'msg' => 'Faild');
            return \Response::json($arr);
        }
    }
}
