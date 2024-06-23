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
                            <img src="{{$instructor->image}}" style="height: 150px;width:150px" class="rounded-circle" alt="Client Review">
                            <h4 class="p-3">{{$instructor->name}}</h4>
                            <p>{{$instructor->description}}</p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row pt-5">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="fw-bold heading">{{$instructor->name}}'s' <span class="sm-red-title">COURSES</span></h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($allCourse->slice(0, 6) as $item)
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

                    <a href="{{ route('user.course.details', ['id' => $item->id]) }}">
                        <img src="{{ $item->course_img }}" style="height: 350px" class="card-img-top p-3" alt="Course">
                    </a>

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
