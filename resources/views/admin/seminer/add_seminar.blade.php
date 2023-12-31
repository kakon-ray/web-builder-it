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
            <div class="card-header text-center">Add Free Seminer</div>

            <div class="card-body p-5">
                <form method="POST" action="{{ route('admin.add.seminer.submit') }}" id="addsemineralert">
                    @csrf

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="my-4">
                        <label class="form-label">Seminer Title</label>
                        <input name="seminer_title" type="text" class="form-control" name="text"
                            placeholder="Seminer Title">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Date</label>
                        <input name="seminer_date" type="date" class="form-control" name="text"
                            placeholder="Seminer Title">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Time</label>
                        <input name="seminer_time" type="time" class="form-control" name="text"
                            placeholder="Seminer Title">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>

            </div>
            </form>
        </div>
    </div>


@endsection()
