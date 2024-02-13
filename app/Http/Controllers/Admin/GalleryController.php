<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GalleryModel;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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

        if ($request->gallery_img) {
            $file = $request->file('gallery_img');
            $filename = 'gallery' . '-' . 'image' . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img = Image::make($file);
            $img->resize(500, 500)->save(public_path('uploads/' . $filename));

            $host = $_SERVER['HTTP_HOST'];
            $gallery_img = "http://" . $host . "/uploads/" . $filename;
        }


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

        $gallery = GalleryModel::find($request->id);

        if (is_null($gallery)) {

            return response()->json([
                'msg' => "Do not Find any Gallery Item",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {
                $pathinfo = pathinfo($gallery->gallery_img);
                $filename = $pathinfo['basename'];
                $image_path = public_path("/uploads/") . $filename;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }


                $gallery->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete This Gallery',
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
}
