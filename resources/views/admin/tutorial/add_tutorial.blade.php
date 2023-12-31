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
            <div class="card-header text-center">Add Tutorial</div>

            <div class="card-body p-5">
                <form method="POST" action="{{ route('admin.add.tutorial.submit') }}" id="addtutorialalert">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="mb-4">
                        <label class="form-label">Video Title</label>
                        <input name="video_title" type="text" class="form-control" placeholder="Video Title">
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form4Example2">Select Course</label>
                        <select class="form-select" name="course_id" id="course_name" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach ($all_course as $item)
                                <option value="{{ $item->id }}">{{ $item->course_title }}</option>
                            @endforeach


                        </select>
                    </div>
                    <div class="my-4">
                        <label class="form-label">Video Link ( Google Drive and Youtube Embed src url )</label>
                        <div class="row">
                            <div class="col-lg-9 me-0 pe-0">
                                <input name="video_link" type="text" class="form-control" placeholder="Google Share Link ID">
                            </div>
                            <div class="col-lg-3 ms-0 ps-0">
                                <select class="form-select" name="hosting_type" id="hosting_type" aria-label="Default select example">
                                    <option value="googlecloud">Google Cloud</option>
                                    <option value="youtube">You Tube</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Other Document Download</label>
                    <input name="other_document" type="text" class="form-control" placeholder="Download Link">

                    <button type="submit" class="btn btn-primary mt-4">
                        Submit
                    </button>
            </div>



        </div>
        </form>
    </div>
    </div>


@endsection()
