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


                <div class="row">
                    <div class="col-lg-8">
                        <label>Course Title</label>
                        <input required type="text" class="form-control" name="course_title" placeholder="Course Title">
                    </div>
                    <div class="col-lg-4">
                        <label>Instructor Name</label>
                        <input type="text" class="form-control" name="instructor" placeholder="Instructor Name">
                    </div>
                </div>
                <div class="row py-4">
                    <div class="col-lg-2">
                        <label>Batch</label>
                        <input required type="number" class="form-control" name="batch" placeholder="1">
                    </div>
                    <div class="col-lg-2">
                        <label>Duration</label>
                        <input required type="number" max="6" class="form-control" name="duration" placeholder="6">
                    </div>
                    <div class="col-lg-2">
                        <label>Total Lectures</label>
                        <input required class="form-control" name="lectures" type="number" placeholder="36">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-label">Language</label>
                        <select class="form-control rounded-0" name="language">
                            <option value="Bangla" selected>Bangla</option>
                            <option value="English">English</option>
                        </select>

                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Catagory</label>
                        <select class="form-control rounded-0" name="coursecategory_id">
                            @foreach ($course_catagory as $item)
                             <option value="{{$item->id}}">{{$item->category_name}}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="row gy-4">
                    <div class="col-lg-4">

                        <label>Projects</label>
                        <input required type="number" max="10" class="form-control" name="projects"
                            placeholder="Total Projects">

                    </div>
                    <div class="col-lg-4">

                        <label>Course Fee</label>
                        <input required type="number" class="form-control" name="course_fee" placeholder="Course Fee">

                    </div>

                    <div class="col-lg-4">

                        <label>New Course Fee</label>
                        <input type="number" class="form-control" name="new_course_fee" placeholder="New Course Fee">

                    </div>

                    <div class="col-lg-4">

                        <label>Special Discount Course Fee</label>
                        <input type="number" class="form-control" name="spacial_discount">
                    </div>




                    <div class="col-lg-4">

                        <span>Course Profile Image</span>
                        <input name="course_img" type="file" class="form-control">

                    </div>


                    <div class="col-lg-12">
                        <label>Course Description</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="desc"></textarea>
                    </div>


                </div>



                <div class="py-4">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>

        </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

@endsection()