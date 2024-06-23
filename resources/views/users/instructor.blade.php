@extends('layouts.app')
@section('title')
    {{ 'All Blog | Web Builder IT' }}
@endsection

@section('content')

   {{-- blog section --}}

   <section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-4 text-center">
                <h2 class="text-center heading">Meet Our <span class="sm-red-title">Instructor</span></h2>
            </div>
                <div class="col-lg-4 mx-auto">
                    <div class="card">
                        <div class="p-4 text-center">
                            <img src="{{$course_details->instructor_img}}" style="height: 150px;width:150px" class="rounded-circle" alt="Client Review">
                            <h4 class="p-3">{{$course_details->instructor_name}}</h4>
                            <p>{{$course_details->instructor_desc}}</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>

@endsection
