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
            <div class="card-header text-center">Add New Instructor</div>

            <div class="card-body mt-0">
                <form method="POST" action="{{ route('dashboard.instructor.submit') }}" id="instructoralert"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="my-4">
                        <label>Instructor Name</label>
                        <input required type="text" class="form-control" name="name"
                            placeholder="Instructor Name">
                    </div>

             
                    <div class="my-4">
                        <label class="form-label">Instructor Description</label>
                        <textarea name="description" class="form-control"  cols="30" rows="10"></textarea>
                    </div>

                    <div class="col-lg-3 mb-5">
                        <label>Instructor Image</label>
                        <input type="file" class="form-control" name="image" placeholder="Instructor Image">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection()
