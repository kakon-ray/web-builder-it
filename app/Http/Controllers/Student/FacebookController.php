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
use App\Models\SeminerModel;
use App\Models\GalleryModel;
use App\Models\ActiveCourse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Views\Components\header;
use Illuminate\Validation\Rules;

// password reset to import
use Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

// login with google
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{

    function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function callbackFromFacebook()
    {
        try {

            $facebook_user = Socialite::driver('facebook')->user();
            $new_user = StudentRegModel::where('email', $facebook_user->getEmail())->first();

            if (!$new_user) {

                $user = StudentRegModel::create([
                    'student_name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' =>  $facebook_user->getId(),
                    'password' => Hash::make($facebook_user->getName() . '@' . $facebook_user->getId()),

                ]);

                if ($user) {
                    Auth::guard('student')->login($user);
                    return redirect()->route('student.profile');
                }
            } else {
                $saveUser = StudentRegModel::where('email', $facebook_user->getEmail())->first();

                if ($saveUser) {
                    Auth::guard('student')->login($saveUser);
                    return redirect()->route('student.profile');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
