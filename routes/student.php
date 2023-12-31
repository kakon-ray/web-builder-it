<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\PasswordResetController;
use App\Http\Controllers\Student\GoogleController;
use App\Http\Controllers\Student\FacebookController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\SslCommerzPaymentController;




// student  route

Route::name('student.')->prefix('student')->group(function () {
    Route::get('login', [AuthController::class,'student_login_form'])->name('login');
    Route::get('registation', [AuthController::class, 'student_registation'])->name('registation');
    Route::post('registation-sub', [AuthController::class, 'student_registation_sub'])->name('reg.submit');
    Route::post('login-sub', [AuthController::class, 'student_login_sub'])->name('login.submit');

    // password reset
    Route::get('password/reset', [PasswordResetController::class, 'password_reset'])->name('password.reset');
    Route::post('reset/password/submit', [PasswordResetController::class, 'reset_password_submit'])->name('reset.password.submit');
    Route::get('reset/password/{token}', [PasswordResetController::class, 'show_reset_password_form'])->name('reset.password');
    Route::post('new/password/submit', [PasswordResetController::class, 'new_password'])->name('new.password.submit');
    

    Route::middleware(['studentauth'])->group(function (){
        Route::get('mycourse', [StudentController::class, 'mycourse'])->name('mycourse');
        Route::get('profile', [StudentController::class, 'profile'])->name('profile');
        Route::get('classroom/{id}', [StudentController::class, 'classroom'])->name('classroom');
        Route::get('my-order', [StudentController::class, 'my_order'])->name('my.order');
        Route::post('logout', [StudentController::class, 'student_logout'])->name('logout');
        Route::get('checkout/{id}', [StudentController::class, 'checkout'])->name('checkout');
        Route::post('active/course/add', [StudentController::class, 'active_course_add'])->name('active.course.add');
        Route::post('profile/update', [StudentController::class, 'student_profile_update'])->name('profile.update');

        // pement controller and pement getway work
        Route::post('add/pement/submit', [PaymentController::class, 'add_pement_submit'])->name('add.pement.submit');
        
        // SSLCOMMERZ Start
        Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
       //SSLCOMMERZ END
    });
});


Route::middleware(['studentauth'])->group(function (){
    // SSLCOMMERZ Start
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END
});




 // student google login
 Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

 // student facebook login
 Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('login', [FacebookController::class, 'loginWithFacebook'])->name('login');
    Route::any('callback', [FacebookController::class, 'callbackFromFacebook'])->name('callback');
});
