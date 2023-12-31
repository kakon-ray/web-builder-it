@extends('layouts.app')
@section('title')
    {{ 'My Course | Uma IT ' }}
@endsection

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ asset('img/profile.jpg') }}" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3">{{ Auth::guard('student')->user()->student_name }}</h5>
                            <p class="text-muted mb-1">Student Of Uma It</p>

                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" id="show_overview" class="common-btn py-2 m-2">Overview</button>
                                <button type="button" id="show_form" class="common-btn py-2 m-2">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">

                    {{-- error and success message show end --}}
                    <div class="card mb-4" id="overview_content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('student')->user()->student_name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('student')->user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('student')->user()->phone }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('student')->user()->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card py-4 px-5" id="profile_form">
                        <h4 class="text-center pb-5">Update Your Profile</h4>

                        <form action="{{ route('student.profile.update') }}" method="POST" id="studentprofileupdate">
                            @csrf
                            <input type="text" name="id" value="{{ Auth::guard('student')->user()->id }}"
                                class="d-none" />
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="form3Example2">Student Name</label>
                                        <input type="text" id="name" name="student_name"
                                            value="{{ Auth::guard('student')->user()->student_name }}"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="form3Example1">Phone Number</label>
                                        <input type="text" id="phone" name="phone"
                                            value="{{ Auth::guard('student')->user()->phone }}" placeholder="Phone Number"
                                            class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="email">Student Email</label>
                                        <input type="text" value="{{ Auth::guard('student')->user()->email }}"
                                            class="form-control" disabled />
                                        <input type="text" id="email" name="email"
                                            value="{{ Auth::guard('student')->user()->email }}" class="d-none" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="address">Student Address</label>
                                        <input type="text" id="address" name="address"
                                            value="{{ Auth::guard('student')->user()->address }}" placeholder="Address"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="text-center"><button class="common-btn" type="submit">Submit</button></div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
