@extends('layouts.admin_app')
@section('title', 'Dashboard')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 pb-4 d-flex justify-content-end">
                <a href="{{ route('admin.add.tutorial')}}" type="button"
                class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Tutorial</a>
            </div>
            <div class="col-lg-12">
                <h3 class="text-center ">Mange<span style="color:#4e73df;"> Course Tutorial</span></h3>
            </div>

            <div class="col-lg-12 table-responsive">
                <table id="VisitorDt" class="table table-bordered dataTable" cellspacing="0" width="100%">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="th-sm">Course Name</th>
                            <th class="th-sm">Total Class</th>
                            <th class="th-sm">See All Tutorial</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_course as $item)
                            <tr class="text-center">
                                <td class="th-sm ">{{ $item->course_title }}</td>
                                <td class="th-sm ">{{ $item->tutorial->count() }}</td>
                                <td class="th-sm">
                                    <a href="{{ route('admin.manage.specific.tutorial', ['id' => $item->id]) }}" type="button"
                                        class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>


    </div>


@endsection()
