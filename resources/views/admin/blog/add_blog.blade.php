@extends('layouts.admin_app')
@section('title', 'Dashboard')

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
            <div class="card-header text-center">Add Blog</div>

            <div class="card-body mt-0">
                <form method="POST" action="{{ route('dashboard.blog.add.submit') }}" id="submit_blog"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="my-4">
                        <label>Blog Title</label>
                        <input required type="text" class="form-control" name="title" placeholder="Blog Title">
                    </div>

                    <div class="my-4">
                        <label>Blog Details</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="description"></textarea>
                    </div>
                    <div class="my-4">
                        <label class="form-label">Blog Image</label>
                        <input name="image" type="file" class="form-control">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Category</label>
                        <select class="form-control rounded-0" name="category">
                            <option value="Web Development" selected>Web Development</option>
                            <option value="Laravel">Laravel</option>
                            <option value="Web Design">Web Design</option>
                            <option value="Front End Development">Front End Development</option>
                            <option value="Back End Development">Back End</option>
                            <option value="Programming">Programming</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Video Editing">Video Editing</option>
                            <option value="Laravel Website">Laravel Website</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

@endsection()
