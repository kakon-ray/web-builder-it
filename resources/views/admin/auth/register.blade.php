@extends('layouts.admin_app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Create an Account</div>

                    {{-- error and success message show start --}}
                    <div class="mt-2 text-center">
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
                        <form method="POST" action="{{ route('admin.registation.submit') }}">
                            @csrf
                            <div class="my-4">
                                <input id="name" type="text" class="form-control" name="name" required
                                    autocomplete="name" autofocus placeholder="Name">
                            </div>


                            <div class="my-4">
                                <input id="email" type="email" class="form-control" name="email" required
                                    autocomplete="email" placeholder="Email">
                            </div>


                            <div class="mt-4 mb-3">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password" placeholder="Password">
                                <input type="checkbox" id="showPass" class="mt-3"><span class="ml-2">Show
                                    Password</span>
                            </div>


                            <div class="mb-4">
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                                <input type="checkbox" id="showPassConfirm" class="mt-3"><span class="ml-2">Show
                                    Password</span>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registation
                            </button>

                            <div class="d-flex mt-4 small text-center justify-content-center">
                                <span>I have no account</span>
                                <a class="ml-2 text-primary text-center" href="{{ route('admin.login') }}">Login</a>
                            </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
