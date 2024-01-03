@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center ">Student Course<span style="color:#4e73df;"> Request/Active</span></h3>
            </div>

            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                    <thead class="table-dark ">
                        <tr>
                            {{-- <th class="th-sm text-center">Student Email</th> --}}
                            <th class="th-sm text-center">Coruse Name</th>
                            <th class="th-sm text-center">Total Fee</th>
                            <th class="th-sm text-center">Pement</th>
                            <th class="th-sm text-center">Add Pement</th>
                            <th class="th-sm text-center">Status</th>
                            <th class="th-sm text-center">Details</th>
                            <th class="th-sm text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeCourse as $item)
                            <tr class="text-center">
                                {{-- <td class="th-sm ">{{ $item->students->email }}</td> --}}
                                <td class="th-sm ">
                                    {{ isset($item->add_course->course_title) ? $item->add_course->course_title : '' }}</td>
                                <td class="th-sm ">
                                    {{ isset($item->add_course->course_fee) ? $item->add_course->course_fee : 'Deleted Course' }}
                                </td>
                                <td class="th-sm ">{{ $item->pement_clear }}</td>
                                <td class="th-sm" style="width:120px">

                                    <button type="button" class="btn-success btn btn-sm"
                                        onclick="open_model({!! $item->id !!})">Add Pement</button>
                                    {{-- modal start --}}


                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Add Pement</h3>
                                                    <button type="button" class="btn-close"
                                                        onclick="close_model()"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <input type="text" class="form-control d-none" id="set_student_id">
                                                    <div class="mb-2">
                                                        <label class="text-start">Student Name</label>
                                                        <input type="text" class="form-control" id="set_student_name">

                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="text-start">Add Pement Amount</label>
                                                        <input type="text" class="form-control" id="student_add_amount"
                                                            placeholder="Pement Amount">
                                                    </div>
                                                </div>
                                                <div class="modal-footer text-start">
                                                    <button type="button" class="btn btn-secondary "
                                                        onclick="submit_add_pement({!! $item->id !!})"
                                                        data-bs-dismiss="modal">Submit</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- modal end --}}


                                </td>
                                <td class="th-sm ">
                                    @if ($item->pement_clear > 0)
                                        @php
                                            $percentage = ($item->pement_clear * 100) / $item->add_course->course_fee;
                                        @endphp
                                   


                                    @if ($percentage >= 30 && $item->pement_clear != 0)
                                        @if ($item->status == true)
                                            <div class="d-flex gap-2">
                                                <span class="text-success">Active</span>
                                                <button type="button"
                                                    onclick="deactive_admission_student({!! $item->id !!})"
                                                    class="btn-danger btn btn-sm">Disabled</button>
                                            </div>
                                        @endif
                                        @if ($item->status != true)
                                            <div class="d-flex gap-2">
                                                <span class="text-danger">Pending</span>
                                                <button type="button"
                                                    onclick="active_admission_student({!! $item->id !!})"
                                                    class="btn-success btn btn-sm">Active</button>
                                            </div>
                                        @endif
                                    @endif

                                    @endif


                                </td>
                                <td class="th-sm">
                                    <a href="{{ route('admin.admission.sutdent.details', ['id' => $item->id]) }}"
                                        type="button" class="btn btn-success btn-sm">Details</a>
                                </td>
                                <td class="th-sm">
                                    <a type="button" onclick="delete_admission_student({!! $item->id !!})"
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
        // modal method start

        const open_model = (id) => {
            $('#exampleModal').modal('show');

            axios
                .get("/admin/addpement/student/data", {
                    params: {
                        id: id
                    }
                })
                .then(function(response) {

                    if (response.status == 200) {
                        var name = response.data.students.student_name
                        var id = response.data.id
                        document.getElementById("set_student_name").value = name;
                        document.getElementById("set_student_id").value = id;

                    }

                })
                .catch(function(error) {
                    Swal.fire({
                        position: "top-center",
                        icon: "error",
                        title: "Your form submission is not complete",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });

        }

        const close_model = (id) => {
            $('#exampleModal').modal('hide');

        }

        const submit_add_pement = () => {

            var add_pement_amount = $("#student_add_amount").val();
            var set_student_id = $("#set_student_id").val();

            axios
                .post("/admin/addpement/submit", {
                    set_student_id,
                    add_pement_amount
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
                        title: error.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });

        }

        // modal method end

        const delete_admission_student = (id) => {

            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this Student",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/admission/sutdent", {
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

        const active_admission_student = (id) => {

            axios
                .get("/admin/active/admission/student", {
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


        const deactive_admission_student = (id) => {

            axios
                .get("/admin/deactive/admission/student", {
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

@endsection
