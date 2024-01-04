@extends('layouts.app')
@section('title')
    {{ 'My Classroom | Web Builder IT ' }}
@endsection

@section('content')

    <section style="background-color: #eee;">
        <div class="container table-responsive">
            <div class="row">
                <div class="col-lg-12 text-center pt-3">
                    <h2 class="heading"><span class="sm-red-title">{{$activeCourseDetails->add_course->course_title}}</span> Tutorial</h2>
                </div>
                <div class="col-lg-12 pt-3">
                  
            </div>
            <div class="col-lg-12">
                <table id="VisitorDt" class="table table-striped dataTable" cellspacing="0" width="100%">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="th-sm text-center">Course Name</th>
                            <th class="th-sm text-center">Tutorial Name</th>
                            <th class="th-sm text-center">Document Download</th>
                            <th class="th-sm text-center">Video</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (isset($student_tutorial))
                            @foreach ($student_tutorial as $item)
                                <tr class="text-center">
                                    <td class="th-sm ">{{ $item->add_course->course_title }}</td>
                                    <td class="th-sm ">{{ $item->video_title }}</td>
                                    <td class="th-sm"><a href="{{ $item->other_document }}" target="_blank"
                                            style="color: blue;font-weight:blod"><i class="fas fa-download"></i></a>
                                    </td>
                                    <td class="th-sm ">
                                        @if ($item->hosting_type == 'googlecloud')
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#googlecloud"
                                                data-video_link = "{{ $item->video_link }}" class="googlecloudvideo"
                                                style="color: #FF1E1E;">
                                                <i class="fas fa-play-circle"></i>
                                            </a>
                                        @endif

                                        @if ($item->hosting_type == 'youtube')
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#youtube"
                                                data-video_link = "{{ $item->video_link }}" class="youtubevideo"
                                                style="color: #FF1E1E;">
                                                <i class="fas fa-play-circle"></i>
                                            </a>
                                        @endif
                                        {{-- modal start --}}


                                        <div class="modal fade" id="googlecloud" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <a type="button" class="btn-close"
                                                            onclick="close_model()"></a>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div style="position: relative;width:100%;height:400px">
                                                            <iframe width="100%" height="100%" frameborder="0"
                                                                scrolling="no" seamless="" id="google_video_set"
                                                                sandbox="allow-same-origin allow-scripts"
                                                                allowfullscreen="allowfullscreen"
                                                                src=""></iframe>

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
                                                        <a type="button" class="btn-close"
                                                            onclick="close_model()"></a>
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

                                </tr>
                            @endforeach
                        @endif


                    </tbody>
                </table>
            </div>
        </div>



    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    const close_model = (id) => {
        $('#exampleModal').modal('hide');
        location.reload();
    }
</script>
@endsection
