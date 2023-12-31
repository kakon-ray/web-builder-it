@extends('layouts.admin_app')
@section('title')
    {{ 'Services Contact | Khulna IT ' }}
@endsection

@section('content')

<style>

.page-not-found h2 {
    font-size: 130px;
    color: #e91e63;
}
.page-not-found h3 {
    font-size: 42px;
}
.page-not-found .bg-light {
    width: 50%;
    padding: 50px;
    text-align: center;
    border-radius: 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@media (max-width:  767px) {
    .page-not-found h2 {
        font-size: 100px;
    }
    .page-not-found h3 {
        font-size: 28px;
    }
    .page-not-found .bg-light {
        width: 100%;
    }
}
</style>
 <!-- Not Found Page HTML -->
<div class="page-not-found py-5 my-5">
    <div class="text-center py-4">
        <h2>404</h2>
        <h3 class="mt-4">Opps! Page Not Found</h3>
       
        <div class="mt-5">
            <a type="button" href="{{route('admin.dashboard')}}" class="btn m-2 m-md-0 btn-warning"> Back Home</a>
        </div>
    </div>
</div>
@endsection
