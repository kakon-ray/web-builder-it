@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')
    <style>
        .img-delete {
            position: absolute;
            left: 12px
        }
    </style>

    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-lg-12">
                <a type="button" href="{{ route('admin.dashboard.add.img') }}" class="btn btn-primary w-100">Add New Gallery
                    Image</a>
            </div>
            @foreach ($gallery_image as $item)
                <div class="col-lg-3 position-relative">
                    <div class="card p-3">
                        <img src="{{ $item->gallery_img }}" class="img-fluid" style="height:170px"
                            alt="Gallery Image Khulna IT" title="">
                        <button class="btn btn-danger btn-sm img-delete"
                            onclick="delete_gallery_image({!! $item->id !!})"> <i class="fas fa-trash"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const delete_gallery_image = (id) => {
            Swal.fire({
                customClass: 'swalstyle',
                title: 'Are you sure?',
                text: "Delete this Services Item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/admin/delete/gallery/image", {
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
