@extends('layouts.admin_app')
@section('title', 'Main Course Manage Active Course')

@section('content')


    <div class="container-fluid">
    
        <div class="col-lg-12">
            <h3 class="text-center">All Course<span style="color:#4e73df;"> Activity</span></h3>
        </div>
        <div class="col-lg-12 table-responsive">
            <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                <thead class="table-dark">
                    <tr>
                        <th class="th-sm text-center">Course Title</th>
                        <th class="th-sm text-center">Fee</th>
                        <th class="th-sm text-center">Image</th>
                        <th class="th-sm text-center">Status</th>
                        <th class="th-sm text-center">Active Course</th>
                        <th class="th-sm text-center">Activity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allCourse as $item)
                        <tr>
                            <td class="th-sm text-center">{{ $item->course_title }}</td>
                            <td class="th-sm text-center">{{ $item->course_fee }}</td>
                            <td class="th-sm text-center">
                                <img src="{{ $item->course_img }}" style="height:50px" alt="Course Image">
                            </td>
                            <td class="th-sm text-center">
                                @if ($item->status == true)
                                   <p class="text-success">Active</p>
                                @endif
                            </td>
                            <td class="th-sm text-center">
                            @foreach($addCourseWithActiveCourse as $activeCourse)
                               @if($activeCourse->id == $item->id)
                                    <p>{{$activeCourse->active_course->count()}}</p>
                               @endif
                            @endforeach
                            </td>

                            <td class="th-sm text-center">
                                <a href="{{ route('admin.course.activity.details', ['id' => $item->id]) }}" type="button"
                                    class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>


@endsection()
