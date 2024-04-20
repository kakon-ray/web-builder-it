@extends('layouts.admin_app')
@section('title', 'Add Course Catagory')

@section('content')

    <style>
        #add_services_image_show {
            max-width: 445px;
            height: 300px;
            margin-left: -4px;

        }

        .ck-editor__editable_inline {
            min-height: 400px;
        }

        #add_course_editor {
            height: 400px;
        }
    </style>

    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">Edit Course Catagory</div>

            <div class="card-body mt-0">
                <form method="POST" action="{{ route('admin.course.catagory.edit.submit') }}" id="submit_category"
                    enctype="multipart/form-data">
                    @csrf
                     
                    <input type="text" value="{{$course_catagory->id}}" name="id" class="d-none">

                    <div class="my-4">
                        <label>Catagory Name</label>
                        <input required type="text" class="form-control" name="category_name" value="{{$course_catagory->category_name}}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection()
