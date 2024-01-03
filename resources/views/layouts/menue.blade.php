   <!-- main header area  -->
   <header class="andfood-header">
    <!-- Top Bar -->
    <div class="topbar-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-nav-container">
                        <ul class="topbar-list">
                            <li>
                                <a href="+01123456789"><i class="fas fa-phone"></i><span>+8801707500512</span></a>
                            </li>
                            <li>
                                <a href="+01123456789"><i
                                        class="fas fa-envelope"></i><span>webbuilderit.info@gmail.com</span></a>
                            </li>

                        </ul>

                        <ul class="topbar-list text-center">
                            <li>
                                <a href="#!"><span>Best IT Institute and Software Firm in Bangladesh
                                    </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- navbar  -->
    <div class="forntend-navbar">
        <nav class="navbar navbar-expand-lg py-0">
            <div class="container">
           
                 <a class="header-brand-logo-outer navbar-brand" href="{{ url('/') }}">
                     <img class="logo" src="{{asset('img/logo.png')}}" alt="Logo">
                 </a>
          
                
                <div class="nav-responsive">
                    <a href="#!" data-bs-toggle="modal" data-bs-target="#search-modal" class="search-box"><i
                            class="fas fa-search"></i></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link navbar-item {{ request()->is('/') ? 'navbar-item-active' : '' }}"
                                aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>

                        @php

                            $allCourse = DB::table('add_courses')->get();
                            $allServices = DB::table('add_services')->get();

                        @endphp

                        <li class="nav-item position-relative" id="flip">
                            <div id="dropdown-container">
                                <a class="nav-link navbar-item d-flex align-items-center" href="#">
                                    All Courses <i class="fas fa-chevron-down ms-2"></i>
                                </a>
                                <div class="dropdown-menu" id="panel">
                                    <ul class="dropdown-container">
                                        @foreach ($allCourse as $item)
                                            @if ($item->status == true)
                                                <li>
                                                    <a class="dropdown-item navbar-item"
                                                        href="{{ route('user.course.details', ['id' => $item->id]) }}">
                                                        {{ $item->course_title }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item position-relative" id="flip2">
                            <div id="dropdown-container2">
                                <a class="nav-link navbar-item d-flex align-items-center" href="#">
                                   All Services<i class="fas fa-chevron-down ms-2"></i>
                                </a>
                                <div class="dropdown-menu" id="panel2">
                                    <ul class="dropdown-container">
                                        @foreach ($allServices as $item)
                                            <li>
                                                <a class="dropdown-item navbar-item"
                                                    href="{{ route('user.services.details', ['id' => $item->id]) }}">{{ $item->services_title }}</a>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-item {{ request()->routeIs('user.gallery') ? 'navbar-item-active' : '' }}"
                                href="{{ route('user.gallery') }}">gallery</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-item {{ request()->routeIs('user.all.blog') ? 'navbar-item-active' : '' }}"
                                href="{{ route('user.all.blog') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navbar-item {{ request()->routeIs('user.services.contact') ? 'navbar-item-active' : '' }}"
                                href="{{ route('user.services.contact') }}">Contact</a>
                        </li>
                    </ul>
                    <div class="others-options">
                        <a href="#!" data-bs-toggle="modal" data-bs-target="#search-modal" class="search-box"><i
                                class="fas fa-search"></i></a>
                        <div class="d-flex align-item-center">
                            @if (Auth::guard('student')->user())
                                <div class="menu">
                                    <div id="item">
                                        <img src="{{ asset('img/portfolio/demo_client_image.jpeg') }}" class="profile" alt="logo" />
                                        <span>{{ Auth::guard('student')->user()->student_name }}</span>
                                    </div>
                                    <div id="submenu">
                                        <a href="{{ route('student.profile') }}">Profile</a>
                                        <a href="{{ route('student.my.order') }}">My Order</a>
                                        <a href="{{ route('student.mycourse') }}">My Course</a>
                                        <a type="button" id="student_logout">Logout</a>
                                    </div>
                                </div>
                            @else(!isset($currentStudent))
                                <a href="{{ route('student.login') }}" class="btn-three">Student Login</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- search -->
    <div class="search-overlay">
        <div class="modal fade" id="search-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-overlay-form">
                        <button type="button" class="btn-close search-overlay-close"
                            data-bs-dismiss="modal"></button>
                        <form action="{{ route('user.nav.search') }}" method="GET">
                            <select class="nav-input-select"name="category">

                                <option value="course" value="course">Course</option>
                                <option value="service" value="service">Service</option>

                            </select>
                            <input type="text" required class="input-search" name="item"
                                placeholder="Search here" />
                            <button><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
