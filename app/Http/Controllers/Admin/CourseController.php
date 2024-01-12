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
            "duration" => $request->duration,
            "lectures" => $request->lectures,
            "language" => $request->language,
            "projects" => $request->projects,
            "course_fee" => $request->course_fee,
            "course_img" => $request->course_img,
            "desc" => $request->desc,
        ];

        $arrayValidate  = [
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

                $img = $request->course_img;
                $course_img =  $img->store('/public/course_img');
                $course_img = (explode('/', $course_img))[2];
                $host = $_SERVER['HTTP_HOST'];
                $course_img = "http://" . $host . "/storage/course_img/" . $course_img;

                $addCourse = AddCourse::create([
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
        }else{
            if($request->course_img){
                $arrayRequest = [
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
                    'course_title' => 'required',
                    'duration' => ['required', 'integer'],
                    'lectures' => 'required',
                    'language' => 'required',
                    'projects' => 'required',
                    'course_fee' => 'required',
                    'course_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],
                    'desc' => 'required',
        
                ];
            }else{
                $arrayRequest = [
                    "course_title" => $request->course_title,
                    "duration" => $request->duration,
                    "lectures" => $request->lectures,
                    "language" => $request->language,
                    "projects" => $request->projects,
                    "course_fee" => $request->course_fee,
                    "desc" => $request->desc,
                ];
        
                $arrayValidate  = [
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

                    if ( $request->course_img) {
                        $img = $request->course_img;
                        $course_img =  $img->store('/public/course_img');
                        $course_img = (explode('/', $course_img))[2];
                        $host = $_SERVER['HTTP_HOST'];
                        $image = "http://" . $host . "/storage/course_img/" . $course_img;;
                    } else {
                        $image = $request->old_image;
                    }


                    $addCourse->course_title = $request->course_title;
                    $addCourse->instructor = $request->instructor;
                    $addCourse->duration = $request->duration;
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
