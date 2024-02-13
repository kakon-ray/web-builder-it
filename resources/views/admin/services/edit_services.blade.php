@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <style>
        #edit_services_image_show {
            width: 100%;
            height: 300px;
            margin-left: -4px;

        }
    </style>
    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">Add Course Item</div>

            <div class="card-body mt-0">
                <form method="POST" action="{{ route('admin.edit.services.submit') }}" id="editservicesalert"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" class="d-none" name="id" value="{{ $services_details->id }}">

                    <div class="my-4">
                        <label>Services Title</label>
                        <input required type="text" class="form-control" name="services_title"
                            value="{{ $services_details->services_title }}" placeholder="Services Title">
                    </div>

                    <div class="my-4">
                        <label>Services Details</label>
                        <textarea class="form-control" id="add_course_editor" row="10" name="description">{{ $services_details->desc }}</textarea>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>New Services Profile Image</label>
                                <input id="edit_services_img" type="file" name="services_img" class="form-control">
                                <input type="text" value="{{ $services_details->services_img }}" name="old_image"
                                    class="form-control d-none">
                                <img src="{{ $services_details->services_img }}" id="edit_services_image_show"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6">
                                <label>Old Services Profile Image</label>
                                <input id="edit_services_img" type="text" value="{{ $services_details->services_img }}"
                                    class="form-control">
                                <img src="{{ $services_details->services_img }}" id="edit_services_image_show"
                                    class="img-fluid" alt="">
                            </div>
                        </div>
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
