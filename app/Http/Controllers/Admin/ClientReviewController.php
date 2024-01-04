<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientReviewController extends Controller
{
    public function manage_client_review()
    {
        $allReview = ClientReview::all();
        return view('admin.clientreview.manage_client_review', compact('allReview'));
    }
    public function add_client_review(Request $request)
    {
        return view('admin.clientreview.add_cleint_review');
    }
    public function update_client_review(Request $request)
    {
        $reviewDetails = ClientReview::find($request->id);
        return view('admin.clientreview.update_client_review', compact('reviewDetails'));
    }

    public function add_client_review_submit(Request $request)
    {
        
        if ($request->image) {
            $arrayRequest = [
                'name' => $request->name,
                'review_star' => $request->review_star,
                'description' => $request->description,
                'image' => $request->image,
            ];

            $arrayValidate  = [
                'name' => 'required',
                'review_star' => 'required',
                'description' => ['required', 'max:500'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],

            ];
        } else {
            $arrayRequest = [
                'name' => $request->name,
                'review_star' => $request->review_star,
                'description' => $request->description,
            ];

            $arrayValidate  = [
                'name' => 'required',
                'review_star' => 'required',
                'description' => ['required', 'string', 'max:500'],
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


                if ($request->image) {
                    $img = $request->image;
                    $image =  $img->store('/public/review_image');
                    $image = (explode('/', $image))[2];
                    $host = $_SERVER['HTTP_HOST'];
                    $image = "http://" . $host . "/storage/review_image/" . $image;
                } else {
                    $image = $request->image;
                }


                $clientReview = ClientReview::create([
                    'name' => $request->name,
                    'review_star' => $request->review_star,
                    'categorie' => $request->categorie,
                    'image' => $image,
                    'description' => $request->description,

                ]);

                DB::commit();
            } catch (\Exception $err) {
                $clientReview = null;
            }

            if ($clientReview != null) {
                return response()->json([
                    'status' => 200,
                    'msg' => 'Review Add Successfully'
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

    public function client_review_delete(Request $request)
    {
        $clientReview = ClientReview::find($request->id);

        if (is_null($clientReview)) {

            return response()->json([
                'msg' => "Client Review Doesnt Exists",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {

                $clientReview->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete Client Review',
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

    public function update_client_review_submit(Request $request)
    {

        $clientReview = ClientReview::find($request->id);

        if (is_null($clientReview)) {
            return response()->json([
                'msg' => "Client Review dosen't exists",
                'status' => 404
            ], 404);
        } else {
            if ($request->image) {
                $arrayRequest = [
                    'name' => $request->name,
                    'review_star' => $request->review_star,
                    'categorie' => $request->categorie,
                    'description' => $request->description,
                    'image' => $request->image,
                ];

                $arrayValidate  = [
                    'name' => 'required',
                    'review_star' => 'required',
                    'description' => ['required', 'max:500'],
                    'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:300'],

                ];
            } else {
                $arrayRequest = [
                    'name' => $request->name,
                    'review_star' => $request->review_star,
                    'description' => $request->description,
                ];

                $arrayValidate  = [
                    'name' => 'required',
                    'review_star' => 'required',
                    'description' => ['required', 'string', 'max:500'],
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

                    if ($request->image) {
                        $img = $request->image;
                        $image =  $img->store('/public/doctor_image');
                        $image = (explode('/', $image))[2];
                        $host = $_SERVER['HTTP_HOST'];
                        $image = "http://" . $host . "/storage/doctor_image/" . $image;
                    } else {
                        $image = $request->old_image;
                    }


                    $clientReview->name = $request->name;
                    $clientReview->review_star = $request->review_star;
                    $clientReview->categorie = $request->categorie;
                    $clientReview->image = $image;
                    $clientReview->description = $request->description;
                    $clientReview->save();
                    DB::commit();
                } catch (\Exception $err) {
                    DB::rollBack();
                    $clientReview = null;
                }

                if (is_null($clientReview)) {
                    return response()->json([
                        'status' => 500,
                        'msg' => 'Internal Server Error',
                        'err_msg' => $err->getMessage()
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Client Review Update Successfylly'
                    ]);
                }
            }
        }
    }


    // student feedback 

    public function manage_student_feedabck()
    {
        $allReview = CourseReview::all();
        return view('admin.clientreview.manage_student_feeback', compact('allReview'));
    }
    public function delete_student_feedabck(Request $request)
    {
        $courseReview = CourseReview::find($request->id);

        if (is_null($courseReview)) {

            return response()->json([
                'msg' => "Review Doesnt Exists",
                'status' => 404
            ], 404);
        } else {

            DB::beginTransaction();

            try {

                $courseReview->delete();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'msg' => 'Delete Student Feed Back',
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
