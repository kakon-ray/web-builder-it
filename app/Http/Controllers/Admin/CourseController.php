<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// course admission and service admission
use App\Models\CourseModel;
// home page course and service
use App\Models\AddCourse;
use App\Models\Coursecategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
        $course_catagory = Coursecategory::all();
        return view('admin/course/add_course', compact('current_user_data','course_catagory'));
    }
    function edit_course_catagory(Request $request)
    {   
        $course_catagory = Coursecategory::where('id',$request->id)->first();
        return view('admin/course/edit_course_catagory', compact('course_catagory'));
    }
    function add_course_catagory()
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/course/add_course_catagory', compact('current_user_data'));
    }
    function add_course_catagory_submit(Request $request)
    {
        $catagory = new Coursecategory();
        
        $arrayRequest = [
            'category_name' => $request->category_name,
        ];

        $arrayValidate  = [
            'category_name' => 'required',
        ];

        $response = Validator::make($arrayRequest, $arrayValidate);

        if ($response->fails()) {
            $msg = '';
            foreach ($response->getMessageBag()->toArray() as $item) {
                $msg = $item;
            };

            return response()->json([
                'status' => 400,
                'msg' => $msg
            ], 200);
        } else {
            DB::beginTransaction();

            try {
                $slug = Str::slug($request->category_name, '-');

                $catagory->category_name = $request->category_name;
                $catagory->category_slug = $slug;
                $catagory->save();

                DB::commit();
            } catch (\Exception $err) {
                $catagory = null;
            }

            if ($catagory != null) {
                return response()->json([
                    'status' => 200,
                    'msg' => 'Add New Catagory'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'msg' => 'Server Error',
                    'err_msg' => $err->getMessage()
                ]);
            }
        }
    }
    function add_course_catagory_edit_submit(Request $request)
    {
        $catagory = Coursecategory::find($request->id);
        
        $arrayRequest = [
            'category_name' => $request->category_name,
        ];

        $arrayValidate  = [
            'category_name' => 'required',
        ];

        $response = Validator::make($arrayRequest, $arrayValidate);

        if ($response->fails()) {
            $msg = '';
            foreach ($response->getMessageBag()->toArray() as $item) {
                $msg = $item;
            };

            return response()->json([
                'status' => 400,
                'msg' => $msg
            ], 200);
        } else {
            DB::beginTransaction();

            try {
                $slug = Str::slug($request->category_name, '-');

                $catagory->category_name = $request->category_name;
                $catagory->category_slug = $slug;
                $catagory->save();

                DB::commit();
            } catch (\Exception $err) {
                $catagory = null;
            }

            if ($catagory != null) {
                return response()->json([
                    'status' => 200,
                    'msg' => 'Update Catagory'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'msg' => 'Server Error',
                    'err_msg' => $err->getMessage()
                ]);
            }
        }
    }


    function add_course_submit(Request $request)
    {

        $arrayRequest = [
            "coursecategory_id" => $request->coursecategory_id,
            "batch" => $request->batch,
            "course_title" => $request->course_title,
            "duration" => $request->duration,
            "lectures" => $request->lectures,
            "language" => $request->language,
            "projects" => $request->projects,
            "course_fee" => $request->course_fee,
            "course_img" => $request->course_img,
            "desc" => $request->desc,
        ];

        $arrayValidate  = [
            'coursecategory_id' => 'required',
            'batch' => 'required',
            'course_title' => 'required',
            'duration' => ['required', 'integer'],
            'lectures' => 'required',
            'language' => 'required',
            'projects' => 'required',
            'course_fee' => 'required',
            'course_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],
            'desc' => 'required',

        ];

        $response = Validator::make($arrayRequest, $arrayValidate);

        if ($response->fails()) {
            $msg = '';
            foreach ($response->getMessageBag()->toArray() as $item) {
                $msg = $item;
            };

            return response()->json([
                'status' => 400,
                'msg' => $msg
            ]);
        } else {
            DB::beginTransaction();

            try {

                // single thumbnil image upload
                $slug = Str::slug($request->course_title, '-');

                if ($request->course_img) {
                    $file = $request->file('course_img');
                    $filename =  $slug . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                    $img = Image::make($file);
                    $img->resize(500, 300)->save(public_path('uploads/' . $filename));

                    $host = $_SERVER['HTTP_HOST'];
                    $course_img = "http://" . $host . "/uploads/" . $filename;
                }


                $addCourse = AddCourse::create([
                    'coursecategory_id' => $request->coursecategory_id,
                    'batch' => $request->batch,
                    'course_title' => $request->course_title,
                    'instructor' => $request->instructor,
                    'duration' => $request->duration,
                    'lectures' => $request->lectures,
                    'language' => $request->language,
                    'projects' => $request->projects,
                    'course_fee' => $request->course_fee,
                    'new_course_fee' => $request->new_course_fee,
                    'course_img' => $course_img,
                    'status' => false,
                    'desc' => $request->desc,
                ]);

                DB::commit();
            } catch (\Exception $err) {
                $addCourse = null;
            }

            if ($addCourse != null) {
                return response()->json([
                    'status' => 200,
                    'msg' => 'Course Add Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'msg' => 'Internal Server Error',
                    'err_msg' => $err->getMessage()
                ]);
            }
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
        $allCourse = AddCourse::with('course_catagory')->get();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/course/manage_course', ['allCourse' => $allCourse, 'current_user_data' => $current_user_data]);
    }
    function manage_course_catagory(Request $request)
    {
        $all_category = Coursecategory::all();
        return view('admin/course/manage_category',compact('all_category'));
    }

    function delete_course(Request $request)
    {

        $addCourse = AddCourse::find($request->id);

        if (is_null($addCourse)) {

            return response()->json([
                'msg' => "Do not Find any Course",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {
                // single thumbnail file delete kora hocce jodi image file delete hoy tarpor databse theke data delete kora hobe
                $pathinfo = pathinfo($addCourse->course_img);
                $filename = $pathinfo['basename'];
                $image_path = public_path("/uploads/") . $filename;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }


                $addCourse->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete This Course',
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
    function course_catagory_delete(Request $request)
    {

        $addCourse = Coursecategory::find($request->id);

        if (is_null($addCourse)) {

            return response()->json([
                'msg' => "Do not Find any Course",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {
          
                $addCourse->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete This Course Category',
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

    function edit_course(Request $request)
    {
        $id = $request->id;
        $course_details = AddCourse::where('id', $id)->first();
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        $course_catagory = Coursecategory::all();
        return view('admin/course/edit_course', ['course_details' => $course_details, 'current_user_data' => $current_user_data,'course_catagory'=>$course_catagory]);
    }

    function course_details(Request $request)
    {
        $course_details = AddCourse::where('id', $request->id)->first();
        return view('admin/course/course_details', compact('course_details'));
    }

    function edit_course_submit(Request $request)
    {

        $addCourse = AddCourse::find($request->id);

        if (is_null($addCourse)) {
            return response()->json([
                'msg' => "Letest News dosen't exists",
                'status' => 404
            ], 404);
        } else {
            if ($request->course_img) {
                $arrayRequest = [
                    "batch" => $request->batch,
                    "course_title" => $request->course_title,
                    "duration" => $request->duration,
                    "lectures" => $request->lectures,
                    "language" => $request->language,
                    "projects" => $request->projects,
                    "course_fee" => $request->course_fee,
                    "course_img" => $request->course_img,
                    "desc" => $request->desc,
                ];

                $arrayValidate  = [
                    'batch' => 'required',
                    'course_title' => 'required',
                    'duration' => ['required', 'integer'],
                    'lectures' => 'required',
                    'language' => 'required',
                    'projects' => 'required',
                    'course_fee' => 'required',
                    'course_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],
                    'desc' => 'required',

                ];
            } else {
                $arrayRequest = [
                    "batch" => $request->batch,
                    "course_title" => $request->course_title,
                    "duration" => $request->duration,
                    "lectures" => $request->lectures,
                    "language" => $request->language,
                    "projects" => $request->projects,
                    "course_fee" => $request->course_fee,
                    "desc" => $request->desc,
                ];

                $arrayValidate  = [
                    'batch' => 'required',
                    'course_title' => 'required',
                    'duration' => ['required', 'integer'],
                    'lectures' => 'required',
                    'language' => 'required',
                    'projects' => 'required',
                    'course_fee' => 'required',
                    'desc' => 'required',

                ];
            }

            $response = Validator::make($arrayRequest, $arrayValidate);

            if ($response->fails()) {
                $msg = '';
                foreach ($response->getMessageBag()->toArray() as $item) {
                    $msg = $item;
                };

                return response()->json([
                    'status' => 400,
                    'msg' => $msg
                ]);
            } else {
                DB::beginTransaction();

                try {

                    // single thumbnil image upload
                    $slug = Str::slug($request->course_title, '-');

                    if ($request->course_img) {

                        $pathinfo = pathinfo($addCourse->course_img);
                        $filename = $pathinfo['basename'];
                        $image_path = public_path("/uploads/") . $filename;

                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }


                        $file = $request->file('course_img');
                        $filename = $slug . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                        $img = Image::make($file);
                        $img->resize(500, 300)->save(public_path('uploads/' . $filename));

                        $host = $_SERVER['HTTP_HOST'];
                        $image = "http://" . $host . "/uploads/" . $filename;

                    } else {
                        $image = $request->old_image;
                    }


                    $addCourse->batch = $request->batch;
                    $addCourse->course_title = $request->course_title;
                    $addCourse->instructor = $request->instructor;
                    $addCourse->duration = $request->duration;
                    $addCourse->coursecategory_id = $request->coursecategory_id;
                    $addCourse->lectures = $request->lectures;
                    $addCourse->language = $request->language;
                    $addCourse->projects = $request->projects;
                    $addCourse->duration = $request->duration;
                    $addCourse->status = false;
                    $addCourse->course_fee = $request->course_fee;
                    $addCourse->new_course_fee = $request->new_course_fee;
                    $addCourse->course_img =  $image;
                    $addCourse->desc = $request->desc;

                    $addCourse->save();

                    DB::commit();
                } catch (\Exception $err) {
                    DB::rollBack();
                    $addCourse = null;
                }

                if (is_null($addCourse)) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Internal Server Error',
                        'err_msg' => $err->getMessage()
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Course Update Successfylly'
                    ]);
                }
            }
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
