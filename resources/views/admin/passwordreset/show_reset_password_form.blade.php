@extends('layouts.admin_app')
@section('title')
    {{ 'Show Password Reset Form| Uma IT ' }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card m-3 p-3">
                    <div class="panel-body">


                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h4 class="text-center py-3">Reset Your Password</h4>

                            <div class="mt-2 small">
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

                            <div class="panel-body">

                                <form action="{{ route('admin.new.password.submit') }}" method="post">
                                    @csrf

                                    <input type="text" name="token" value="{{ $token }}" hidden>
                                    <div class="my-3">
                                        <input id="email" name="email" placeholder="email address"
                                            class="form-control" type="email">
                                    </div>

                                    <div class="my-3">
                                        <input name="password" placeholder="Enter New Password" class="form-control"
                                            type="password">
                                    </div>

                                    <div class="my-3">
                                        <input name="confirm_password" placeholder="Enter Confirm Password"
                                            class="form-control" type="password">
                                    </div>

                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-success btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
