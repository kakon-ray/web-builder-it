@extends('layouts.app')
@section('title')
    {{ 'All Blog | Web Builder IT' }}
@endsection

@section('content')

   {{-- blog section --}}
   <section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center pb-4">
                <h2 class="fw-bold heading">Our Letest <span class="sm-red-title">Blog</span></h2>
            </div>
            <div class="col-lg-4">
                <div class="blog-card">
                    <a href="">
                        <img src="http://127.0.0.1:8000/uploads/facebook-marketing-1796746857957288.jpg" alt="Blog Image">
                    </a>

                    <div class="blog-content">
                        <h4 class="blog-title">Lorem ipsum dolor sit amet.</h4>
                        <p>
                           Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                        </p>

                        <p><a href="#" class="blog-button">Read More <i
                                    class="fas fa-angle-double-right"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 mx-auto my-4">
                <a href="{{ route('user.all.blog') }}" class="common-btn">All Blog</a>
            </div>
        </div>
    </div>
</section>

@endsection
