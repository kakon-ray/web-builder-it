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

class GalleryController extends Controller
{
    function dashboard_gallery(Request $request)
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        $gallery_image = GalleryModel::get();
        return view('admin/gallery/dashboard_gallery', ['current_user_data' => $current_user_data, 'gallery_image' => $gallery_image]);
    }

    function add_img(Request $request)
    {
        $current_user_data = User::where('email', Auth::guard('web')->user()->email)->first();
        return view('admin/gallery/add_img', ['current_user_data' => $current_user_data]);
    }

    function add_gallery_img(Request $request)
    {

        $arrayRequest = [
            "gallery_img" => $request->gallery_img,
        ];

        $arrayValidate  = [
            'gallery_img' => 'required|file|mimes:jpeg,jpg,png',
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

        $gallery_img =  $request->file('gallery_img')->store('/public/gallery_img');

        $gallery_img = (explode('/', $gallery_img))[2];

        $host = $_SERVER['HTTP_HOST'];
        $gallery_img = "http://" . $host . "/storage/gallery_img/" . $gallery_img;


        $galleryModel = new GalleryModel();

        $galleryModel->gallery_img = $gallery_img;
        $responce = $galleryModel->save();


        if ($responce) {
            $arr = array('status' => 200, 'msg' => 'Successflly Upload Image');
            return \Response::json($arr);
        }
        if ($responce == false) {
            $arr = array('status' => 200, 'msg' => 'Image Upload Faild');
            return \Response::json($arr);
        }
    }

    function delete_gallery_image(Request $request)
    {
        $id = $request->input('id');

        $responce = GalleryModel::where('id', $id)->delete();

        if ($responce == 1) {
            $arr = ['status' => 200, 'msg' => "Deleted Galery Image"];
            return \Response::json($arr);
        } else {
            $arr = ['status' => 500, 'msg' => "Delete Galery Image Faild"];
            return \Response::json($arr);
        }
    }
}
