@extends('layouts.app')
@section('title')
    {{ 'All Course | Web Builder IT' }}
@endsection

@section('content')

   {{-- blog section --}}

   <section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-center heading">Our <span class="sm-red-title">Blog</span></h2>
            </div>
            @foreach ($blog as $item)
                <div class="col-lg-4">
                    <div class="blog-card">
                        <a class="blog-button">
                            <img src="{{$item->image}}" alt="Blog Image">
                        </a>

                        <div class="blog-content">
                            <h4 class="blog-title">{{$item->title}}</h4>
                            <p>
                                @php
                                  echo substr($item->description,0,100);
                                @endphp
                            </p>

                            <p><a class="blog-button">Read More <i class="fas fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
