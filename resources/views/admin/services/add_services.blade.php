@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <style>
        #add_services_image_show {
            max-width: 445px;
            height: 300px;
            margin-left: -4px;

        }
    </style>

    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">Add Services Item</div>

            <div class="card-body mt-0">
                <form method="POST" action="{{ route('admin.services.submit') }}" id="addservicesalert"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="my-4">
                        <label>Services Title</label>
                        <input required type="text" class="form-control" name="services_title"
                            placeholder="Services Title">
                    </div>

                    <div class="my-4">
                        <label>Services Details</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="description"></textarea>
                    </div>
                    <div class="my-4">
                        <label class="form-label">Services Image</label>
                        <input name="services_img" type="file" class="form-control">
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
