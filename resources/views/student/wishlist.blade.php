@extends('layouts.app')
@section('title')
{{ 'Course Admission | Web Builder IT ' }}
@endsection

@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col-lg-12 pb-3 text-center">
            <h2 class="heading fw-bold">My<span class="sm-red-title"> Wishlist</span></h2>
        </div>
    </div>
    <div class="row">
    @foreach ($activeCourse as $item)

        @if(!$item->pement_clear)
        <div class="col-lg-4">
            <div class="card mt-4 position-relative">

                <img src="{{ $item->add_course->course_img }}" class="card-img-top" style="height:200px" alt="Course">

                <div class="card-body">
                    <h5 class="card-title">{{ $item->add_course->course_title }}</h5>
                    <div class="review">
                        <div class="d-flex">
                            <i class="far fa-star fa-sm text-warning p-1"></i>
                            <i class="far fa-star fa-sm text-warning p-1"></i>
                            <i class="far fa-star fa-sm text-warning p-1"></i>
                            <i class="far fa-star fa-sm text-warning p-1"></i>
                            <i class="far fa-star fa-sm text-warning p-1"></i>
                        </div>
                        <p>1000 স্টুডেন্ট</p>
                    </div>


                    <div class="d-flex justify-content-between">
                        <a href="{{ route('student.checkout', ['id' => $item->id]) }}" class="common-btn">Pay Now</a>
                        <a href="{{ route('student.cancle.enroll', ['id' => $item->id]) }}" class="common-btn">Remove Course</a>
                    </div>

                </div>
            </div>
        </div>
        @endif

        @endforeach


    </div>
</div>


<!-- Best selling course secction -->
<section class="course-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="fw-bold heading">Best Selling <span class="sm-red-title">COURSES</span></h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($best_selling_course->slice(0, 6) as $item)
            @if ($item->status == 1)
            <div class="col-lg-4 col-12 my-3">
                <div class="card position-relative">
                    @if($item->new_course_fee && !$item->spacial_discount)
                    <span class="discount_badge">Discount {{$item->course_fee - $item->new_course_fee}} ৳</span>
                    @endif

                    @if($item->new_course_fee && $item->spacial_discount)
                    <span class="discount_badge">Discount {{$item->course_fee - $item->new_course_fee +
                        $item->spacial_discount}} ৳</span>
                    @endif

                    @if(!$item->new_course_fee && $item->spacial_discount)
                    <span class="discount_badge">Discount {{$item->spacial_discount}} ৳</span>
                    @endif

                    <img src="{{ $item->course_img }}" class="card-img-top p-3" alt="Course">

                    <div class="card-body">
                        <h3 class="card-title">{{ $item->course_title }}</h3>
                        <div class="review">
                            <h5>Course Fee</h5>

                            <h5>
                                @if ($item->new_course_fee && !$item->spacial_discount)
                                <del class="text-dark px-3"> {{ $item->course_fee }} BDT</del>
                                {{ $item->new_course_fee }} BDT
                                @endif

                                @if (!$item->new_course_fee && $item->spacial_discount)
                                <del class="text-dark px-3"> {{ $item->course_fee }} BDT</del>
                                {{ $item->course_fee -  $item->spacial_discount}} BDT
                                @endif

                              @if($item->new_course_fee && $item->spacial_discount)
                               <del class="text-dark px-3"> {{ $item->course_fee }} BDT</del>
                                {{ $item->new_course_fee - $item->spacial_discount }} BDT
                                @endif

                                @if(!$item->new_course_fee && !$item->spacial_discount)
                                {{ $item->course_fee}} BDT
                              @endif

                            </h5>
                        </div>
                        <a href="{{ route('user.course.details', ['id' => $item->id]) }}"
                            class="course-item-details-link">View Details</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>

    </div>

</section>

@endsection