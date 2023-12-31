@extends('layouts.app')
@section('title')
    {{ 'Web Design Details | Web Builder IT' }}
@endsection

@section('content')
    <!-- banner -->
    <section class="cariar-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="pb-3"><i class="fas fa-book-open me-2"></i>দেশ সেরা আই.টি ট্রেনিং ইনস্টিটিউট এবং সফটয়্যার
                        ফার্ম</h5>
                    <h2 class="mt-4 mb-0 pb-0">{{ $course_details->course_title }}</h2>

                    <div class="d-flex flex-wrap gap-3 my-5">
                        <div class="card text-center p-4">
                            <p>কোর্সের মেয়াদ</p>
                            <h3 class="fw-bold"> ৬ মাস</h3>
                        </div>
                        <div class="card text-center p-4">
                            <p>&nbsp &nbsp &nbsp লেকচার &nbsp &nbsp &nbsp</p>
                            <h3 class="fw-bold">৩৬ টি </h3>
                        </div>
                        <div class="card text-center p-4">
                            <p>&nbsp &nbsp &nbsp &nbsp প্রজেক্ট &nbsp &nbsp &nbsp</p>
                            <h3 class="fw-bold"> ৫ + </h3>
                        </div>
                    </div>
                    <div class="course_details_desc">
                        @php
                            echo $course_details->desc;
                        @endphp
                    </div>
                    <div class="cariar-button">
                        <a href="{{ url('user/free-seminer') }}" class="btn-one">ফ্রি সেমিনার</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ $course_details->course_img }}" class="w-100 cariar-img" alt="Bangladesh">
                    <div class="course-carikulam">

                        <div class="course-pement">
                            <div class="card course_details_card text-white my-4">
                                <div class="card-body">
                                    <h3>কোর্স ফি (অফলাইন)</h3>
                                    <h3 class="my-3">৳ {{ $course_details->course_fee }} টাকা</h3>

                                    @if (Auth::guard('student')->user())
                                        <form action="{{ route('student.active.course.add') }}" method="POST"
                                            id="activecoursealert">
                                            @csrf
                                            <input type="text" class="d-none" name="course_id"
                                                value="{{ $course_details->id }}">
                                            <button type="submit" class="admission-btn">কোর্সটি কিনুন</button>
                                        </form>
                                    @else
                                        <a type="button" href="{{ route('student.login') }}" class="admission-btn">কোর্সটি
                                            কিনুন</a>
                                    @endif



                                </div>
                            </div>
                            <div class="card course_details_card text-white my-4">
                                <div class="card-body">
                                    <h3>কোর্স ফি (অনলাইন)</h3>
                                    <h3 class="my-3">৳ 8,০০০ টাকা</h3>


                                    @if (isset($currentStudent->email))
                                        <form action="{{ route('student.active.course.add') }}" method="POST"
                                            id="activecoursealert">
                                            @csrf
                                            <input type="text" class="d-none" name="course_id"
                                                value="{{ $course_details->id }}">
                                            <button type="submit" class="admission-btn">কোর্সটি কিনুন</button>
                                        </form>
                                    @else
                                        <a type="button" href="{{ route('student.login') }}" class="admission-btn">কোর্সটি
                                            কিনুন</a>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- course secction -->

@endsection
