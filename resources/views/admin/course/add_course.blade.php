@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <style>
        #add_course_image_show {
            max-width: 445px;
            height: 300px;
            margin-left: -4px;
        }
    </style>

    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">Add Course Item</div>

            <div class="card-body mt-0">
                <form method="POST" action="{{ route('admin.add.course.submit') }}" id="submitcourseadd"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="my-4">
                        <label>Course Title</label>
                        <input id="course_title" required type="text" class="form-control" name="course_title"
                            placeholder="Course Title">
                    </div>

                    <div class="my-4">
                        <label>Course Fee</label>
                        <input id="course_fee" required type="text" class="form-control" name="course_fee"
                            placeholder="Course Fee">
                    </div>

                    <div class="my-4">
                        <label>Course Description</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="description"></textarea>
                    </div>
                    <div class="my-4">
                        <span>Course Profile Image</span>
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
