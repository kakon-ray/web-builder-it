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
use App\Models\Tutorial;
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

class TutorialController extends Controller
{
    function add_tutorial(Request $request)
    {
        $all_course = AddCourse::all();
        return view('admin.tutorial.add_tutorial', ['all_course' => $all_course]);
    }
    function manage_tutorial(Request $request)
    {
        $all_course = AddCourse::with('tutorial')->get();
        return view('admin.tutorial.manage_tutorial', ['all_course' => $all_course]);
    }
    function manage_specific_tutorial(Request $request)
    {
        $tutorial = Tutorial::where('course_id', $request->id)->with('add_course')->get();
        return view('admin.tutorial.manage_specific_tutorial', ['tutorial' => $tutorial]);
    }
    function edit_specific_tutorial(Request $request)
    {
        $tutorial_details = Tutorial::where('id', $request->id)->first();
        $all_course = AddCourse::with('tutorial')->get();
        return view('admin.tutorial.edit_specific_tutorial', ['tutorial_details' => $tutorial_details, 'all_course' => $all_course]);
    }
    function add_tutorial_submit(Request $request)
    {

        $arrayRequest = [
            "course_id" => $request->course_id,
            "video_title" => $request->video_title,
            "video_link" => $request->video_link,
            "other_document" => $request->other_document,
        ];

        $arrayValidate  = [
            'course_id' => 'required',
            'video_title' => 'required',
            'video_link' => 'required',
            'other_document' => 'required',
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

        $tutorial = new Tutorial();
        $tutorial->course_id = $request->course_id;
        $tutorial->video_title = $request->video_title;
        $tutorial->video_link = $request->video_link;
        $tutorial->other_document = $request->other_document;
        $tutorial->hosting_type = $request->hosting_type;

        $responce = $tutorial->save();


        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => $request->video_title . ' Tutorial Add');
            return \Response::json($arr);
        }
    }
    function edit_tutorial_submit(Request $request)
    {

        // dd($request->all());

        $arrayRequest = [
            "course_id" => $request->course_id,
            "video_title" => $request->video_title,
            "video_link" => $request->video_link,
            "other_document" => $request->other_document,
        ];

        $arrayValidate  = [
            'course_id' => 'required',
            'video_title' => 'required',
            'video_link' => 'required',
            'other_document' => 'required',
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

        $tutorial =  Tutorial::find($request->id);
        $tutorial->course_id = $request->course_id;
        $tutorial->video_title = $request->video_title;
        $tutorial->video_link = $request->video_link;
        $tutorial->other_document = $request->other_document;
        $tutorial->hosting_type = $request->hosting_type;
        $responce = $tutorial->save();


        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => $request->video_title . ' Tutorial Edit Successfully');
            return \Response::json($arr);
        }
    }

    function delete_tutorial(Request $request)
    {
        $id = $request->input('id');

        $responce = Tutorial::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Course Message"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Course Message Faild"];
            return \Response::json($arr);
        }
    }
}
