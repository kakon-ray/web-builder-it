@extends('layouts.app')
@section('title')
    {{ 'All Services | Web Builder IT' }}
@endsection

@section('content')

    <!-- services secction -->

    <section class="course-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold heading">OUR <span class="sm-red-title">SERVICES</span></h2>

                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($allServices->slice(0, 8) as $item)
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <a href="{{ route('user.services.details', ['id' => $item->id]) }}">
                                <img src="{{ $item->services_img }}" class="card-img-top" alt="Course">
                            </a>

                            <div class="card-body">
                                <h3 class="card-title">{{ $item->services_title }}</h3>
                                <div class="review">
                                    <h5>Contact Us</h5>
                                    <h5>+8801707500512</h5>
                                </div>
                                <a href="{{ route('user.services.details', ['id' => $item->id]) }}"
                                    class="course-item-details-link">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

@endsection
