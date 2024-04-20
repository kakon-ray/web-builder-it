@extends('layouts.app')
@section('title')
    {{ 'Course Admission | Web Builder IT ' }}
@endsection

@section('content')
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center py-3">
                    <h2 class="pement-title pb-3">Pyment</h2>
                    <h3>Total Amount </h3>
                    <h4>Pement Method</h4>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{ $course_details->course_img }}" class="w-100" />
                                        <a href="#!">
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h3>{{ $course_details->course_title }}</h3>
                                    <div class="d-flex flex-row">
                                        <div class="text-danger mb-1 py-2">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>

                                    </div>

                                    @php
                                        echo $course_details->desc;
                                    @endphp

                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    @if ($course_details->new_course_fee)
                                        <h6 class="mb-1 me-1">{{ $course_details->new_course_fee }} (BDT)</h6>
                                        <span class="text-danger"><s>{{ $course_details->course_fee }}</s></span>
                                    @else
                                    <h6 class="mb-1 me-1">{{ $course_details->course_fee }} (BDT)</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 checkout">
                    <div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="card digitalcard"><input type="radio" id="chcekoutradio" name="checkout"
                                        value="digital"> Digial</label>
                            </div>
                            <div class="col lg-6">
                                <label class="card manualcard"><input type="radio" checked="checked" id="chcekoutradio"
                                        name="checkout" value="manual"> Manual</label>

                            </div>
                        </div>

                    </div>
                    <div class="pt-5">
                        {{-- digital pement getway start --}}
                        <div class="digital">

                            <div class="col-md-12 order-md-1">
                                <h4 class="mb-3">Billing address</h4>
                                <form action="{{ route('student.pay') }}" method="POST" class="needs-validation">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                    <input type="text" name="active_course_id" value="{{ $active_course_id }}"
                                        class="d-none" />

                                    <input type="text" class="d-none" name="amount"
                                        value="{{ $course_details->course_fee }}">

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="firstName">Full name</label>
                                            <input type="text" name="name" class="form-control" id="customer_name"
                                                placeholder="Name" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="mobile">Mobile</label>
                                        <div class="input-group">
                                            <input type="text" name="phone" class="form-control" id="mobile"
                                                placeholder="Mobile" required>

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ Auth::guard('student')->user()->email }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="1234 Main St" required>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="state">Country</label>
                                            <select class="custom-select d-block w-100 form-control" id="state"
                                                name="country" required>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="BDT">India</option>
                                            </select>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="state">Currency</label>
                                            <select class="custom-select d-block w-100 form-control" name="currency"
                                                required>
                                                <option value="">Choose</option>
                                                <option value="BDT">BDT</option>
                                            </select>
                                        </div>

                                    </div>
                                    <hr class="mb-4">
                                    <button class="common-btn btn-lg btn-block" type="submit">Continue to
                                        checkout</button>
                                </form>
                            </div>

                        </div>

                        {{-- digital pement getway end --}}


                        {{-- manual pement getway start  --}}
                        <div class="manual">

                            <div class="text-center pb-3">
                                <p>ম্যানুয়াল পেমেন্ট করলে আমাদের বিকাশ মার্চেন্ট নাম্বারে টাকা পাঠাতে হবে।</p>
                                <p> 01707500512</p>
                            </div>
                            <div class="border p-4">
                                <form action="{{ route('student.add.pement.submit') }}" method="POST"
                                    id="manualpementalert">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <label class="form-label">যে নাম্বার থেকে টাকা পাঠিয়েছেন</label>
                                        <input type="phone" name="phone" class="form-control"
                                            placeholder="যে নাম্বার থেকে টাকা পাঠিয়েছেন" />
                                        <input type="text" name="active_course_id" value="{{ $active_course_id }}"
                                            class="d-none" />

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label">টাকার পরিমান</label>
                                        <input type="number" name="amount" class="form-control"
                                            placeholder="আপনি কত টাকা পাঠিয়েছেন তার পরিমান " />
                                    </div>

                                    <div class="form-outline password-container mb-4">
                                        <label class="form-label" id="from_number_lebel" for="loin_form">যে নাম্বারে টাকা
                                            পাঠিয়েছেন</label>
                                        <input type="phone" name="send_phone_num" class="form-control"
                                            placeholder="যে নাম্বারে টাকা পাঠিয়েছেন" id="from_number">
                                    </div>
                                    <div class="form-outline password-container mb-4">
                                        <label class="form-label" id="tansactionid_lebel" for="loin_form">ট্রান্সজেকসন
                                            আইডি</label>
                                        <input type="text" class="form-control" name="transaction_id"
                                            placeholder="ট্রান্সজেকসন আইডি" id="tansactionid">
                                    </div>
                                    <div class="form-outline password-container mb-4">
                                        <label class="form-label" id="tansactionid_lebel" for="loin_form">পেমেন্ট
                                            ম্যথড</label>
                                        <select class="form-select" name="pement_method"
                                            aria-label="Default select example">
                                            <option selected value="বিকাশ">বিকাশ</option>
                                            <option value="নগদ">নগদ</option>
                                        </select>
                                    </div>

                                    <div class="text-center my-2">
                                        <button type="submit" class="common-btn">Submit</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                        {{-- manual pement getway end --}}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
