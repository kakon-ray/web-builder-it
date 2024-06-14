@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

<style>
    .modal-content {
        width: 112%;
    }

    .unread-text{
        color: #333;
        font-weight: bold;
        color: #446ad8
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center ">Seminer/Course<span style="color:#4e73df;"> Message</span></h3>
        </div>
        <div class="col-lg-12 table-responsive">
            <table id="VisitorDt" class="table table-sm table-bordered home-table" cellspacing="0"
                width="100%">
                <thead class="table-dark ">
                    <tr class="text-center">
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Phone Number</th>
                        <th class="th-sm">Course Name</th>
                        <th class="th-sm">Message</th>
                        <th class="th-sm">Read Messsage</th>
                        <th class="th-sm">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course_admission as $item)
                    @if($item->count == 0)
                    <tr class="text-center unread-text">
                        <td class="th-sm">{{ $item->name }}</td>
                        <td class="th-sm">{{ $item->phone }}</td>
                        <td class="th-sm">{{ $item->course_name }}</td>
                        <td class="th-sm">
                            {{substr($item->message, 0, 30)}} ....
                        </td>
                        @if($item->count == 0)
                        <td class="th-sm">
                            <a type="button" id="read_btn{{$item->id}}" class="btn btn-success btn-sm"
                                onclick="readMessage({!! $item->id !!})">Read</a>
                        </td>
                        @endif

                        @if($item->count == 1)
                        <td class="th-sm">
                            <div>
                                <a type="button" id="unread_btn{{$item->id}}" class="btn btn-secondary btn-sm"
                                onclick="unReadMessage({!! $item->id !!})">Unread</a>
                            </div>
                            
                        </td>
                        @endif

                        <td class="th-sm ">
                            <a type="button" class="btn btn-danger btn-sm btn-circle"
                                onclick="delete_course_message({!! $item->id !!})"><i class="fas fa-trash"></i></a>
                        </td>

                    </tr>
                    @endif

                    @if($item->count == 1)
                    <tr class="text-center">
                        <td class="th-sm">{{ $item->name }}</td>
                        <td class="th-sm">{{ $item->phone }}</td>
                        <td class="th-sm">{{ $item->course_name }}</td>
                        <td class="th-sm">
                            {{substr($item->message, 0, 30)}} ....
                        </td>
                        @if($item->count == 0)
                        <td class="th-sm">
                            <a type="button" id="read_btn{{$item->id}}" class="btn btn-success btn-sm"
                                onclick="readMessage({!! $item->id !!})">Read</a>
                        </td>
                        @endif

                        @if($item->count == 1)
                        <td class="th-sm">
                            <div>
                                <a type="button" id="unread_btn{{$item->id}}" class="btn btn-secondary btn-sm"
                                onclick="unReadMessage({!! $item->id !!})">Unread</a>
                            </div>
                            
                        </td>
                        @endif

                        <td class="th-sm ">
                            <a type="button" class="btn btn-danger btn-sm btn-circle"
                                onclick="delete_course_message({!! $item->id !!})"><i class="fas fa-trash"></i></a>
                        </td>

                    </tr>
                    @endif
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>


    {{-- Modal Start --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h5> <b>Name :</b> <span id="message_title"></span></h5>
                    <hr>
                    <h5><b>Phone:</b> <span id="modal_phone"></span></h5>
                    <hr>
                    <h5><b>Course Name:</b> <span id="modal_course_name"></span></h5>
                    <hr>
                    <p id="modal_desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, quaerat?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closemodal()">Close</button>
                </div>

            </div>
        </div>
    </div>

    {{-- End Modal --}}

</div>
<script>
    const delete_course_message = (id) => {
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
                        .get("/admin/delete/course/message", {
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


        const readMessage = (id) => {
            $('#exampleModal').modal('show');

            axios
                .get(`/admin/readmessage/${id}`)
                .then(function(response) {

                    console.log(response.data.message)

                    if(response.data.status){

                        document.getElementById("message_title").innerText = response.data.message.name;
                        document.getElementById("modal_phone").innerText = response.data.message.phone;
                        document.getElementById("modal_course_name").innerText = response.data.message.course_name;
                        document.getElementById("modal_desc").innerText = response.data.message.message;

                        var element = document.getElementById(`read_btn${id}`);
                        element.innerText = 'Unread'
                        element.classList.remove("btn-success");
                        element.classList.add("btn-secondary");
                    }


                })
                .catch(function(error) {
                    // Swal.fire({
                    //     position: "top-center",
                    //     icon: "error",
                    //     title: "Your form submission is not complete",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                });

        }

        const unReadMessage = (id) => {

            axios
                .get(`/admin/unread-message/${id}`)
                .then(function(response) {

                    if(response.data.status){
                        Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    var element = document.getElementById(`unread_btn${id}`);
                    element.innerText = 'Read'
                    element.classList.remove("btn-secondary");
                    element.classList.add("btn-success");

                    setTimeout(()=>{
                        window.location.reload();
                    },1500)
            

                    }

                })
                .catch(function(error) {
                    // Swal.fire({
                    //     position: "top-center",
                    //     icon: "error",
                    //     title: "Your form submission is not complete",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                });

        }




        const closemodal = () => {
            $('#exampleModal').modal('hide');
            window.location.reload();
        }

</script>

@endsection()