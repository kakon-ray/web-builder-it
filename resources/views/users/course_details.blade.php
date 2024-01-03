@extends('layouts.app')
@section('title')
    {{ 'Web Design Details | Web Builder IT' }}
@endsection

@section('content')
    <!-- banner -->
    <section class="cariar-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="pb-3"><i class="fas fa-book-open me-2"></i>দেশ সেরা আই.টি ট্রেনিং ইনস্টিটিউট এবং সফটয়্যার
                        ফার্ম</h5>
                    <h2 class="mt-4 mb-0 pb-0">{{ $course_details->course_title }}</h2>

                    <div class="d-flex flex-wrap gap-3 my-5">
                        <div class="card text-center p-4">
                            <h3 class="fw-bold">Online Course</h3>
                        </div>
                        <div class="card text-center p-4">
                            <h3 class="fw-bold">24 Hour Support</h3>
                        </div>
                        <div class="card text-center p-4">
                            <h3 class="fw-bold"> {{$course_details->projects}} + Professional Project</h3>
                        </div>
                    </div>
                    <div class="course_details_desc">
                        @php
                            echo $course_details->desc;
                        @endphp
                    </div>
                    <div class="cariar-button">
                        <a href="{{ url('user/free-seminer') }}" class="btn-three">Join Web Development Free Seminer</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    {{-- <img src="{{ $course_details->course_img }}" class="w-100 cariar-img" alt="Bangladesh"> --}}
                    <div class="course-carikulam">

                        <div class="course-pement">
                            <div class="course_details_card">
                                <div class="course-details-sidebar">
                                    <div class="course-price-outer">
                                        @if($course_details->new_course_fee)
                                        <del style="color: red"><span class="price">{{ $course_details->course_fee }} BDT</span></del>
                                        <span class="price">{{ $course_details->new_course_fee }} BDT</span>

                                        @else
                                        <span class="price">{{ $course_details->course_fee }} BDT</span>
                                        @endif
                                       
                                    </div>
                                    <ul>
                                        <li>
                                            <i class="fas fa-user"></i>
                                            <strong>Instructor</strong> <span>{{$course_details->instructor}}</span>
                                        </li>
                                        <li>
                                            <i class="far fa-clock"></i>
                                            <strong>Duration</strong> <span>{{$course_details->duration}} Month</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-video"></i>
                                            <strong>Lectures</strong> <span>{{$course_details->lectures}} + Lectures</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-book"></i>
                                            <strong>Language</strong> <span>{{$course_details->language}}</span>
                                        </li>

                                    </ul>
                                </div>


                                @if (Auth::guard('student')->user())
                                    <form action="{{ route('student.active.course.add') }}" method="POST"
                                        id="activecoursealert">
                                        @csrf
                                        <input type="text" class="d-none" name="course_id"
                                            value="{{ $course_details->id }}">
                                        <button type="submit" class="btn-two">Admission</button>
                                    </form>
                                @else
                                    <a type="button" href="{{ route('student.login') }}" class="btn-two">Admission</a>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- course secction -->
@endsection
