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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function home()
    {
        $allCourse = AddCourse::get()->reverse();
        $allServices = AddServices::get()->reverse();
        $gallery_image = GalleryModel::get();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.home', ['allCourse' => $allCourse, 'allServices' => $allServices, 'gallery_image' => $gallery_image, 'currentStudent' => $currentStudent]);
    }

    function all_course()
    {
        $allCourse = AddCourse::get()->reverse();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.all_course', ['allCourse' => $allCourse, 'currentStudent' => $currentStudent]);
    }
    function all_services()
    {
        $allServices = AddServices::get()->reverse();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.all_services', ['allServices' => $allServices, 'currentStudent' => $currentStudent]);
    }
    function web_design_details()
    {
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.web_design_details', ['currentStudent' => $currentStudent]);
    }
    function course_details(Request $request)
    {
        $id = $request->id;
        $course_details = AddCourse::where('id', $id)->first();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.course_details', ['course_details' => $course_details, 'currentStudent' => $currentStudent]);
    }
    function services_detials(Request $request)
    {
        $id = $request->id;
        $services_details = AddServices::where('id', $id)->first();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.services_details', ['services_details' => $services_details, 'currentStudent' => $currentStudent]);
    }
    function free_seminer()
    {
        $allSeminar = SeminerModel::get();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.free_seminer', ['allSeminar' => $allSeminar, 'currentStudent' => $currentStudent]);
    }

    function course_admission()
    {
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.course_admission', ['currentStudent' => $currentStudent]);
    }

    function services_contact()
    {
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.services_contact', ['currentStudent' => $currentStudent]);
    }

    function gallery_img()
    {
        $gallery_image = GalleryModel::get();
        $currentStudent = cookie::get('student');
        $currentStudent =  StudentRegModel::where('email', $currentStudent)->first();
        return view('users.gallery_img', ['gallery_image' => $gallery_image, 'currentStudent' => $currentStudent]);
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
