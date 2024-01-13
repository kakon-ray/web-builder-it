    <!-- footer section  -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 col-md-12 col-sm-12">
                    <div class="footer-first-area">
                        <div class="img-logo">
                            <a href="index.html"><img src="{{ asset('img/footerlogo.png') }}" class="logo"
                                    alt="logo" /></a>
                        </div>
                        <p>
                            Best IT Institute and Software Firm in Bangladesh
                        </p>
                        <p><span>Address: </span>Nirala, Khulna</p>
                        <p><span>Phone: </span> +8801707500512</p>
                        <p><span>Email: </span> webbuilderit.info@gmail.com</p>


                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-content">
                        <div class="footer-heading-area">
                            <h4 class="heading2"> All Courses</h4>
                        </div>
                        <div class="footer-link-area">
                            @php

                                $allCourse = DB::table('add_courses')->where('status',true)
                                    ->get()
                                    ->reverse();
                                $allServices = DB::table('add_services')
                                    ->get()
                                    ->reverse();

                            @endphp
                            <ul>
                                @foreach ($allCourse->slice(0, 6) as $item)
                                    @if ($item->status == true)
                                        <li><a href="{{ route('user.course.details', ['id' => $item->id]) }}">{{ $item->course_title }}
                                            </a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-12">
                    <div class="footer-content">
                        <div class="footer-heading-area">
                            <h4 class="heading2"> All Services</h4>
                        </div>
                        <div class="footer-link-area">
                            <ul>
                                @foreach ($allServices->slice(0, 6) as $item)
                                    <li><a href="{{ route('user.services.details', ['id' => $item->id]) }}">{{ $item->services_title }}
                                        </a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-12">
                    <div class="footer-content">
                        <div class="footer-heading-area">
                            <h4 class="heading2">Latest tweets</h4>
                        </div>
                        <div class="footer-link-area">

                            <p>
                                অভিজ্ঞ মেন্টর আর আপডেটেড কারিকুলাম নিয়ে ওয়েব বিল্ডার আই.টি প্রস্তুত আপনার ক্যারিয়ার গড়ার
                                অগ্রযাত্রায়।
                            </p>
                            <p><a href="https://www.facebook.com/profile.php?id=61554649395332">Facebook</a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="co-lg-6 col-md-6 col-12">
                    <div class="copyright-left">
                        <p>DEVELOPED BY - KAKON RAY</p>
                    </div>
                </div>
                <div class="co-lg-6 col-md-6 col-12">
                    <div class="copyright-right">
                        <p class="text-light">Copyright © 2023-2024 Web Builder IT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
