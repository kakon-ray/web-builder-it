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

class GoogleController extends Controller
{
    // login with google

    function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    function callbackFromGoogle()
    {
        try {

            $google_user = Socialite::driver('google')->user();
            $new_user = StudentRegModel::where('email', $google_user->getEmail())->first();

            if (!$new_user) {

                $user = StudentRegModel::create([
                    'student_name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'password' => Hash::make($google_user->getName() . '@' . $google_user->getId()),

                ]);

                if ($user) {
                    Auth::guard('student')->login($user);
                    return redirect()->route('student.profile');
                }
            } else {
                $saveUser = StudentRegModel::where('email', $google_user->getEmail())->first();

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
