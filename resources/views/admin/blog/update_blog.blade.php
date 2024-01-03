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
                <form method="POST" action="{{ route('dashboard.blog.update.submit') }}" id="submit_blog"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$blogDetails->id}}">

                    <div class="my-4">
                        <label>Blog Title</label>
                        <input required type="text" class="form-control" name="title" value="{{$blogDetails->title}}">
                    </div>

                    <div class="my-4">
                        <label>Blog Details</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="description">{{$blogDetails->description}}</textarea>
                    </div>

                    <div class="my-4">
                        <label class="form-label">Category</label>
                        <select class="form-control rounded-0" name="category">
                            <option value="web_development" {{$blogDetails->category == 'web_development' ? 'selected' : ''}}>Web Development</option>
                            <option value="laravel" {{$blogDetails->category == 'laravel' ? 'selected' : ''}}>Laravel</option>
                            <option value="web_design" {{$blogDetails->category == 'web_design' ? 'selected' : ''}}>Web Design</option>
                            <option value="front_den" {{$blogDetails->category == 'front_den' ? 'selected' : ''}}>Front End</option>
                            <option value="back_end" {{$blogDetails->category == 'back_end' ? 'selected' : ''}}>Back End</option>
                            <option value="programming" {{$blogDetails->category == 'programming' ? 'selected' : ''}}>Programming</option>
                            <option value="other" {{$blogDetails->category == 'other' ? 'selected' : ''}}>Other</option>
                        </select>
                    </div>
                    
                    <div class="my-4">
                        <label class="form-label">Blog Image</label>
                        <input type="text" class="d-none" name="old_image" value="{{ $blogDetails->image }}">
                        <input name="image" type="file" class="form-control">
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
