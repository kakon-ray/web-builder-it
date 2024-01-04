@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 pb-4 d-flex justify-content-between">
                <h3 class="text-center ">Manage<span style="color:#4e73df;"> Student Feedback</span></h3>
    
            </div>

            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Student Name</th>
                            <th class="th-sm">Star</th>
                            <th class="th-sm">Desciption</th>
                            <th class="th-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allReview as $item)
                            <tr class="text-center">
                                <td class="th-sm ">
                                    <img src="{{ $item->image }}" style="width: 100px;height:50px" alt="">
                                </td>
                                <td class="th-sm ">{{ $item->name }}</td>
                                <td class="th-sm ">{{ $item->review_star }}</td>
                                <td class="th-sm ">{{ $item->description }}</td>

                 
                                <td class="th-sm">
                                    <button type="button" onclick="delete_review({!! $item->id !!})"
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
        const delete_review = (id) => {
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
                        .get("/dashboard/review/student/delete", {
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
