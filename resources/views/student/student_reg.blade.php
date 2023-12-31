@extends('layouts.app')
@section('title')
    {{ 'Student Registation | Uma IT ' }}
@endsection

@section('content')
    <!-- course secction -->
    <section class="all-course admission">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card py-4 px-5">
                        <h4 class="text-center text-secondary pb-4">Student Registration</h4>
                        <form method="POST" action="{{ route('student.reg.submit') }}" id="studentregistationalert">
                            @csrf
                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <label id="admission1" class="form-label" for="form4Example1">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name"
                                    required autocomplete="name" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" id="admission2" for="form4Example3">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="Email Number" required autocomplete="email" />
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-outline password-container mb-4">
                                        <label class="form-label" id="admission3" for="form4Example3">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                            id="student_password" required>
                                        <i class="fa-solid fa-eye" id="eye"></i>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-outline password-container mb-4">
                                        <label class="form-label" id="admission4" for="form4Example3">Passwrod Confirmation</label>
                                        <input type="password" id="student_password_confirm" name="password_confirmation"
                                            class="form-control" placeholder="Password Contirmation" required />
                                        <i class="fa-solid fa-eye" id="confirm_password_eye"></i>
                                    </div>
                                </div>
                            </div>
                 
                            <div class="text-center my-2">
                                <button type="submit" class="common-btn">রেজিষ্ট্রেশন করুন</button>
                            </div>

                            <div class="text-center mt-4 small">
                                <a class="ms-4 text-primary" href="{{ route('student.login') }}">অ্যাকাউন্ট আছে? লগইন
                                    করুন</a>
                            </div>

                            <hr>
                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>


                        

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
