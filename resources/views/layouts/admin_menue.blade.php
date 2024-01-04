@if (Auth::guard('web')->user())

    <?php
    $course_message = DB::table('course_models')
        ->get()
        ->reverse();
    $services_message = DB::table('services_models')
        ->get()
        ->reverse();
    ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fa fa-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Uma<sup>IT</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Pages Collapse Menu -->
            <li
                class="nav-item {{ request()->routeIs('admin.pement.request') || request()->routeIs('admin.addmission') || request()->routeIs('admin.all.student') || request()->routeIs('admin.course.activity') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Admission</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.all.student') }}">All Student Information</a>
                    </div>
                </div>

                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.pement.request') }}">Pement Request</a>
                    </div>
                </div>



                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.addmission') }}">Active Course</a>
                    </div>
                </div>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.course.activity') }}">Course Activity</a>
                    </div>
                </div>



            </li>

            <li
                class="nav-item {{ request()->routeIs('admin.course.message') || request()->routeIs('admin.add.course') || request()->routeIs('admin.manage.course') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages2">
                    <i class="fa fa-school"></i>
                    <span>Course</span>
                </a>

                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.course.message') }}">Course Message</a>
                    </div>
                </div>

                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.add.course') }}">Add Course</a>
                    </div>
                </div>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.manage.course') }}">Manage Course</a>
                    </div>
                </div>

            </li>

            <li
                class="nav-item {{ request()->routeIs('admin.add.services') || request()->routeIs('admin.services.message') || request()->routeIs('admin.manage.services') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
                    aria-expanded="true" aria-controls="collapsePages3">
                    <i class="fa fa-check"></i>
                    <span>Services</span>
                </a>

                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.add.services') }}">Add Services</a>
                    </div>
                </div>
                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.services.message') }}">Services Message</a>
                    </div>
                </div>
                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.manage.services') }}">Manage Services</a>
                    </div>
                </div>


            </li>


            <li
                class="nav-item {{ request()->routeIs('admin.add.seminer') || request()->routeIs('admin.manage.seminer') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages5"
                    aria-expanded="true" aria-controls="collapsePages5">
                    <i class="fas fa-users"></i>
                    <span>Seminar</span>
                </a>

                <div id="collapsePages5" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.add.seminer') }}">Add Seminer</a>
                    </div>
                </div>
                <div id="collapsePages5" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.manage.seminer') }}">Manage Seminer</a>
                    </div>
                </div>
            </li>


            <li
                class="nav-item {{ request()->routeIs('admin.dashboard.gallery') || request()->routeIs('admin.dashboard.add.img') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages6"
                    aria-expanded="true" aria-controls="collapsePages6">
                    <i class="fa fa-image"></i>
                    <span>Gallery</span>
                </a>

                <div id="collapsePages6" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.dashboard.gallery') }}">Gallery Image</a>
                    </div>
                </div>
                <div id="collapsePages6" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.dashboard.add.img') }}">Add Gallery</a>
                    </div>
                </div>
            </li>

            <li
                class="nav-item {{ request()->routeIs('admin.add.tutorial') || request()->routeIs('admin.manage.tutorial') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages8"
                    aria-expanded="true" aria-controls="collapsePages8">
                    <i class="fas fa-upload"></i>
                    <span>Upload Tutorial</span>
                </a>

                <div id="collapsePages8" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.add.tutorial') }}">Add Tutorial</a>
                    </div>
                </div>
                <div id="collapsePages8" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.manage.tutorial') }}">Manage Tutorial</a>
                    </div>
                </div>
            </li>
            <li
                class="nav-item {{ request()->routeIs('dashboard.review.manage') || request()->routeIs('dashboard.review.add') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages9"
                    aria-expanded="true" aria-controls="collapsePages9">
                    <i class="fas fa-comments"></i>
                    <span>Manage Review </span>
                </a>

                <div id="collapsePages9" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('dashboard.review.manage') }}">Manage Review</a>
                    </div>
                </div>
                <div id="collapsePages9" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('dashboard.review.add') }}">Add Review</a>
                    </div>
                </div>
                <div id="collapsePages9" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('dashboard.review.student.manage') }}">Manage Student Review</a>
                    </div>
                </div>
            </li>

            <li
                class="nav-item {{ request()->routeIs('dashboard.blog.manage') || request()->routeIs('dashboard.blog.add') || request()->routeIs('dashboard.blog.update') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages10"
                    aria-expanded="true" aria-controls="collapsePages10">
                    <i class="fas fa-comments"></i>
                    <span>Manage Blog </span>
                </a>

                <div id="collapsePages10" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('dashboard.blog.manage') }}">Manage Blog</a>
                    </div>
                </div>
                <div id="collapsePages10" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white mb-1 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('dashboard.blog.add') }}">Add Blog</a>
                    </div>
                </div>
            </li>

            @if (Auth::guard('web')->user()->role == 'superadmin')
                <li class="nav-item {{ request()->routeIs('admin.user.maintain') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapsePages7" aria-expanded="true" aria-controls="collapsePages7">
                        <i class="fas fa-user"></i>
                        <span>Admin</span>
                    </a>

                    <div id="collapsePages7" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white mb-1 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.user.maintain') }}">Admin Management</a>
                        </div>
                    </div>
                </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-4">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- this is admin navbar --}}

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span
                                    class="badge badge-danger badge-counter">{{ isset($course_message) ? $course_message->count() : 0 }}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Course Message
                                </h6>
                                @if (isset($course_message))
                                    @foreach ($course_message as $item)
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('admin.course.message') }}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 12, 2019</div>
                                                <span class="font-weight-bold">{{ $item->name }}...</span>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif


                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="{{ route('admin.services.message') }}"
                                id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span
                                    class="badge badge-danger badge-counter">{{ isset($services_message) ? $services_message->count() : 0 }}</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Services Message
                                </h6>

                                @if (isset($services_message))
                                    @foreach ($services_message as $item)
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('admin.services.message') }}">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                    alt="...">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">{{ $item->name }}...</div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="{{ route('admin.services.message') }}">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('web')->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('adminpanel/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="admin_logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>




                    </ul>


                </nav>

@endif
