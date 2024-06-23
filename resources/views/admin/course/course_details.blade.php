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


    <div class="container-fluid">
        <div class="card p-3 table-responsive">
            <div class="card-title text-center">
                <h3>Course Details</h3>
            </div>
            <table id="VisitorDt" class="table table-bordered dataTable
          cellspacing="0" width="100%">

                <tbody>

                    <tr>
                        <td class="th-sm ">Batch Name</td>
                        <td class="th-sm "> Batch {{ $course_details->batch }}</td>
                    </tr>
                    <tr>
                        <td class="th-sm ">Course Title</td>
                        <td class="th-sm ">{{ $course_details->course_title }}</td>
                    </tr>

                    <tr>

                        <td class="th-sm ">Instructor Name</td>
                        <td class="th-sm ">{{ $course_details->instructor_name }}</td>
                    </tr>
                    
                    <tr>
                        <td class="th-sm ">Instructor Image</td>
                        <td class="th-sm "><img src="{{ $course_details->instructor_img }}" style="height:100px"
                                class="img-fluid" alt=""></td>
                    </tr>

                    <tr>
                        <td class="th-sm ">Instructor Desc</td>
                        <td class="th-sm "><img src="{{ $course_details->instructor_desc }}" style="height:100px"
                                class="img-fluid" alt=""></td>
                    </tr>

                    <tr>

                        <td class="th-sm ">Course Duration</td>
                        <td class="th-sm ">{{ $course_details->duration }}</td>
                    </tr>

                    <tr>
                        <td class="th-sm ">Total Lectures</td>
                        <td class="th-sm ">{{ $course_details->lectures }}</td>
                    </tr>

                    <tr>
                        <td class="th-sm ">Language</td>
                        <td class="th-sm ">{{ $course_details->language }}</td>
                    </tr>

                    <tr>
                        <td class="th-sm ">Projects</td>
                        <td class="th-sm ">{{ $course_details->projects }}</td>
                    </tr>

                    <tr>
                        <td class="th-sm ">Course Fee</td>
                        <td class="th-sm ">{{ $course_details->course_fee }}</td>
                    </tr>
                    <tr>
                        <td class="th-sm ">New Course Fee</td>
                        <td class="th-sm ">{{ $course_details->new_course_fee }}</td>
                    </tr>
                    <tr>
                        <td class="th-sm ">Spacial Discount Course Fee</td>
                        <td class="th-sm ">{{ $course_details->spacial_discount }}</td>
                    </tr>

                    <tr>
                        <td class="th-sm ">Course Image</td>
                        <td class="th-sm "><img src="{{ $course_details->course_img }}" style="height:100px"
                                class="img-fluid" alt=""></td>
                    </tr>
                    <tr>
                        <td class="th-sm ">Instructor Image</td>
                        <td class="th-sm "><img src="{{ $course_details->instructor_img }}" style="height:100px"
                                class="img-fluid" alt=""></td>
                    </tr>
               
                    <tr>
                        <td class="th-sm ">desc</td>
                        <td class="th-sm ">
                            @php
                                echo $course_details->desc;
                            @endphp
                        </td>
                    </tr>


                </tbody>



            </table>
        </div>


    </div>



@endsection()
