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
                <form method="POST" action="{{ route('admin.edit.course.submit') }}" id="submitcourseadd"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" class="d-none" name="id" value="{{ $course_details->id }}">


                    <div class="row">
                        <div class="col-lg-6">
                            <label>Course Title</label>
                            <input required type="text" class="form-control" name="course_title"
                                value="{{ $course_details->course_title }}">
                        </div>
                        <div class="col-lg-3">
                            <label>Instructor Name</label>
                            <input type="text" class="form-control" name="instructor_name" value="{{ $course_details->instructor_name }}" placeholder="Instructor Name">
                        </div>
                        <div class="col-lg-3">
                            <label>Instructor Image</label>
                            <input type="file" class="form-control" name="instructor_img"  placeholder="Instructor Name">
                             <input type="hidden" name="old_instructor_image" value="{{ $course_details->instructor_img }}">
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-lg-12">
                            <label>Instructor Desc</label>
                            <textarea class="form-control" value="{{ $course_details->instructor_desc }}" name="instructor_desc" placeholder="Instructor Name"></textarea>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-lg-3">
                            <label class="form-label">Catagory</label>
                            <select class="form-control rounded-0" name="coursecategory_id">
                                @foreach ($course_catagory as $item)
                                 <option value="{{$item->id}}" @if($item->id == $course_details->coursecategory_id) selected  @endif>{{$item->category_name}}</option>
                                @endforeach
    
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <label>Batch</label>
                            <input required class="form-control" name="batch" type="number"
                                value="{{ $course_details->batch }}">
                        </div>
                        <div class="col-lg-2">
                            <label>Course Duration</label>
                            <input required type="number" max="6" class="form-control" name="duration"
                                value="{{ $course_details->duration }}">
                        </div>
                        <div class="col-lg-2">
                            <label>Total Lectures</label>
                            <input name="lectures" type="number" value="{{ $course_details->lectures }}"
                                class="form-control">
                        </div>
                        <div class="col-lg-3">

                            <label class="form-label">Language</label>
                            <select class="form-control rounded-0" name="language">
                                <option value="Bangla" {{ $course_details->language == 'Bangla' ? 'selected' : '' }}>Bangla
                                </option>
                                <option value="English" {{ $course_details->language == 'English' ? 'selected' : '' }}>
                                    English</option>
                            </select>

                        </div>

                    </div>


                    <div class="row gy-4">
                        <div class="col-lg-4">

                            <label>Projects</label>
                            <input required type="number" max="10" class="form-control" name="projects"
                                value="{{ $course_details->projects }}">
                        </div>


                        <div class="col-lg-4">

                            <label>Course Fee</label>
                            <input required type="number" class="form-control" name="course_fee"
                                value="{{ $course_details->course_fee }}">

                        </div>


                        <div class="col-lg-4">

                            <label>New Course Fee</label>
                            <input type="number" class="form-control" name="new_course_fee"
                                value="{{ $course_details->new_course_fee }}">

                        </div>


                        <div class="col-lg-4">

                            <label>Special Discount Course Fee</label>
                            <input type="number" class="form-control" name="spacial_discount"
                                value="{{ $course_details->spacial_discount }}">
                        </div>

                        <div class="col-lg-4">

                            <span>Course Profile Image</span>
                            <input value="{{ $course_details->course_img }}" name="old_image" type="text"
                                class="form-control d-none">
                            <input name="course_img" type="file" class="form-control">

                        </div>

                        <div class="col-lg-12">
                            <label>Course Description</label>
                            <textarea class="form-control" id="add_course_editor" row="10" name="desc">{{ $course_details->desc }}</textarea>
                        </div>

                        
                    </div>

                    <div class="pt-4">
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
