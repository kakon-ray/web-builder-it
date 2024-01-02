@extends('layouts.app')
@section('title')
    {{ 'Web Design Details | Web Builder IT' }}
@endsection

@section('content')
    <!-- banner -->
    <section class="cariar-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    <div class="card p-5 my-3">
                        <h5 class="pb-3"><i class="fas fa-computer me-2"></i>Best Software Firm in Our Country ( Contact : +8801707500512 ) </h5>

                        <h2 class="my-3">{{ $services_details->services_title }}</h2>

                        <div class="py-3">
                            @php
                                echo $services_details->desc;
                            @endphp
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
