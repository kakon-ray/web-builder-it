@extends('layouts.app')
@section('title')
    {{ 'Gallery | Uma IT ' }}
@endsection

@section('content')
    <section id="gallery">
        <div class="container">
            <div class="gallery">
                <div class="row g-2">
                    <div class="col-lg-12">
                        <h2 class="text-center pb-3">Gallery</h2>
                    </div>
                    @foreach ($gallery_image as $item)
                        <div class="col-lg-4">
                            <a href="{{ $item->gallery_img }}" class="big"><img src="{{ $item->gallery_img }}"
                                    alt=""></a>
                        </div>
                    @endforeach

                </div>
            </div>
    </section>
@endsection
