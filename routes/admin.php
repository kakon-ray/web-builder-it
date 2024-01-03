<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SeminerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\PasswordResetController;


// this is admin route
Route::name('admin.')->prefix('admin')->group(function () {

    // admin 404 error message show
    Route::fallback(function () {
        return view('errors.admin.404');
    });

    // admin auth
    Route::post('registation/submit', [AuthController::class, 'admin_registaion'])->name('registation.submit');
    Route::post('login/submit', [AuthController::class, 'admin_login'])->name('login.submit');
    Route::get('registation', [AuthController::class, 'register'])->name('registation');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'admin_logout'])->name('logout');

    // password reset
    Route::get('pasword/reset', [PasswordResetController::class, 'admin_pasword_reset'])->name('pasword.reset');
    Route::post('reset/password/submit', [PasswordResetController::class, 'reset_password_submit'])->name('reset.password.submit');
    Route::get('reset/password/{token}', [PasswordResetController::class, 'show_reset_password_form'])->name('reset.password');
    Route::post('new-password', [PasswordResetController::class, 'new_password_submit'])->name('new.password.submit');

    //admin dashboard 
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('get/chart/data', [DashboardController::class, 'get_chart_data']);
    });


    // this routes is admin pement student pement request handle routes
    Route::middleware(['auth'])->group(function () {
        Route::get('pement/request', [AdmissionController::class, 'pement_request'])->name('pement.request');
        Route::post('add/account/main/account', [AdmissionController::class, 'add_account_main_account'])->name('add.pement.main.account');
        Route::post('unaccepted/pement/main/account', [AdmissionController::class, 'unaccepted_account_main_account'])->name('unaccepted.pement.main.account');
        Route::get('delete/pement/request', [AdmissionController::class, 'delete_pement_request']);
    });

    // this routs is admin admission management routes
    Route::middleware(['auth'])->group(function () {
        Route::get('addmission', [AdmissionController::class, 'addmission'])->name('addmission');
        Route::get('delete/admission/sutdent', [AdmissionController::class, 'delete_admission_sutdent']); // this route work send parameter id and delete admession student
        Route::get('admission/sutdent/details/{id}', [AdmissionController::class, 'admission_sutdent_details'])->name('admission.sutdent.details');
        Route::get('active/admission/student', [AdmissionController::class, 'active_admission_sutdent']); //this route send parameter id and active sutudent;
        Route::get('deactive/admission/student', [AdmissionController::class, 'deactive_admission_sutdent']); //this route send parameter id and deactive sutudent;
        Route::get('addpement/student/data', [AdmissionController::class, 'add_pement_student_data']); //this rotue get specific student data ;
        Route::post('addpement/submit', [AdmissionController::class, 'add_pement_submit']);
        Route::get('all/student', [AdmissionController::class, 'all_student'])->name('all.student');
        Route::get('course/activity', [AdmissionController::class, 'course_activity'])->name('course.activity');
        Route::get('course/activity/details/{id}', [AdmissionController::class, 'course_activity_details'])->name('course.activity.details');
    });

    // this routes admin course management routes
    Route::middleware(['auth'])->group(function () {
        Route::get('course/message', [CourseController::class, 'course_message'])->name('course.message');
        Route::get('add/course', [CourseController::class, 'add_course'])->name('add.course');
        Route::post('add/course/submit', [CourseController::class, 'add_course_submit'])->name('add.course.submit');
        Route::get('delete/course/message', [CourseController::class, 'delete_course_message']); //this route work to delete course message
        Route::get('manage/course', [CourseController::class, 'manage_course'])->name('manage.course');
        Route::get('delete/course', [CourseController::class, 'delete_course']); //this route work to delete course item
        Route::get('edit/course/{id}', [CourseController::class, 'edit_course'])->name('edit.course');
        Route::get('course/details/{id}', [CourseController::class, 'course_details'])->name('course.details');
        Route::post('edit/course/submit', [CourseController::class, 'edit_course_submit'])->name('edit.course.submit');
        Route::get('active/course', [CourseController::class, 'active_course']);
        Route::get('deactive/course', [CourseController::class, 'deactive_course']);
        // image upload ck editor
        Route::post('image-upload', [CourseController::class, 'storeImage'])->name('image.upload');
    });


    // this routes admin services management routes
    Route::middleware(['auth'])->group(function () {
        Route::post('add-services-submit', [ServiceController::class, 'add_services_submit'])->name('services.submit');
        Route::get('add/services', [ServiceController::class, 'add_services'])->name('add.services');
        Route::get('services/message', [ServiceController::class, 'dashboard_services'])->name('services.message');
        Route::get('delete/services/message', [ServiceController::class, 'delete_services_message']); //this route work to delete services message
        Route::get('manage/services', [ServiceController::class, 'manage_services'])->name('manage.services');
        Route::get('delete/services', [ServiceController::class, 'delete_services']); //this route work to delete services item
        Route::get('edit-services/{id}', [ServiceController::class, 'edit_services'])->name('edit.services');
        Route::post('edit/services/submit', [ServiceController::class, 'edit_services_submit'])->name('edit.services.submit');
    });


    // this routes is admin user maiintain routes
    Route::middleware(['auth'])->group(function () {
        Route::get('user/maintain', [AdminController::class, 'user_maintain'])->name('user.maintain');
        Route::get('delete/user', [AdminController::class, 'delete_user']); // this route delete specific user
        Route::get('make/admin', [AdminController::class, 'make_admin']); // this route work send parameter id and make admin
        Route::get('cancle/admin', [AdminController::class, 'cancle_admin']); // this route work send parameter id and cancle admin
    });

    //  this routes is admin seminer management routes
    Route::middleware(['auth'])->group(function () {
        Route::get('add-seminer', [SeminerController::class, 'add_seminar'])->name('add.seminer');
        Route::post('add/seminar/submit', [SeminerController::class, 'add_seminar_submit'])->name('add.seminer.submit');
        Route::get('manage-seminer', [SeminerController::class, 'manage_seminer'])->name('manage.seminer');
        Route::get('delete/seminar', [SeminerController::class, 'delete_seminar']);
        Route::get('edit-seminar/{id}', [SeminerController::class, 'edit_seminar'])->name('edit.seminar');
        Route::post('edit/seminar/submit', [SeminerController::class, 'edit_seminar_submit'])->name('edit.seminar.submit');
    });


    // this route is admin gallery management routes
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard/gallery', [GalleryController::class, 'dashboard_gallery'])->name('dashboard.gallery');
        Route::get('dashboard/add/img', [GalleryController::class, 'add_img'])->name('dashboard.add.img');
        Route::post('add/gallery/img', [GalleryController::class, 'add_gallery_img'])->name('add.gallery.image');
        Route::get('delete/gallery/image', [GalleryController::class, 'delete_gallery_image']);
    });

    // this is admin tutorial manage routes
    Route::middleware(['auth'])->group(function () {
        Route::get('add/tutorial', [TutorialController::class, 'add_tutorial'])->name('add.tutorial');
        Route::post('add/tutorial/submit', [TutorialController::class, 'add_tutorial_submit'])->name('add.tutorial.submit');
        Route::get('manage/tutorial', [TutorialController::class, 'manage_tutorial'])->name('manage.tutorial');
        Route::get('manage/specific/tutorial/{id}', [TutorialController::class, 'manage_specific_tutorial'])->name('manage.specific.tutorial');
        Route::post('edit/tutorial/submit', [TutorialController::class, 'edit_tutorial_submit'])->name('edit.tutorial.submit');
        Route::get('edit/specific/tutorial/{id}', [TutorialController::class, 'edit_specific_tutorial'])->name('edit.specific.tutorial');
        Route::get('delete/tutorial', [TutorialController::class, 'delete_tutorial']);
    });
});



Route::middleware(['auth'])->group(function () {
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::name('review.')->prefix('review')->group(function () {
            Route::get('manage', [ClientReviewController::class, 'manage_client_review'])->name('manage');
            Route::get('add', [ClientReviewController::class, 'add_client_review'])->name('add');
            Route::get('update', [ClientReviewController::class, 'update_client_review'])->name('update');
            Route::post('add/submit', [ClientReviewController::class, 'add_client_review_submit'])->name('add.submit');
            Route::post('update/submit', [ClientReviewController::class, 'update_client_review_submit'])->name('update.submit');
            Route::get('delete', [ClientReviewController::class, 'client_review_delete'])->name('delete');
        });

        Route::name('blog.')->prefix('blog')->group(function () {
            Route::get('manage', [BlogController::class, 'manage_blog'])->name('manage');
            Route::get('add', [BlogController::class, 'add_blog'])->name('add');
            Route::get('update', [BlogController::class, 'update_blog'])->name('update');
            Route::post('add/submit', [BlogController::class, 'add_blog_submit'])->name('add.submit');
            Route::post('update/submit', [BlogController::class, 'update_blog_submit'])->name('update.submit');
            Route::get('delete', [BlogController::class, 'blog_delete'])->name('delete');
        });

    });
});
