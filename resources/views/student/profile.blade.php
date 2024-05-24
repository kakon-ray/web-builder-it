@extends('layouts.app')
@section('title')
    {{ 'Profile | Web Builder IT ' }}
@endsection

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            @if (Auth::guard('student')->user()->image)
                                <img src="{{ Auth::guard('student')->user()->image }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                            @else
                                <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                            @endif

                            <h5 class="my-3">{{ Auth::guard('student')->user()->student_name }}</h5>
                            <p class="text-muted mb-1">Student Of Web Builder IT</p>

                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" id="show_overview" class="common-btn py-2 m-2">Overview</button>
                                <button type="button" id="show_form" class="common-btn py-2 m-2">Edit Profile</button>
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

                    <div id="profile_form">
                        <div class="card p-5">
                            <div class="pb-4">
                                <h5 class="heading2 pb-2">Update Profile</h5>
                            </div>

                            <form action="{{ route('student.profile.update') }}" enctype="multipart/form-data" method="POST" id="studentprofileupdate">
                                @csrf
                                <input type="text" name="id" value="{{ Auth::guard('student')->user()->id }}"
                                    class="d-none" />
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Student Name</label>
                                            <input type="text" id="name" name="student_name"
                                                value="{{ Auth::guard('student')->user()->student_name }}"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">Phone Number</label>
                                            <input type="text" id="phone" name="phone"
                                                value="{{ Auth::guard('student')->user()->phone }}"
                                                placeholder="Phone Number" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">Student Email</label>
                                            <input type="text" value="{{ Auth::guard('student')->user()->email }}"
                                                class="form-control" disabled />
                                            <input type="text" id="email" name="email"
                                                value="{{ Auth::guard('student')->user()->email }}" class="d-none" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="address">Student Address</label>
                                            <input type="text" id="address" name="address"
                                                value="{{ Auth::guard('student')->user()->address }}" placeholder="Address"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-outline">
                                            <label class="form-label" for="address">Student Image</label>
                                            <input type="text" class="d-none" name="old_image"
                                                value="{{ Auth::guard('student')->user()->image }}" />
                                            <input type="file" name="image" />
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center pt-3"><button class="second-btn rounded"
                                        type="submit">Update</button>
                                </div>

                            </form>

                        </div>
                        <div class="card p-5 mt-3">
                            <div class="pb-4">
                                <h5 class="heading2 pb-2">Password Change</h5>
                            </div>

                            <form action="{{ route('student.password.update') }}" method="POST" id="studentprofileupdate">
                                @csrf
                                <input type="text" name="id" value="{{ Auth::guard('student')->user()->id }}"
                                    class="d-none" />
                                <div class="row gy-3">
                                    <div class="col-lg-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Old Password</label>
                                            <input type="password" name="old_password" class="form-control show_passwod_change"
                                                placeholder="Old Password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">New Password</label>
                                            <input type="password" name="password" class="form-control show_passwod_change"
                                                placeholder="New Password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control show_passwod_change"
                                                placeholder="Confrim New Password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-outline">
                                            <input type="checkbox" id="showPassChange" class="mt-3"><span class="ps-1">Show
                                                Password</span>
                                        </div>
                                    </div>


                                </div>

                                <div class="text-center pt-3"><button class="second-btn rounded"
                                        type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
