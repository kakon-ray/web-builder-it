<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\AdminController;


// user route
Route::get('/', [UserController::class, 'home'])->name('home');

Route::name('user.')->prefix('user')->group(function () {

    Route::get('all/course', [UserController::class, 'all_course'])->name('all.course');
    Route::get('all/services', [UserController::class, 'all_services'])->name('all.service');
    Route::get('course/details/{id}', [UserController::class, 'course_details'])->name('course.details');
    Route::get('services/details/{id}', [UserController::class, 'services_detials'])->name('services.details');
    Route::get('free-seminer', [UserController::class, 'free_seminer'])->name('free.seminer');
    Route::get('contact', [UserController::class, 'course_admission'])->name('course.contact');
    Route::get('services/order', [UserController::class, 'services_contact'])->name('services.contact');
    Route::get('gallery', [UserController::class,'gallery_img'])->name('gallery');
    
    Route::post('admission', [UserController::class, 'submit_course_admission'])->name('course.message.submit');
    Route::post('submit-services', [UserController::class, 'submit_services_admission'])->name('services.message.submit');


    // navigation search bar
    Route::get('search', [SearchController::class,'search'])->name('nav.search');

});