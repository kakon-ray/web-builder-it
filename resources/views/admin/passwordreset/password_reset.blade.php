@extends('layouts.admin_app')
@section('title')
    {{ 'Admin Password Reset | Web Builder IT ' }}
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card m-3 p-4">
                    <div class="panel-body">

                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h4 class="text-center pt-3">Forgot Password?</h4>
                            <p>You can reset your password here.</p>
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

                            <form method="POST" action="{{ route('admin.reset.password.submit') }}">
                                @csrf
                                <div class="my-3">
                                    <span class="input-group-addon"><i
                                            class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="email" name="email" placeholder="Email Eddress" class="form-control">
                                </div>

                                <div class="my-3">
                                    <input name="recover-submit" class="btn btn-success ms-0 py-2 btn-block"
                                        value="Reset Password" type="submit">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
