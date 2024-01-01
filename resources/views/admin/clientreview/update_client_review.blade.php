@extends('layouts.admin_app')
@section('title', 'Dashboard')

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
            <div class="card-header text-center">Update<span style="color:#4e73df;"> Client Review</span></div>

            <div class="card-body px-5">
                <form method="POST" action="{{ route('dashboard.review.update.submit') }}" id="addClientReview"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $reviewDetails->id }}">

                    <div class="my-4">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" name="text"
                            value="{{ $reviewDetails->name }}">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Review Star</label>
                        <input name="review_star" type="number" min="1" max="5" class="form-control"
                            value="{{ $reviewDetails->review_star }}">
                    </div>

                    <div class="my-4">
                        <label class="form-label">Review Category</label>
                        <select class="form-control rounded-0" name="categorie">
                            <option value="student_review" {{$reviewDetails->categorie == 'student_review' ? 'selected' : ''}} >Student Review</option>
                            <option value="client_review" {{$reviewDetails->categorie == 'client_review' ? 'selected' : ''}}>Client Review</option>
                        </select>
                    </div>

                    <div class="my-4">
                        <label class="form-label">Review Desciption</label>
                        <textarea class="form-control pt-3" name="description" rows="3" placeholder="Review Desciption"> {{ $reviewDetails->description }}</textarea>
                    </div>

                    <div class="my-4">
                        <label class="form-label">Client Image</label>
                        <input type="text" class="d-none" name="old_image" value="{{ $reviewDetails->image }}">
                        <input name="image" type="file" class="form-control" name="text" placeholder="Client Name">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>

            </div>
            </form>
        </div>
    </div>


@endsection()
