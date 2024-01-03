<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

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
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],
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

                $img = $request->image;
                $blog_img =  $img->store('/public/blog_img');
                $blog_img = (explode('/', $blog_img))[2];
                $host = $_SERVER['HTTP_HOST'];
                $blog_img = "http://" . $host . "/storage/blog_img/" . $blog_img;

                $blog = Blog::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $blog_img,
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
}
