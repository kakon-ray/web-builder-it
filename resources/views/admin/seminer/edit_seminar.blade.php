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
            <div class="card-header text-center">Update Free Seminer</div>

            <div class="card-body p-5">
                <form method="POST" action="{{ route('admin.edit.seminar.submit') }}" id="editseminer">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" class="d-none" name="id" value="{{ $edit_seminer->id }}">

                    <div class="my-4">
                        <label class="form-label">Seminer Title</label>
                        <input type="text" class="form-control" name="seminer_title"
                            value="{{ $edit_seminer->seminer_title }}">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="seminer_date"
                            value="{{ $edit_seminer->seminer_date }}">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" name="seminer_time"
                            value="{{ $edit_seminer->seminer_time }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>




            </div>
            </form>
        </div>
    </div>


@endsection()
