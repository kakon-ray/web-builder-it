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
                    <h5><i class="fas fa-book-open me-2"></i> ওয়েব বিল্ডার আইটিতে আপনাকে স্বাগতম ! </h5>
                    <h2 class="mt-4 mb-0 pb-0">ওয়েব ডেভেলপমেন্ট শিখুন</h2>
                    <h1 class="red-title mt-0 pt-0">লাইভ ক্লাসে</h1>
                    <p class="cariar-details"> আপনার যাত্রার শুরু থেকে চাকরি অথবা ফ্রিল্যান্সিং মার্কেটে একজন স্কিলফুল
                        ডেভেলপার না হওয়া পর্যন্ত আমাদের সাপোর্ট পাবেন। </p>
                    <div class="cariar-button">
                        <a href="{{ route('user.course.contact') }}" class="btn-one"><i
                                class="fas fa-book-open pe-2"></i>Admission Form</a>
                        <a href="{{ route('user.services.contact') }}" class="btn-two"><i
                                class="fas fa-book-open pe-2"></i>Services Ptoject</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('img/banner/img.jpg') }}" class="w-100 cariar-img" alt="Bangladesh">
                </div>
            </div>
        </div>
    </section>

    <!-- course secction -->
    <section class="course-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold heading">জনপ্রিয় <span class="sm-red-title">কোর্সসমূহ</span></h2>
                        <h6 class="pt-2">অভিজ্ঞ মেন্টর আর আপডেটেড কারিকুলাম নিয়ে ওয়েব বিল্ডার আইটি প্রস্তুত আপনার
                            ক্যারিয়ার গড়ার
                            অগ্রযাত্রায়।</h6>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($allCourse->slice(0, 8) as $item)
                    @if ($item->status == 1)
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
                                        <p>1000 স্টুডেন্ট</p>
                                    </div>
                                    <a href="{{ route('user.course.details', ['id' => $item->id]) }}"
                                        class="common-btn pb-2">বিস্তারিত</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>
            <div class="row pt-5 mt-5">
                <div class="col-lg-2 mx-auto">
                    <a href="{{ route('user.all.course') }}" class="common-btn">সকল কোর্স</a>
                </div>
            </div>
        </div>

    </section>

    <!-- free seminer section -->

    <section class="cariar-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 my-auto">
                    <h2 class="mt-4 mb-0 pb-0 heading">অংশ নিন <span class="sm-red-title">ফ্রি সেমিনারে</span></h2>
                    <p class="cariar-details py-3">ফ্রিল্যান্সিং-এর জন্য কোন কোর্স করবেন, সিদ্ধান্ত নিতে পারছেন না? জয়েন
                        করুন আমাদের ফ্রি সেমিনারে। বিষয়ভিত্তিক এই সেমিনারগুলোতে প্রতিটি কোর্সের সম্ভাবনা সম্পর্কে জানতে
                        পারবেন। তাছাড়া সেমিনারে উপস্থিত এক্সপার্ট কাউন্সেলরের সঙ্গে কথা বলে আপনি যথাযথ কোর্স বেছে নেওয়ার
                        সিদ্ধান্ত নিতে পারবেন সহজেই।</p>
                    <div class="cariar-button mt-4">
                        <a href="{{ route('user.free.seminer') }}" class="common-btn pt-3"><i class="fas fa-book-open"></i>
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
    <section class="our-portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-center heading">Our <span class="sm-red-title">Students Review</span></h2>
                </div>
                <div class="col-lg-12 pt-4">
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
                                            <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}"
                                                alt="Client Review">
                                        @endif
                                        <h4 class="p-3">{{ $item->name }}</h4>
                                        <div class="star-rating">
                                            @if ($item->review_star == 5)
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                            @elseif($item->review_star < 5)
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
                                                <i class="fa fa-star active" aria-hidden="true"></i>
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
                <div class="col-lg-4 d-flex align-items-center">
                    <a href="{{ url('user/services-contact') }}" class="theme-btn-cta">Request A Free Consultation</a>
                </div>
            </div>
        </div>
    </section>



    <!-- services secction -->
    <section class="course-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold heading">জনপ্রিয় <span class="sm-red-title">সার্ভিস</span></h2>
                        <h6 class="pt-2">অভিজ্ঞ মেন্টর আর আপডেটেড কারিকুলাম নিয়ে উমা আই.টি প্রস্তুত আপনার ক্যারিয়ার গড়ার
                            অগ্রযাত্রায়। আমাদের ১০ টিরও বেশি ট্রেন্ডি কোর্স থেকে আজই বেছে নিন আপনার পছন্দের কোর্স।</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($allServices->slice(0, 8) as $item)
                    <div class="col-lg-3">
                        <div class="card mt-3">
                            <img src="{{ $item->services_img }}" class="card-img-top" alt="Course">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->services_title }}</h5>
                                <div class="review">
                                    <p>ক্লাইন্ট রিভিঊঃ </p>
                                    <div class="d-flex">
                                        <i class="far fa-star fa-sm text-warning p-1"></i>
                                        <i class="far fa-star fa-sm text-warning p-1"></i>
                                        <i class="far fa-star fa-sm text-warning p-1"></i>
                                        <i class="far fa-star fa-sm text-warning p-1"></i>
                                        <i class="far fa-star fa-sm text-warning p-1"></i>
                                    </div>

                                </div>
                                <a href="{{ route('user.services.details', ['id' => $item->id]) }}"
                                    class="common-btn">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row pt-5 mt-5">
                <div class="col-lg-2 mx-auto">
                    <a href="{{ route('user.all.service') }}" class="common-btn">সকল সার্ভিস</a>
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
                        <h2 class="heading"><span class="sm-red-title">Technology</span> Uses</h2>
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/laravel.png') }}" alt="JavaScript">
                                        <h3>Laravel <br> Frameworks</h3>
                                    </div>
                                </div>
                            </a>

                        </div>

                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/js.png') }}" alt="JavaScript">
                                        <h3> JavaScript <br> Frameworks</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/react.png') }}" alt="JavaScript">
                                        <h3>React Js </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/jqery.png') }}" alt="JavaScript">
                                        <h3>Jquery</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/node.png') }}" alt="JavaScript">
                                        <h3>NodeJs </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/express.png') }}" alt="JavaScript">
                                        <h3>Express.js <br> Frameworks</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
                                        <img src="{{ asset('img/technology use/wordpress.png') }}" alt="JavaScript">
                                        <h3>Wordpress <br> Website</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 my-2">
                            <a href="{{ url('user/services-contact') }}">
                                <div class="card">
                                    <div class="d-flex align-items-center gap-4 p-4">
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
                                <h2 class="text-center heading">Gallery</h2>
                            </div>

                            @foreach ($gallery_image->slice(0, 6) as $item)
                                <div class="col-lg-4">
                                    <a href="{{ $item->gallery_img }}" class="big"><img
                                            src="{{ $item->gallery_img }}" alt=""></a>
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
                    <h2 class="text-center heading">Our <span class="sm-red-title">Happy Clients Review</span></h2>
                </div>
                <div class="col-lg-12 pt-4">
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
                                                <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}"
                                                    alt="Client Review">
                                            @endif
                                            <h4 class="p-3">{{ $item->name }}</h4>
                                            <div class="star-rating">
                                                @if ($item->review_star == 5)
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                @elseif($item->review_star < 5)
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                                    <i class="fa fa-star active" aria-hidden="true"></i>
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
@endsection
