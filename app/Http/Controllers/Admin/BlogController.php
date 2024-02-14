<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    function add_blog()
    {
        return view('admin/blog/add_blog');
    }
    function manage_blog()
    {
        $allBlog = Blog::get()->reverse();
        return view('admin/blog/manage_blog',compact('allBlog'));
    }
    function update_blog(Request $request)
    {
        $blogDetails = Blog::find($request->id);
        return view('admin/blog/update_blog',compact('blogDetails'));
    }

    function add_blog_submit(Request $request)
    {

        $arrayRequest = [
            "title" => $request->title,
            "description" => $request->description,
            "image" => $request->image,
            "category" => $request->category,

        ];

        $arrayValidate  = [
            'title' => 'required',
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'description' => 'required',
            'category' => 'required',

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
                $slug = Str::slug($request->title, '-');
                $file = $request->file('image');
                $filename = $slug . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
    
                $img = Image::make($file);
                $img->resize(500, 300)->save(public_path('uploads/' . $filename));
    
                $host = $_SERVER['HTTP_HOST'];
                $image = "http://" . $host . "/uploads/" . $filename;

                $blog = Blog::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $image,
                    'category' => $request->category,
               
                ]);

                DB::commit();

            } catch (\Exception $err) {
                $blog = null;
            }

            if ($blog != null) {
                return response()->json([
                    'status' => 200,
                    'msg' => 'Blog Add Successfully'
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

    function update_blog_submit(Request $request)
    {
        $blog = Blog::find($request->id);

        if (is_null($blog)) {
            return response()->json([
                'msg' => "Blog dosen't exists",
                'status' => 404
            ], 404);
        } else {
            if ($request->image) {
                $arrayRequest = [
                    'title' => $request->title,
                    'description' => $request->description,
                    'category' => $request->category,
                    'image' => $request->image,
                ];

                $arrayValidate  = [
                    'title' => 'required',
                    'description' => 'required',
                    'category' => 'required',
                    'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],

                ];
            } else {
                $arrayRequest = [
                    'title' => $request->title,
                    'description' => $request->description,
                    'category' => $request->category,
                ];

                $arrayValidate  = [
                    'title' => 'required',
                    'description' => 'required',
                    'category' => 'required',

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

                    $slug = Str::slug($request->title, '-');
                    if ($request->image) {
                        $pathinfo = pathinfo($blog->image);
                        $filename = $pathinfo['basename'];
                        $image_path = public_path("/uploads/") . $filename;

                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }

                        $file = $request->file('image');
                        $filename = $slug . '-' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            
                        $img = Image::make($file);
                        $img->resize(500, 300)->save(public_path('uploads/' . $filename));
            
                        $host = $_SERVER['HTTP_HOST'];
                        $image = "http://" . $host . "/uploads/" . $filename;
                    } else {
                        $image = $request->old_image;
                    }


                    $blog->title = $request->title;
                    $blog->description = $request->description;
                    $blog->category = $request->category;
                    $blog->image = $image;

                    $blog->save();
                    DB::commit();

                } catch (\Exception $err) {
                    DB::rollBack();
                    $blog = null;
                }

                if (is_null($blog)) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Internal Server Error',
                        'err_msg' => $err->getMessage()
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Blog Update Successfylly'
                    ]);
                }
            }
        }
    }

    public function blog_delete(Request $request)
    {
        $blog = Blog::find($request->id);

        if (is_null($blog)) {

            return response()->json([
                'msg' => "Blog Doesnt Exists",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {

                $pathinfo = pathinfo($blog->image);
                $filename = $pathinfo['basename'];
                $image_path = public_path("/uploads/") . $filename;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                
                $blog->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete Blog',
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
