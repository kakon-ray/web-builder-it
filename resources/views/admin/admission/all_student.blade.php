@extends('layouts.admin_app')
@section('title', 'All Student Information')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center ">All Student<span style="color:#4e73df;"> Information</span></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered table-striped dataTable overflow-scroll" cellspacing="0"
                    width="100%">
                    <thead class="table-dark ">
                        <tr>
                            <th class="th-sm text-center">Student Id</th>
                            <th class="th-sm text-center">Student Name</th>
                            <th class="th-sm text-center">Send Email</th>
                            <th class="th-sm text-center">Phone</th>
                            <th class="th-sm text-center">Active Course</th>
                           

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="text-center">
                                <td class="th-sm">{{ $student->id }}</td>
                                <td class="th-sm">{{ $student->student_name}}</td>
                                <td class="th-sm">{{ $student->email}}</td>
                                <td class="th-sm">{{ $student->phone}}</td>
                                <td class="th-sm">{{ $student->active_course->count()}}</td>
                                
                

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        const delete_pement_request = (id) => {

            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this Student Pement Request",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/pement/request", {
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

@endsection
