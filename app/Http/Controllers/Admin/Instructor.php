<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseInstructor;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Psy\VersionUpdater\Installer;

class Instructor extends Controller
{
    function add_instructor()
    {
        return view('admin/instructor/add');
    }
    function update_instructor(Request $request)
    {
         $instructor = CourseInstructor::find($request->id);
        return view('admin/instructor/update',compact('instructor'));
    }
    function add_instructor_submit(Request $request)
    {
        {
            $arrayRequest = [
                "name" => $request->name,
                "image" => $request->image,
                "description" => $request->description,
            ];
    
            $arrayValidate  = [
                'name' => 'required',
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
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
            $slug = Str::slug($request->name, '-');
    
            if ($request->image) {
                $file = $request->file('image');
                $filename = $slug . '-' . 'instructor' . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
    
                $img = Image::make($file);
                $img->resize(500, 300)->save(public_path('uploads/' . $filename));
    
                $host = $_SERVER['HTTP_HOST'];
                $image = "http://" . $host . "/uploads/" . $filename;
            }
    
            // insert data to AddCourse Model
    
            $addinstructor = CourseInstructor::create([
                'name' => $request->name,
                'image' => $image,
                'description' => $request->description,

            ]);
    

            if ($addinstructor) {
                $arr = array('status' => 200, 'msg' => 'Successflly Add Instructor');
                return \Response::json($arr);
            }
        }
    }

    function manage_instructor(Request $request)
    {
        $allInstructor = CourseInstructor::get();
        return view('admin/instructor/manage',compact('allInstructor'));
    }

    function instructor_delete(Request $request)
    {
            $instructor = CourseInstructor::find($request->id);

        if (is_null($instructor)) {

            return response()->json([
                'msg' => "Do not Find any Instructor",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {
                $pathinfo = pathinfo($instructor->image);
                $filename = $pathinfo['basename'];
                $image_path = public_path("/uploads/") . $filename;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }


                $instructor->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete This Instructor',
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

    function update_instructor_submit(Request $request)
    {

        // dd($request->all());
        $instructor = CourseInstructor::find($request->id);

        if (is_null($instructor)) {
            return response()->json([
                'msg' => "Instructor dosen't exists",
                'status' => 404
            ], 404);
        } else {
            if($request->image){
                $arrayRequest = [
                    "name" => $request->name,
                    "description" => $request->description,
                    "image" => $request->image,
                ];
    
                $arrayValidate  = [
                    'name' => 'required',
                    'description' => 'required',
                    'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
                ];
            }else{
                $arrayRequest = [
                    "name" => $request->name,
                    "description" => $request->description,
                ];
    
                $arrayValidate  = [
                    'name' => 'required',
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
                    $slug = Str::slug($request->name, '-');

                    if ($request->image) {

                        $pathinfo = pathinfo($instructor->image);
                        $filename = $pathinfo['basename'];
                        $image_path = public_path("/uploads/") . $filename;

                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }


                        $file = $request->file('image');
                        $filename = $slug . '-' . 'instructor' . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                        $img = Image::make($file);
                        $img->resize(500, 300)->save(public_path('uploads/' . $filename));

                        $host = $_SERVER['HTTP_HOST'];
                        $image = "http://" . $host . "/uploads/" . $filename;
                    } else {
                        $image = $request->old_img;
                    }

                    $instructor->name = $request->name;
                    $instructor->description = $request->description;
                    $instructor->image = $image;

                    $instructor->save();

                    DB::commit();
                } catch (\Exception $err) {
                    DB::rollBack();
                    $instructor = null;
                }

                if (is_null($instructor)) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Internal Server Error',
                        'err_msg' => $err->getMessage()
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Instructor Update Successfylly'
                    ]);
                }
            }
        }
    }
}
