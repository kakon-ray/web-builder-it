@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    @if (Auth::guard('web')->user()->role == 'superadmin')
        <div class="container-fluid table-responsive">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center ">Admin <span style="color:#4e73df;"> Permission</span></h3>
                </div>
                <div class="col-lg-12">
                    <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                        <thead class="table-dark ">
                            <tr class="text-center">
                                <th class="th-sm">Name</th>
                                <th class="th-sm">Email</th>
                                <th class="th-sm">Update</th>
                                <th class="th-sm">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_user as $item)
                                @if ($item->role != 'superadmin')
                                    <tr class="text-center">
                                        <td class="th-sm ">{{ $item->name }}</td>
                                        <td class="th-sm ">{{ $item->email }}</td>
                                        <td class="th-sm " style="min-width: 250px;">
                                            @if ($item->role == 'admin')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="cancle_admin({!! $item->id !!})">Cancle Admin</button>
                                            @endif
                                            @if ($item->role != 'admin')
                                                <button type="button" class="btn btn-success btn-sm"
                                                    onclick="make_admin({!! $item->id !!})">Add Admin</button>
                                            @endif


                                        </td>
                                        <td class="th-sm " style="min-width: 250px;">
                                            <button type="button" onclick="delete_user({!! $item->id !!})"
                                                class="btn btn-danger btn-circle btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    @else
        <h2 class="text-center">You Can not View This Page</h2>

    @endif




    <script>
        const delete_user = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this User",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/user", {
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
                                title: "Is Not Delete this User",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            })

        }

        const make_admin = (id) => {
            axios
                .get("/admin/make/admin", {
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
                        title: "Is Not Create Admin",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });

        }

        const cancle_admin = (id) => {
            axios
                .get("/admin/cancle/admin", {
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
                        title: "Is Not Cancle Admin",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });

        }
    </script>

@endsection()
