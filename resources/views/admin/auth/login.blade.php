@extends('layouts.admin_app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Admin Login In Dashboard</div>
                    {{-- error and success message show start --}}
                    <div class="mt-2 text-center w-75 mx-auto">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger small">{{ $error }}</p>
                            @endforeach
                        @endif
                        @if (session()->has('error'))
                            <p class="alert alert-danger small">{{ session('error') }}</p>
                        @endif
                        @if (session()->has('success'))
                            <p class="alert alert-success small">{{ session('success') }}</p>
                        @endif
                    </div>

                    {{-- error and success message show end --}}
                    <div class="card-body px-5">
                        <form method="POST" id="submitloginform" action="{{ route('admin.login.submit') }}">
                            @csrf
                            <div class="my-3">
                                <label for="" id="loginemail">Enter Your Email</label>
                                <input id="email" type="email" class="form-control" name="email" required
                                    autocomplete="email" placeholder="Email">
                            </div>


                            <div class="my-3">
                                <label for="" id="loginpassword">Enter Password</label>
                                <input id="admin_password_login" type="password" class="form-control" name="password"
                                    required autocomplete="new-password" placeholder="Password">
                                <input type="checkbox" id="loginPassword" class="mt-3"><span class="ml-2">Show
                                    Password</span>
                            </div>



                            <button id="login" class="btn btn-facebook btn-user btn-block">
                                Login
                            </button>

                            <div class="mt-3 text-center">
                                <p class="small">পাসওয়ার্ড ভুলে গেছেন? <a class="text-primary"
                                        href="{{ route('admin.pasword.reset') }}">পাসওয়ার্ড রিসেট করুন</a></p>
                                <p class="small">অ্যাকাউন্ট নেই?<a class="ml-2"
                                        href="{{ route('admin.registation') }}">রেজিষ্ট্রেশন করুন</a></p>

                            </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
