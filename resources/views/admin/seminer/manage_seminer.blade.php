@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 pb-4 d-flex justify-content-between">
                <h3 class="text-center ">Manage<span style="color:#4e73df;"> Seminer Item</span></h3>
                <a href="{{ route('admin.add.seminer')}}" type="button"
                class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Seminer</a>
            </div>

            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="th-sm">Seminar Name</th>
                            <th class="th-sm">Seminar Date</th>
                            <th class="th-sm">Seminar Time</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allseminer as $item)
                            <tr class="text-center">
                                <td class="th-sm ">{{ $item->seminer_title }}</td>
                                <td class="th-sm ">{{ $item->seminer_date }}</td>
                                <td class="th-sm ">{{ $item->seminer_time }}</td>

                                <td class="th-sm">
                                    <a href="{{ route('admin.edit.seminar', ['id' => $item->id]) }}" type="button"
                                        class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                </td>

                                <td class="th-sm">
                                    <button type="button" onclick="delete_seminar({!! $item->id !!})"
                                        class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const delete_seminar = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this Item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/seminar", {
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
    </script>

@endsection()
