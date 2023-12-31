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
            <div class="card-header text-center">Update Tutorial</div>

            <div class="card-body p-5">
                <form method="POST" action="{{ route('admin.edit.tutorial.submit') }}" id="editTutorialControllerAlert">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $tutorial_details->id }}">

                    <div class="mb-4">
                        <label class="form-label">Video Title</label>
                        <input name="video_title" type="text" class="form-control"
                            value="{{ $tutorial_details->video_title }}">
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form4Example2">Select Course</label>
                        <select class="form-select" name="course_id" id="course_name" aria-label="Default select example">

                            @foreach ($all_course as $item)
                                @if ($tutorial_details->course_id == $item->id)
                                    <option value="{{ $item->id }}">{{ $item->course_title }}</option>
                                @endif
                            @endforeach

                            @foreach ($all_course as $item)
                                @if ($tutorial_details->course_id !== $item->id)
                                    <option value="{{ $item->id }}">{{ $item->course_title }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="my-4">
                        <label class="form-label">Video Upload</label>

                        <div class="row">
                            <div class="col-lg-9 me-0 pe-0">
                                <input name="video_link" type="text" class="form-control"
                                    value="{{ $tutorial_details->video_link }}">
                            </div>
                            <div class="col-lg-3 ms-0 ps-0">
                                <select class="form-select" name="hosting_type" id="hosting_type"
                                    aria-label="Default select example">

                                    @if ($tutorial_details->hosting_type == 'googlecloud')
                                        <option value="googlecloud">Google Cloud</option>
                                        <option value="youtube">You Tube</option>
                                    @else
                                        <option value="youtube">You Tube</option>
                                        <option value="googlecloud">Google Cloud</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Other Document Download</label>
                    <input name="other_document" type="text" class="form-control"
                        value="{{ $tutorial_details->other_document }}">

                    <button type="submit" class="btn btn-primary mt-4">
                        Submit
                    </button>
            </div>



        </div>
        </form>
    </div>
    </div>


@endsection()
