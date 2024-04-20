@extends('layouts.app')
@section('title')
    {{ 'All Course | Web Builder IT' }}
@endsection

@section('content')

    <!-- course secction -->
    <section class="course-section">
        <div class="container">

            <div class="row">

                @if (isset($allCatagoryCourse))
                    <div class="col-lg-12 col-md-10 mx-auto">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold heading">{{$allCatagoryCourse->category_name}} <span class="sm-red-title">COURSES</span></h2>

                        </div>
                    </div>
                @else
                    <div class="col-lg-12 col-md-10 mx-auto">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Course<span class="sm-red-title"> Not Found</span></h2>

                        </div>
                    </div>
                @endif
                @if (isset($allCatagoryCourse))
                    @foreach ($allCatagoryCourse->add_course as $item)
                        @if ($item->status == 1)
                        <div class="col-lg-4 col-12 my-3">
                            <div class="card">
                                <a href="{{ route('user.course.details', ['id' => $item->id]) }}">
                                    <img src="{{ $item->course_img }}" class="card-img-top p-3" alt="Course">
                                </a>

                                <div class="card-body">
                                    <h3 class="card-title">{{ $item->course_title }}</h3>
                                    <div class="review">
                                        <h5>Course Fee</h5>
                                      
                                        <h5>@if($item->new_course_fee) <del class="text-dark px-3"> {{$item->course_fee}} BDT</del> {{ $item->new_course_fee }} BDT @else {{$item->course_fee}} BDT  @endif </h5>
                                    </div>
                                    <a href="{{ route('user.course.details', ['id' => $item->id]) }}"
                                        class="course-item-details-link">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif

            </div>

        </div>

    </section>

@endsection
