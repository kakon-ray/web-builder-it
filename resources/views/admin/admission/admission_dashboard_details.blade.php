@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')

    <style>
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: var(--main-color);
            border-color: var(--main-color);
        }

        #sidebarMenu {
            height: 100%;
        }
    </style>

    @if (isset($course_request->add_course))
        <div class="container-fluid">
            <div class="card p-3 table-responsive">
                <div class="card-title text-center">
                    <h3>Admission Student Details</h3>
                </div>
                <table id="VisitorDt" class="table table-bordered dataTable
          cellspacing="0" width="100%">

                    <tbody>

                        <tr>
                            <td class="th-sm ">Course Title</td>
                            <td class="th-sm ">{{ $course_request->add_course->course_title }}</td>
                        </tr>

                        <tr>
                            <td class="th-sm ">Course Fee</td>
                            <td class="th-sm ">{{ $course_request->add_course->course_fee }}</td>
                        </tr>
                        <tr>
                            <td class="th-sm ">Pement</td>
                            <td class="th-sm ">{{ $course_request->pement_clear }}</td>
                        </tr>

                        @if ($course_request->pement_clear > 0)
                            @php
                                $percentage = ($course_request->pement_clear * 100) / $course_request->add_course->course_fee;
                            @endphp
                            <tr>
                                <td class="th-sm ">Pement Clear</td>
                                <td class="th-sm ">{{ $percentage }}% Pement Clear</td>
                            </tr>
                        @endif

                        <tr>
                            <td class="th-sm ">Course Imge</td>
                            <td class="th-sm "><img src="{{ $course_request->add_course->course_img }}" style="height:100px"
                                    class="img-fluid" alt=""></td>
                        </tr>

                        <tr>
                            <td class="th-sm ">Status</td>
                            <td class="th-sm ">{{ $course_request->status ? 'Active' : 'Inactive' }}</td>
                        </tr>

                        <tr>
                            <td class="th-sm ">Student Email</td>
                            <td class="th-sm ">{{ $course_request->students->email }}</td>
                        </tr>
                        <tr>
                            <td class="th-sm ">Student Name</td>
                            <td class="th-sm ">{{ $course_request->students->student_name }}</td>
                        </tr>
                        <tr>
                            <td class="th-sm ">Admission Details</td>
                            <td class="th-sm ">{{ $course_request->created_at }}</td>
                        </tr>


                    </tbody>



                </table>
            </div>


        </div>
    @else
        <h2 class="text-center">Course Not Found</h2>
    @endif


@endsection()
