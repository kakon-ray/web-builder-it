<?php

namespace App\Http\Controllers\Student;

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
use App\Models\Order;
use App\Models\SeminerModel;
use App\Models\Tutorial;
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

// login with google
use Laravel\Socialite\Facades\Socialite;

class PaymentController extends Controller
{

    function add_pement_submit(Request $request)
    {

        //    return $request->all();

        $arrayRequest = [
            "phone" => $request->phone,
            "send_phone_num" => $request->send_phone_num,
            "amount" => $request->amount,
            "transaction_id" => $request->transaction_id,
            "pement_method" => $request->pement_method,

        ];

        $arrayValidate  = [
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'send_phone_num' => 'required|regex:/(01)[0-9]{9}/',
            'amount' => 'required',
            'transaction_id' => ['required', 'unique:orders'],
            'pement_method' => 'required',

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


        $responce = Order::create([
            'email' => Auth::guard('student')->user()->email,
            'phone' => $request->phone,
            'send_phone_num' => $request->send_phone_num,
            'amount' => $request->amount,
            'status' => 'Pending',
            'transaction_id' => $request->transaction_id,
            'pement_method' => $request->pement_method,
            'active_course_id' => $request->active_course_id,

        ]);


        if ($responce == true) {
            $arr = array('status' => 200, 'msg' => 'Successflly Add Pement');
            return \Response::json($arr);
        }
    }
}
