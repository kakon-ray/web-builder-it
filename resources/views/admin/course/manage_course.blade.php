@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')


    <div class="container-fluid">
        <div class="col-lg-12 pb-4 d-flex justify-content-between">
            <h3 class="text-center ">Manage Main<span style="color:#4e73df;"> Course</span></h3>
            <a href="{{ route('admin.add.course') }}" type="button" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add
                New Course</a>
        </div>

        <div class="col-lg-12 table-responsive">
            <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                <thead class="table-dark">
                    <tr>
                        <th class="th-sm text-center">ID</th>
                        <th class="th-sm text-center">Title</th>
                        <th class="th-sm text-center">Pement</th>
                        <th class="th-sm text-center">Image</th>
                        <th class="th-sm text-center">Status</th>
                        <th class="th-sm text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allCourse as $item)
                        <tr>
                            <td class="th-sm text-center">{{ $item->id }}</td>
                            <td class="th-sm text-center">{{ $item->course_title }}</td>
                            <td class="th-sm text-center">{{ $item->course_fee }}</td>
                            <td class="th-sm text-center">
                                <img src="{{ $item->course_img }}" style="height:50px" alt="Course Image">
                            </td>


                            <td class="th-sm text-center" style="min-width: 200px;">
                                @if ($item->status == true)
                                    <span class="text-success">Active</span>
                                    <a type="button" onclick="dective_course_status({!! $item->id !!})"
                                        class="btn btn-danger btn-sm">Inactive</a>
                                @else
                                    <a type="button" onclick="active_course_status({!! $item->id !!})"
                                        class="btn btn-success btn-sm">Active</a>
                                @endif
                            </td>

                            <td class="th-sm text-center" style="min-width: 200px;">
                                <a href="{{ route('admin.course.details', ['id' => $item->id]) }}" type="button"
                                    class="btn btn-success btn-circle btn-sm"><i class="fas fa-eye"></i></a>

                                <a href="{{ route('admin.edit.course', ['id' => $item->id]) }}" type="button"
                                    class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>

                                @if ($item->status == false)
                                    <a type="button" onclick="delete_course({!! $item->id !!})"
                                        class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                @endif


                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>



    </div>


    <script>
        const delete_course = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "If Delete course delete all tutorial",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/course", {
                            params: {
                                id: id
                            }
                        })
                        .then(function(response) {
                            if (response.data.status == 200) {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'success',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);

                            } else {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'error',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }

                        })
                        .catch(function(error) {
                            Swal.fire({
                                customClass: 'swalstyle',
                                position: "top-center",
                                icon: "error",
                                title: "Your form submission is not complete",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            })



        }


        const active_course_status = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "If you Active course can not delete it",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Active'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/active/course", {
                            params: {
                                id: id
                            }
                        })
                        .then(function(response) {

                            if (response.data.status == 200) {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'success',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);

                            } else {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'error',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }

                        })
                        .catch(function(error) {
                            Swal.fire({
                                customClass: 'swalstyle',
                                position: "top-center",
                                icon: "error",
                                title: "External Error",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });

                }
            })



        }
        const dective_course_status = (id) => {

            axios
                .get("/admin/deactive/course", {
                    params: {
                        id: id
                    }
                })
                .then(function(response) {

                    if (response.data.status == 200) {
                        Swal.fire({
                            customClass: 'swalstyle',
                            position: 'top-center',
                            icon: 'success',
                            title: response.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1500);

                    } else {
                        Swal.fire({
                            customClass: 'swalstyle',
                            position: 'top-center',
                            icon: 'error',
                            title: response.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                })
                .catch(function(error) {
                    Swal.fire({
                        customClass: 'swalstyle',
                        position: "top-center",
                        icon: "error",
                        title: "External Error",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });

        }
    </script>
@endsection()
