@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 mx-auto">

                <form action="{{ route('admin.add.gallery.image') }}" id="addimagegalleryalert" method="POST">
                    @csrf
                    <div class="my-4">
                        <input id="gallery_img" type="file" name="gallery_img" class="form-control w-75">
                        <img src="{{ asset('img/blank_image.png') }}" class="w-75" id="gallery_img_show" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>

            </div>
        </div>
    </div>



@endsection()
