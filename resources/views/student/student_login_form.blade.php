@extends('layouts.app')
@section('title')
    {{ 'Login | Web Builder IT ' }}
@endsection

@section('content')
    <!-- course secction -->
    <section class="all-course admission">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card py-4 px-5">
                        <h4 class="text-center text-secondary pb-4">Student Login</h4>
                        <form method="POST" id="studentloginsubmit" action="{{ route('student.login.submit') }}">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" id="login_email" for="login_form">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Email Number" />
                            </div>

                            <div class="form-outline password-container mb-4">
                                <label class="form-label" id="login_password" for="loin_form">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    id="student_login_password">
                                <i class="fa-solid fa-eye" id="confirm_login_eye"></i>
                            </div>

                            <div class="text-center my-2">
                                <button type="submit" id="student_login_confirm" class="common-btn">Login</button>
                            </div>
                            <div class="text-center mt-2">
                                <p class="small">Forget Password? <a class="text-primary"
                                        href="{{ route('student.password.reset') }}">Reset Your Password</a></p>
                                <p class="small">Do not have an any account? <a class="text-primary"
                                        href="{{ route('student.registation') }}">Registration</a></p>
                            </div>

                            <hr>
                            <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
