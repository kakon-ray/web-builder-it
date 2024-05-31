<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AddCourse;
use App\Models\CourseReview;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseReviewController extends Controller
{
    public function student_review_submit(Request $request)
    {

            $arrayRequest = [
                'description' => $request->description,
            ];

            $arrayValidate  = [
                'description' => ['required', 'max:500'],
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


                $courseReview = CourseReview::create([
                    'course_id' => $request->course_id,
                    'student_id' => $request->student_id,
                    'name' => $request->name,
                    'review_star' => $request->ratevalue + 1,
                    'image' => $request->image,
                    'description' => $request->description,

                ]);

                DB::commit();
            } catch (\Exception $err) {
                $courseReview = null;
            }

            if ($courseReview != null) {

                $reviewCount = AddCourse::find($request->course_id);
                $reviewCount->review_count = $reviewCount->review_count + 1;
                $reviewCount->save();


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

    public function student_review_delete(Request $request)
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
                    'msg' => 'Delete Your Feed Back',
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
