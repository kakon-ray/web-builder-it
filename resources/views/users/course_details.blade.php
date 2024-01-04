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
                            <h3 class="fw-bold"> {{ $course_details->projects }} + Professional Project</h3>
                        </div>
                    </div>
                    <div class="course_details_desc">
                        @php
                            echo $course_details->desc;
                        @endphp
                    </div>

                </div>
                <div class="col-lg-4">
                    {{-- <img src="{{ $course_details->course_img }}" class="w-100 cariar-img" alt="Bangladesh"> --}}
                    <div class="course-carikulam">

                        <div class="course-pement">
                            <div class="course_details_card">
                                <div class="course-details-sidebar">
                                    <div class="course-price-outer">
                                        @if ($course_details->new_course_fee)
                                            <del style="color: red"><span class="price">{{ $course_details->course_fee }}
                                                    BDT</span></del>
                                            <span class="price">{{ $course_details->new_course_fee }} BDT</span>
                                        @else
                                            <span class="price">{{ $course_details->course_fee }} BDT</span>
                                        @endif

                                    </div>
                                    <ul>
                                        <li>
                                            <i class="fas fa-user"></i>
                                            <strong>Instructor</strong> <span>{{ $course_details->instructor }}</span>
                                        </li>
                                        <li>
                                            <i class="far fa-clock"></i>
                                            <strong>Duration</strong> <span>{{ $course_details->duration }} Month</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-video"></i>
                                            <strong>Lectures</strong> <span>{{ $course_details->lectures }} +
                                                Lectures</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-book"></i>
                                            <strong>Language</strong> <span>{{ $course_details->language }}</span>
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
                <div class="col-lg-8">

                    <div class="our-student-feedback blog-details-right-sidebar">
                        @if (!Auth::guard('student')->user())
                            <a href="{{ route('student.login') }}">
                                <div class="alert alert-success" role="alert">
                                    If you want to give any feedback about this course you need to <a
                                        href="{{ route('student.login') }}"> Login </a>
                                </div>
                            </a>
                        @endif
                        <h3 class="heading">Our Students Feedback</h3>
                        @foreach ($allReview as $item)

                                <div class="blog-content revew-content">
                                    @if ($item->image)
                                        <img src="{{ $item->image }}" class="img-fluid" alt="Blog Image">
                                    @else
                                        <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}" class="img-fluid"
                                            alt="Blog Image">
                                    @endif
                                    <div>
                                        <h5>{{ $item->name }}</h5>
                                        <p>{{ $item->description }}</p>
                                    </div>

                                    @if (Auth::guard('student')->user()->id == $item->student_id)
                                        <p class="review-delete" type="button"
                                            onclick="delete_sutdnet_review({!! $item->id !!})">
                                            <i class="fas fa-trash"></i>
                                        </p>
                                    @endif

                                </div>

                          
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 pt-2">
                    @if (Auth::guard('student')->user())
                        <div class="course_details_card">
                            <h2 class="pb-3">Course Review</h2>
                            <form action="{{ route('student.review.submit') }}" method="POST" id="review_alert">
                                @csrf
                                <div id="rateBox"></div>

                                <input type="text" class="d-none" name="student_id"
                                    value="{{ Auth::guard('student')->user()->id }}">
                                <input type="text" class="d-none" name="name"
                                    value="{{ Auth::guard('student')->user()->student_name }}">
                                <input type="text" class="d-none" name="image"
                                    value="{{ Auth::guard('student')->user()->image }}">
                                <input type="text" class="d-none" name="course_id" value="{{ $course_details->id }}">
                                <input type="text" name="ratevalue" value="4" class="d-none" id="ratevalue">

                                <div class="form-outline my-3">
                                    <label class="form-label" for="form4Example3">Message</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Message"></textarea>
                                </div>

                                <button type="submit" class="second-btn">Send</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        </div>
    </section>

    <!-- course secction -->

    <script>
        const delete_sutdnet_review = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this Item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/student/review/delete", {
                            params: {
                                id: id
                            }
                        })
                        .then(function(response) {

                            if (response.data.status == 200) {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'success',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1500

                                })
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);


                            } else {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'error',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }


                        })
                        .catch(function(error) {
                            Swal.fire({
                                customClass: 'swalstyle',
                                position: "top-center",
                                icon: "error",
                                title: "Your form submission is not complete",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            })



        }
    </script>
@endsection
