@extends('layouts.app')
@section('title')
    {{ 'All Course | Web Builder IT' }}
@endsection

@section('content')

    <!-- course secction -->
    <section class="course-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold heading">OUR <span class="sm-red-title">COURSES</span></h2>
                        <h6 class="pt-2">অভিজ্ঞ মেন্টর আর আপডেটেড কারিকুলাম নিয়ে ওয়েব বিল্ডার আইটি প্রস্তুত আপনার
                            ক্যারিয়ার গড়ার
                            অগ্রযাত্রায়।</h6>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($allCourse->slice(0, 8) as $item)
                    @if ($item->status == 1)
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <a href="{{ route('user.course.details', ['id' => $item->id]) }}">
                                    <img src="{{ $item->course_img }}" class="card-img-top" alt="Course">
                                </a>

                                <div class="card-body">
                                    <h3 class="card-title">{{ $item->course_title }}</h3>
                                    <div class="review">
                                        <h5>Course Fee</h5>
                                        <h5>{{ $item->course_fee }} BDT</h5>
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
