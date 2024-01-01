@extends('layouts.admin_app')
@section('title', 'Client Review')

@section('content')

    <style>
        #add_services_image_show {
            max-width: 445px;
            height: 300px;
            margin-left: -4px;

        }

        #services_img {
            max-width: 445px;
        }
    </style>


    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">Add <span style="color:#4e73df;"> Client Review</span></div>

            <div class="card-body p-5">
                <form method="POST" action="{{ route('dashboard.review.add.submit') }}" id="addClientReview" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="my-4">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" name="text"
                            placeholder="Client Name">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Review Desciption</label>
                        <textarea class="form-control pt-3" name="description" rows="3" placeholder="Review Desciption"></textarea>
                    </div>

                    <div class="my-4">
                        <label class="form-label">Client Image</label>
                        <input  name="image" type="file" class="form-control">
            
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>

            </div>
            </form>
        </div>
    </div>


@endsection()
