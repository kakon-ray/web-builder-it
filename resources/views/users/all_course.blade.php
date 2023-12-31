@extends('layouts.app')
@section('title')
    {{ 'All Course | Web Builder IT' }}
@endsection

@section('content')

    <!-- course secction -->
    <section class="all-course">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">জনপ্রিয় কোর্সসমূহ</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($allCourse))
                    @foreach ($allCourse as $item)
                        @if ($item->status == true)
                            <div class="col-lg-3">
                                <div class="card mt-4">
                                    <a href="{{ route('user.course.details', ['id' => $item->id]) }}">
                                        <img src="{{ $item->course_img }}" class="card-img-top" alt="Course">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->course_title }}</h5>
                                        <div class="review">
                                            <div class="d-flex">
                                                <i class="far fa-star fa-sm text-warning p-1"></i>
                                                <i class="far fa-star fa-sm text-warning p-1"></i>
                                                <i class="far fa-star fa-sm text-warning p-1"></i>
                                                <i class="far fa-star fa-sm text-warning p-1"></i>
                                                <i class="far fa-star fa-sm text-warning p-1"></i>
                                            </div>
                                            <p class="pt-3">1000 স্টুডেন্ট</p>
                                        </div>
                                        <a href="{{ route('user.course.details', ['id' => $item->id]) }}"
                                            class="common-btn ms-0">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                @if (isset($notFound))
                    <h2 class="text-center">{{ $notFound }}</h2>
                @endif



            </div>
        </div>

    </section>

@endsection
