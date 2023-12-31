@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center ">Services<span style="color:#4e73df;"> Message</span></h3>
            </div>
            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                    <thead class="table-dark ">
                        <tr>
                            <th class="th-sm text-center">Name</th>
                            <th class="th-sm text-center">Phone Number</th>
                            <th class="th-sm text-center">Services Name</th>
                            <th class="th-sm text-center">Message</th>
                            <th class="th-sm text-center">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course_admission as $item)
                            <tr class="text-center">
                                <td class="th-sm ">{{ $item->name }}</td>
                                <td class="th-sm ">{{ $item->phone }}</td>
                                <td class="th-sm ">{{ $item->services_name }}</td>
                                <td class="th-sm w-25">
                                    {{ $item->message }}
                                </td>
                                <td class="th-sm ">

                                    <a type="button" onclick="delete_services_message({!! $item->id !!})"
                                        class="btn btn-danger btn-circle btn-sm"> <i class="fas fa-trash"></i></a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>



    </div>


    <script>
        const delete_services_message = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this Message",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/services/message", {
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
