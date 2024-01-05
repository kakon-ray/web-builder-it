@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 pb-4 d-flex justify-content-end">
                <a href="{{ route('admin.add.tutorial') }}" type="button" class="btn btn-primary"><i
                        class="fas fa-plus me-2"></i>Add New Tutorial</a>
            </div>
            <div class="col-lg-12">
                @foreach ($tutorial as $item)
                    <h3 class="text-center ">Mange<span style="color:#4e73df;"> {{ $item->add_course->course_title }}
                        </span>Tutorial</h3>
                    @if ($item->add_course->course_title)
                    @break
                @endif
            @endforeach
        </div>
        <div class="col-lg-12 table-responsive">
            <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th class="th-sm">Course Name</th>
                        <th class="th-sm">Tutorial Name</th>
                        <th class="th-sm">Document Preview</th>
                        <th class="th-sm">Preview</th>
                        <th class="th-sm">Action</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($tutorial as $item)
                        <tr class="text-center">
                            <td class="th-sm ">{{ $item->add_course->course_title }}</td>
                            <td class="th-sm ">{{ $item->video_title }}</td>
                            <td class="th-sm"><a href="{{ $item->other_document }}" target="_blank"
                                    style="color: blue;font-weight:blod"><i class="fas fa-download"></i></a></td>
                            <td class="th-sm ">
                                @if ($item->hosting_type == 'googlecloud')
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#googlecloud"
                                        data-video_link = "{{ $item->video_link }}" class="googlecloudvideo"
                                        style="color: red;">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                @endif

                                @if ($item->hosting_type == 'youtube')
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#youtube"
                                        data-video_link = "{{ $item->video_link }}" class="youtubevideo"
                                        style="color: red;">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                @endif
                                {{-- modal start --}}


                                <div class="modal fade" id="googlecloud" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <a type="button" class="btn-close" onclick="close_model()"></a>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div style="position: relative;width:100%;height:400px">
                                                    <iframe width="100%" height="400" frameborder="0" scrolling="no"
                                                        seamless="" id="google_video_set"
                                                        sandbox="allow-same-origin allow-scripts"
                                                        allowfullscreen="allowfullscreen" src=""></iframe>

                                                    <div
                                                        style="width: 80px; height: 80px; position: absolute; opacity: 0; right: 0px; top: 0px;">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="youtube" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <a type="button" class="btn-close" onclick="close_model()"></a>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div style="position: relative;width:100%;height:400px">
                                                    <iframe width="100%" height="100%" id="youtube_video_set"
                                                        src="" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        allowfullscreen></iframe>

                                                    <div
                                                        style="width: 80px; height: 80px; position: absolute; opacity: 0; right: 0px; top: 0px;">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- modal end --}}
                            </td>
                            <td class="th-sm">
                                <a type="button"
                                    href="{{ route('admin.edit.specific.tutorial', ['id' => $item->id]) }}"
                                    class="btn btn-success btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                <a type="button" onclick="delete_tutorial({!! $item->id !!})"
                                    class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    const close_model = (id) => {
        $('#exampleModal').modal('hide');
        location.reload();

    }



    const delete_tutorial = (id) => {
        Swal.fire({
            customClass: 'swalstyle',
            title: 'Are you sure?',
            text: "Delete this Course Item",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .get("/admin/delete/tutorial", {
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
