@extends('layouts.app')
@section('title')
    {{ 'All Services | Web Builder IT' }}
@endsection

@section('content')

    <section class="all-course">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">জনপ্রিয় সার্ভিস</h2>
                        <h6 class="pt-2">অভিজ্ঞ মেন্টর আর আপডেটেড কারিকুলাম নিয়ে ওয়েব বিল্ডার আইটি প্রস্তুত আপনার ক্যারিয়ার গড়ার
                            অগ্রযাত্রায়।</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($allServices))
                    @foreach ($allServices as $item)
                        <div class="col-lg-3">
                            <div class="card mt-3">
                                <a href="{{ route('user.services.details', ['id' => $item->id]) }}">
                                    <img src="{{ $item->services_img }}" class="card-img-top" alt="Course">
                                </a>
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
                                        class="common-btn ms-0">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


                @if (isset($notFound))
                    <h2 class="text-center">{{ $notFound }}</h2>
                @endif





            </div>

        </div>
    </section>

@endsection
