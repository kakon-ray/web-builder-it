<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// course admission and service admission
use App\Models\ServicesModel;

// home page course and service
use App\Models\AddServices;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
            'services_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
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


        // single thumbnil image upload
        $slug = Str::slug($request->services_title, '-');

        if ($request->services_img) {
            $file = $request->file('services_img');
            $filename = $slug . '-' . 'services' . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img = Image::make($file);
            $img->resize(500, 300)->save(public_path('uploads/' . $filename));

            $host = $_SERVER['HTTP_HOST'];
            $services_img = "http://" . $host . "/uploads/" . $filename;
        }

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

        $see_notification = ServicesModel::where('count',0)->update([
            'count'=> 1,
        ]);
        
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

        $addServices = AddServices::find($request->id);

        if (is_null($addServices)) {

            return response()->json([
                'msg' => "Do not Find any Services Item",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {
                $pathinfo = pathinfo($addServices->services_img);
                $filename = $pathinfo['basename'];
                $image_path = public_path("/uploads/") . $filename;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }


                $addServices->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete This Services',
                ], 200);
            } catch (\Exception $err) {

                DB::rollBack();

                return response()->json([
                    'msg' => "Internal Server Error",
                    'status' => 500,
                    'err_msg' => $err->getMessage()
                ], 500);
            }
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

        $addServices = AddServices::find($request->id);

        if (is_null($addServices)) {
            return response()->json([
                'msg' => "Service Item dosen't exists",
                'status' => 404
            ], 404);
        } else {
            if($request->services_img){
                $arrayRequest = [
                    "services_title" => $request->services_title,
                    "description" => $request->description,
                    "services_img" => $request->services_img,
                ];
    
                $arrayValidate  = [
                    'services_title' => 'required',
                    'description' => 'required',
                    'services_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
                ];
            }else{
                $arrayRequest = [
                    "services_title" => $request->services_title,
                    "description" => $request->description,
                ];
    
                $arrayValidate  = [
                    'services_title' => 'required',
                    'description' => 'required',
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
            } else {
                DB::beginTransaction();

                try {

                    // single thumbnil image upload
                    $slug = Str::slug($request->services_title, '-');

                    if ($request->services_img) {

                        $pathinfo = pathinfo($addServices->services_img);
                        $filename = $pathinfo['basename'];
                        $image_path = public_path("/uploads/") . $filename;

                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }


                        $file = $request->file('services_img');
                        $filename = $slug . '-' . 'services' . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                        $img = Image::make($file);
                        $img->resize(500, 300)->save(public_path('uploads/' . $filename));

                        $host = $_SERVER['HTTP_HOST'];
                        $services_img = "http://" . $host . "/uploads/" . $filename;
                    } else {
                        $services_img = $request->old_image;
                    }

                    $addServices->services_title = $request->services_title;
                    $addServices->desc = $request->description;
                    $addServices->services_img = $services_img;

                    $addServices->save();

                    DB::commit();
                } catch (\Exception $err) {
                    DB::rollBack();
                    $addServices = null;
                }

                if (is_null($addServices)) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Internal Server Error',
                        'err_msg' => $err->getMessage()
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Services Update Successfylly'
                    ]);
                }
            }
        }
    }
}
