@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <style>
        #edit_course_image_show {
            width: 445px;
            height: 300px;
            margin-left: -4px;

        }

        #edit_course_img {
            max-width: 445px;
        }
    </style>


    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">Edit Course Item</div>

            <div class="card-body p-5">
                <form method="POST" action="{{ route('admin.edit.course.submit') }}" id="editcoursealert"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" class="d-none" name="id" value="{{ $course_details->id }}">
                    <div class="my-4">
                        <label>Course Title</label>
                        <input id="course_title" required type="text" value="{{ $course_details->course_title }}"
                            class="form-control" name="course_title" placeholder="Course Title">
                    </div>

                    <div class="my-4">
                        <label>Course Fee</label>
                        <input id="course_fee" required type="text" value="{{ $course_details->course_fee }}"
                            class="form-control" name="course_fee" placeholder="Course Fee">
                    </div>

                    <div class="my-4">
                        <label>Course Description</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="description">{{ $course_details->desc }}</textarea>
                    </div>
                    <div class="my-4">
                        <span>Course Profile Image</span>
                        <input id="course_img" value="{{ $course_details->course_img }}" name="course_img_link"
                            type="text" class="form-control d-none">
                        <input id="course_img" name="course_img" type="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>

            </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@endsection()
