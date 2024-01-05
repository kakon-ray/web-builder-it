@extends('layouts.app')
@section('title')
    {{$blogDetails->category }} | {{ $blogDetails->title }}
@endsection

@section('content')
    <!-- banner -->
    <section class="cariar-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div class="py-4">
                        <h2>{{ $blogDetails->title }}</h2>
                    </div>

                    <div class="blog-content">
                        @php
                            echo $blogDetails->description;
                        @endphp
                    </div>
                </div>

                <div class="col-lg-4">
                    
                    <div class="blog-details-right-sidebar">
                        <h3>Our Recent Blog</h3>
                        @foreach($allBlog as $item)
                        <a href="{{route('user.blog.details',$item->id)}}">
                            <div class="blog-content">
                                <img src="{{$item->image}}" class="img-fluid" alt="Blog Image">
                                <h5>{{$item->title}}</h5>
                            </div>
                        </a>
                      

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- course secction -->
@endsection
