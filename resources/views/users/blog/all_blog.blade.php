@extends('layouts.app')
@section('title')
    {{ 'All Blog | Web Builder IT' }}
@endsection

@section('content')

   {{-- blog section --}}

   <section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-4 text-center">
                <h2 class="text-center heading">Our <span class="sm-red-title">Blog</span></h2>
            </div>
            @foreach ($allBlog as $item)
                <div class="col-lg-4">
                    <div class="blog-card">
                        <a href="{{ route('user.blog.details', $item->id) }}">
                            <img src="{{$item->image}}" class="img-fluid w-100" alt="Blog Image">
                        </a>

                        <div class="blog-content">
                            <h4 class="blog-title">{{$item->title}}</h4>
                            <p>
                                @php
                                  echo substr($item->description,0,100);
                                @endphp
                            </p>

                            <p><a href="{{ route('user.blog.details', $item->id) }}" class="blog-button">Read More <i
                                class="fas fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
