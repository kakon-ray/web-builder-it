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

class SeminerController extends Controller
{

    function add_seminar()
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/seminer/add_seminar', ['current_user_data' => $current_user_data]);
    }
    function add_seminar_submit(Request $request)
    {
        $arrayRequest = [
            "seminer_title" => $request->seminer_title,
            "seminer_date" => $request->seminer_date,
            "seminer_time" => $request->seminer_time,
        ];

        $arrayValidate  = [
            'seminer_title' => 'required',
            'seminer_date' => 'required',
            'seminer_time' => 'required',

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


        // insert data to seminer Model

        $seminerModel = new SeminerModel();
        $seminerModel->seminer_title = $request->seminer_title;
        $seminerModel->seminer_date = $request->seminer_date;
        $seminerModel->seminer_time = $request->seminer_time;


        $responce = $seminerModel->save();


        if ($responce == 1) {
            $arr = array('status' => 200, 'msg' => 'Successflly Add Seminer');
            return \Response::json($arr);
        }
    }
    function manage_seminer()
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        $allseminer = SeminerModel::get();
        return view('admin/seminer/manage_seminer', ['current_user_data' => $current_user_data, 'allseminer' => $allseminer]);
    }

    function delete_seminar(Request $request)
    {
        $id = $request->input('id');

        $responce = SeminerModel::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Course Message"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Course Message Faild"];
            return \Response::json($arr);
        }
    }
    function edit_seminar(Request $request)
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        $edit_seminer = SeminerModel::where('id', $request->id)->first();
        return view('admin/seminer/edit_seminar', ['edit_seminer' => $edit_seminer, 'current_user_data' => $current_user_data]);
    }

    function edit_seminar_submit(Request $request)
    {
        $arrayRequest = [
            "seminer_title" => $request->seminer_title,
            "seminer_date" => $request->seminer_date,
            "seminer_time" => $request->seminer_time,
        ];

        $arrayValidate  = [
            'seminer_title' => 'required',
            'seminer_date' => 'required',
            'seminer_time' => 'required',

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


        // insert data to seminer Model

        $seminerModel = SeminerModel::find($request->id);
        $seminerModel->seminer_title = $request->seminer_title;
        $seminerModel->seminer_date = $request->seminer_date;
        $seminerModel->seminer_time = $request->seminer_time;


        $responce = $seminerModel->save();


        if ($responce == 1) {
            $arr = array('status' => 200, 'msg' => 'Successflly Edit Seminer');
            return \Response::json($arr);
        }
    }
}
