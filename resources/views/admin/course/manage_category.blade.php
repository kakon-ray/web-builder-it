@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')


<div class="container-fluid">
    <div class="col-lg-12 pb-4 d-flex justify-content-between">
        <h3 class="text-center ">Manage <span style="color:#4e73df;"> Course Category</span></h3>
        <a href="{{ route('admin.course.add.catagory') }}" type="button" class="btn btn-primary"><i
                class="fas fa-plus me-2"></i>Add
            New Category</a>
    </div>

    <div class="col-lg-12 table-responsive">
        <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
            <thead class="table-dark">
                <tr>
                    <th class="th-sm text-center">ID</th>
                    <th class="th-sm text-center">Category Name</th>
                    <th class="th-sm text-center">Category Slug</th>
                    <th class="th-sm text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_category as $item)
                <tr>
                    <td class="th-sm text-center">{{ $item->id }}</td>
                    <td class="th-sm text-center">{{ $item->category_name}}</td>
                    <td class="th-sm text-center">{{ $item->category_slug }}</td>
                    <td class="th-sm text-center d-flex gap-2">
                        <form method="POST" action="{{ route('admin.course.catagory.delete') }}" id="delete_alert"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" value="{{$item->id}}" class="d-none">
                            <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                        <a href="{{ route('admin.edit.course.catagory', ['id' => $item->id]) }}" type="button"
                            class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>

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
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);

                            } else {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'error',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1000
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
                                timer: 1000,
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
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);

                            } else {
                                Swal.fire({
                                    customClass: 'swalstyle',
                                    position: 'top-center',
                                    icon: 'error',
                                    title: response.data.msg,
                                    showConfirmButton: false,
                                    timer: 1000
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
                                timer: 1000,
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
                            timer: 1000
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    } else {
                        Swal.fire({
                            customClass: 'swalstyle',
                            position: 'top-center',
                            icon: 'error',
                            title: response.data.msg,
                            showConfirmButton: false,
                            timer: 1000
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
                        timer: 1000,
                    });
                });

        }
</script>
@endsection()