@extends('layouts.app')
@section('title')
{{ 'Home | Web Builder IT' }}
@endsection

@section('content')

<!-- banner -->
<section class="cariar-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h5><i class="fas fa-computer me-2"></i> ওয়েব ডেভেলপমেন্ট শেখার জন্য বাংলাদেশের সেরা আইটি ইনস্টিটিউট !
                </h5>
                <h2 class="pt-4">Learn Web Development with</h2>
                <h1 class="red-title fw-bold pb-3">Experts Developers</h1>
                <p class="cariar-details"> কোর্স এর শুরু থেকে চাকরি অথবা ফ্রিল্যান্সিং মার্কেটে একজন স্কিলফুল
                    ডেভেলপার না হওয়া পর্যন্ত আমাদের সাপোর্ট পাবেন। </p>
                <div class="cariar-button">
                    <a href="{{ route('user.course.contact') }}" class="btn-two mx-2 bg-white text-dark"><i
                            class="fas fa-book-open pe-2 text-dark"></i>Join Seminer</a>
                    <a href="{{ route('user.services.contact') }}" class="btn-two">Contact Developer</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('img/banner/img.jpg') }}" class="w-100 cariar-img" alt="Bangladesh">
            </div>
        </div>
    </div>
</section>

<!-- Recent course secction -->
<section class="course-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="fw-bold heading">OUR Recent <span class="sm-red-title">COURSES</span></h2>
                    <h6 class="pt-2">অভিজ্ঞ মেন্টর আর আপডেটেড কোর্স নিয়ে ওয়েব বিল্ডার আইটি প্রস্তুত আপনার
                        ক্যারিয়ার গড়ার
                        অগ্রযাত্রায়।</h6>
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
                    <span class="discount_badge">Spacial Discount {{$item->course_fee - $item->new_course_fee +
                        $item->spacial_discount}} ৳</span>
                    @endif

                    @if(!$item->new_course_fee && $item->spacial_discount)
                    <span class="discount_badge">Spacial Discount {{$item->spacial_discount}} ৳</span>
                    @endif

                    <a href="{{ route('user.course.details', ['id' => $item->id]) }}">
                        <img src="{{ $item->course_img }}" class="card-img-top p-3" alt="Course">
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
                                {{ $item->course_fee - $item->spacial_discount}} BDT
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

                        <div class="text-center">
                            @if(Auth::guard('student')->check())
                            @php
                            $enroll_course =
                            DB::table('active_courses')->where('course_id',$item->id)->where('student_id',Auth::guard('student')->user()->id)->where('status',true)->first();
                            $wishlist_course =
                            DB::table('active_courses')->where('course_id',$item->id)->where('student_id',Auth::guard('student')->user()->id)->where('status',false)->first();
                            $not_active_course =
                            DB::table('active_courses')->where('course_id',$item->id)->where('student_id',Auth::guard('student')->user()->id)->count();
                            @endphp



                            @if($enroll_course)
                            <h5 class="pt-0 pb-2"><a
                                    href="{{ route('student.classroom', ['id' => $enroll_course->id]) }}"
                                    style="color: #f3124e">Go to Classroom</a></h5>
                            @endif

                            @if($wishlist_course)
                            <h5 class="pt-0 pb-2"><a href="{{ route('student.wishlist')}}" style="color: #f3124e">Go to
                                    Wishlist</a></h5>
                            @endif

                            @if(!$not_active_course)
                            <h5 class="pt-0 pb-2"><a
                                    href="{{ route('student.active.course.classroom', ['course_id' => $item->id]) }}"
                                    style="color: #f3124e">Add to Wishlist</a></h5>
                            @endif

                            @endif
                        </div>

                        <a href="{{ route('user.course.details', ['id' => $item->id]) }}"
                            class="course-item-details-link">View Details</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>
        <div class="row pt-5">
            <div class="col-lg-2 mx-auto">
                <a href="{{ route('user.all.course') }}" class="common-btn">All Courses</a>
            </div>
        </div>
    </div>

</section>

<!-- Popular course secction -->
<section class="course-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="fw-bold heading">Most Popular <span class="sm-red-title">COURSES</span></h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($best_review_course->slice(0, 6) as $item)
            @if ($item->status == 1)
            <div class="col-lg-4 col-12 my-3">
                <div class="card position-relative">
                    @if($item->new_course_fee && !$item->spacial_discount)
                    <span class="discount_badge">Discount {{$item->course_fee - $item->new_course_fee}} ৳</span>
                    @endif

                    @if($item->new_course_fee && $item->spacial_discount)
                    <span class="discount_badge">Spacial Discount {{$item->course_fee - $item->new_course_fee +
                        $item->spacial_discount}} ৳</span>
                    @endif

                    @if(!$item->new_course_fee && $item->spacial_discount)
                    <span class="discount_badge">Spacial Discount {{$item->spacial_discount}} ৳</span>
                    @endif

                    <a href="{{ route('user.course.details', ['id' => $item->id]) }}">
                        <img src="{{ $item->course_img }}" class="card-img-top p-3" alt="Course">
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
                                {{ $item->course_fee - $item->spacial_discount}} BDT
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
                    
                        <div class="text-center">
                            @if(Auth::guard('student')->check())
                            @php
                            $enroll_course =
                            DB::table('active_courses')->where('course_id',$item->id)->where('student_id',Auth::guard('student')->user()->id)->where('status',true)->first();
                            $wishlist_course =
                            DB::table('active_courses')->where('course_id',$item->id)->where('student_id',Auth::guard('student')->user()->id)->where('status',false)->first();
                            $not_active_course =
                            DB::table('active_courses')->where('course_id',$item->id)->where('student_id',Auth::guard('student')->user()->id)->count();
                            @endphp



                            @if($enroll_course)
                            <h5 class="pt-0 pb-2"><a
                                    href="{{ route('student.classroom', ['id' => $enroll_course->id]) }}"
                                    style="color: #f3124e">Go to Classroom</a></h5>
                            @endif

                            @if($wishlist_course)
                            <h5 class="pt-0 pb-2"><a href="{{ route('student.wishlist')}}" style="color: #f3124e">Go to
                                    Wishlist</a></h5>
                            @endif

                            @if(!$not_active_course)
                            <h5 class="pt-0 pb-2"><a
                                    href="{{ route('student.active.course.classroom', ['course_id' => $item->id]) }}"
                                    style="color: #f3124e">Add to Wishlist</a></h5>
                            @endif

                            @endif
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

<!-- free seminer section -->

<section class="cariar-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 my-auto">
                <h2 class="mt-4 mb-0 pb-0 fw-bold heading2">অংশ নিন <span class="sm-red-title">ফ্রি সেমিনারে</span></h2>
                <p class="cariar-details py-3">ফ্রিল্যান্সিং-এর জন্য কোন কোর্স করবেন, সিদ্ধান্ত নিতে পারছেন না? জয়েন
                    করুন আমাদের ফ্রি সেমিনারে। বিষয়ভিত্তিক এই সেমিনারগুলোতে প্রতিটি কোর্সের সম্ভাবনা সম্পর্কে জানতে
                    পারবেন। তাছাড়া সেমিনারে উপস্থিত এক্সপার্ট কাউন্সেলরের সঙ্গে কথা বলে আপনি যথাযথ কোর্স বেছে নেওয়ার
                    সিদ্ধান্ত নিতে পারবেন সহজেই।</p>
                <div class="cariar-button mt-4">
                    <a href="{{ route('user.free.seminer') }}" class="common-btn pt-3">
                        সকল ফ্রি সেমিনারের সময়সূচী</a>

                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('img/banner/free-seminer.jpg') }}" class="w-100 cariar-img" alt="Bangladesh">
            </div>
        </div>
    </div>
</section>

{{-- Student review section --}}
<section class="our-portfolio my-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="fw-bold heading">STUDENTS <span class="sm-red-title"> SUCCESS STORY</span></h2>
            </div>
            <div class="col-lg-12">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    @foreach ($allClientReview as $item)
                    @if ($item->categorie == 'student_review')
                    <div class="item carosel_item_container">
                        <div class="card">
                            <div class="p-4 text-center">
                                <p>{{ $item->description }}</p>
                                @if ($item->image)
                                <img src="{{ $item->image }}" alt="Client Review">
                                @else
                                <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}" alt="Client Review">
                                @endif
                                <h4 class="p-3">{{ $item->name }}</h4>
                                <div class="star-rating">
                                    @if ($item->review_star == 5)
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    @elseif($item->review_star == 4)
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    @elseif($item->review_star < 4) <i class="fa fa-star active" aria-hidden="true"></i>
                                        <i class="fa fa-star active" aria-hidden="true"></i>
                                        <i class="fa fa-star active" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        @endif

                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

<!-- home cta section -->
<section id="home_cta">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4>Free Consultation</h4>
                <h2 class="pt-3">Ready to start your dream project?</h2>
                <p>We Have Made it Easy for Clients to Reach Us and Get Their <br>Solutions Weaved.</p>
            </div>
            <div class="col-lg-4 d-flex align-items-center mt-4">
                <a href="{{ route('user.services.contact') }}" class="theme-btn-cta">Request A Free Consultation</a>
            </div>
        </div>
    </div>
</section>



<!-- services secction -->

<section class="course-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="fw-bold heading">OUR <span class="sm-red-title">SERVICES</span></h2>

                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($allServices->slice(0, 6) as $item)
            <div class="col-lg-4 col-12 my-3">
                <div class="card">
                    <a href="{{ route('user.services.details', ['id' => $item->id]) }}">
                        <img src="{{ $item->services_img }}" class="card-img-top p-3" alt="Course">
                    </a>

                    <div class="card-body">
                        <h3 class="card-title">{{ $item->services_title }}</h3>
                        <div class="review">
                            <h5>Contact Us</h5>
                            <h5><a href="tel:+8801707500512">+8801707500512</a></h5>
                        </div>
                        <a href="{{ route('user.services.details', ['id' => $item->id]) }}"
                            class="course-item-details-link">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
        <div class="row pt-5">
            <div class="col-lg-2 mx-auto">
                <a href="{{ route('user.all.service') }}" class="common-btn">All Services</a>
            </div>
        </div>
    </div>

</section>

<!-- technology use section -->

<section id="technology-uses">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="text-center">
                    <h2 class="heading fw-bold"><span class="sm-red-title">Technology</span> Uses</h2>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/laravel.png') }}" alt="JavaScript">
                                    <h3>Laravel <br> Frameworks</h3>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/js.png') }}" alt="JavaScript">
                                    <h3> JavaScript <br> Frameworks</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/react.png') }}" alt="JavaScript">
                                    <h3>React Js </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/jqery.png') }}" alt="JavaScript">
                                    <h3>Jquery</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/node.png') }}" alt="JavaScript">
                                    <h3>NodeJs </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/express.png') }}" alt="JavaScript">
                                    <h3>Express.js <br> Frameworks</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/wordpress.png') }}" alt="JavaScript">
                                    <h3>Wordpress <br> Website</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 my-2">
                        <a href="{{ url('user/services-contact') }}">
                            <div class="card">
                                <div class="d-flex align-items-center gap-2 p-4">
                                    <img src="{{ asset('img/technology use/wordpress.png') }}" alt="JavaScript">
                                    <h3>Wordpress <br> Development</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- carosel section -->


<section id="gallery">
    <div class="container">
        <div class="gallery">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row g-4">
                        <div class="col-lg-12 text-center">
                            <h2 class="text-center heading fw-bold">Gallery</h2>
                        </div>

                        @foreach ($gallery_image->slice(0, 6) as $item)
                        <div class="col-lg-4">
                            <a href="{{ $item->gallery_img }}" class="big"><img src="{{ $item->gallery_img }}"
                                    alt=""></a>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
</section>


{{-- client review section --}}

<section class="our-portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-center heading fw-bold">Our Happy <span class="sm-red-title">Clients Review</span>
                </h2>
            </div>
            <div class="col-lg-12">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    @foreach ($allClientReview as $item)
                    @if ($item->categorie == 'client_review')
                    <div class="item carosel_item_container">
                        <div class="card">
                            <div class="p-4 text-center">
                                <p>{{ $item->description }}</p>
                                @if ($item->image)
                                <img src="{{ $item->image }}" alt="Client Review">
                                @else
                                <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}" alt="Client Review">
                                @endif
                                <h4 class="p-3">{{ $item->name }}</h4>
                                <div class="star-rating">
                                    @if ($item->review_star == 5)
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    @elseif($item->review_star == 4)
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    @elseif($item->review_star < 4) <i class="fa fa-star active" aria-hidden="true"></i>
                                        <i class="fa fa-star active" aria-hidden="true"></i>
                                        <i class="fa fa-star active" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        @endif

                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

{{-- blog section --}}

<section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center pb-4">
                <h2 class="fw-bold heading">Our Letest <span class="sm-red-title">Blog</span></h2>
            </div>
            @foreach ($blog as $item)
            <div class="col-lg-4">
                <div class="blog-card">
                    <a href="{{ route('user.blog.details', $item->id) }}">
                        <img src="{{ $item->image }}" class="w-100" alt="Blog Image">
                    </a>

                    <div class="blog-content">
                        <h4 class="blog-title">{{ $item->title }}</h4>
                        <p>
                            @php
                            echo substr($item->description, 0, 100);
                            @endphp
                        </p>

                        <p><a href="{{ route('user.blog.details', $item->id) }}" class="blog-button">Read More <i
                                    class="fas fa-angle-double-right"></i></a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-2 mx-auto my-4">
                <a href="{{ route('user.all.blog') }}" class="common-btn">All Blog</a>
            </div>
        </div>
    </div>
</section>
@endsection