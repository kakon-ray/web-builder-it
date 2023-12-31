@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center ">Student Pement<span style="color:#4e73df;"> Request</span></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered table-striped dataTable overflow-scroll" cellspacing="0"
                    width="100%">
                    <thead class="table-dark ">
                        <tr>
                            <th class="th-sm text-center">Order Id</th>
                            {{-- <th class="th-sm text-center">Email</th> --}}
                            <th class="th-sm text-center">From Number</th>
                            <th class="th-sm text-center">Send Number</th>
                            <th class="th-sm text-center">Amount</th>
                            <th class="th-sm text-center">Transaction Id</th>
                            <th class="th-sm text-center">Pement method</th>
                            <th class="th-sm text-center">Status</th>
                            <th class="th-sm text-center">Accept</th>
                            <th class="th-sm text-center">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pement_request as $item)
                            <tr class="text-center">
                                <td class="th-sm">{{ $item->id }}</td>
                                {{-- <td class="th-sm">{{$item->email}}</td> --}}
                                <td class="th-sm">{{ $item->phone }}</td>
                                <td class="th-sm">{{ $item->send_phone_num }}</td>
                                <td class="th-sm">{{ $item->amount }}</td>
                                <td class="th-sm">{{ $item->transaction_id }}</td>
                                <td class="th-sm">{{ $item->pement_method }}</td>
                                <td class="th-sm">{{ $item->status }}</td>

                                <td class="th-sm">
                                    @if ($item->status == 'Pending')
                                        <form action="{{ route('admin.add.pement.main.account') }}" method="POST"
                                            id="admin_pement_auto_add_alert">
                                            @csrf
                                            <input type="text" class="d-none" name="amount" value="{{ $item->amount }}">
                                            <input type="text" class="d-none" name="id" value="{{ $item->id }}">
                                            <input type="text" class="d-none" name="active_course_id"
                                                value="{{ $item->active_course_id }}">
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>
                                    @endif
                                    @if ($item->status == 'Approved')
                                        <form action="{{ route('admin.unaccepted.pement.main.account') }}" method="POST"
                                            id="admin_pement_auto_add_alert">
                                            @csrf
                                            <input type="text" class="d-none" name="amount"
                                                value="{{ $item->amount }}">
                                            <input type="text" class="d-none" name="id"
                                                value="{{ $item->id }}">
                                            <input type="text" class="d-none" name="active_course_id"
                                                value="{{ $item->active_course_id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Unaccepted</button>
                                        </form>
                                    @endif
                                </td>
                                <td class="th-sm">
                                    <a type="button" onclick="delete_pement_request({!! $item->id !!})"
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
