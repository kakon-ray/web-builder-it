@extends('layouts.app')
@section('title')
    {{ 'My Order | Web Builder IT ' }}
@endsection

@section('content')
    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-12 pt-3 pb-3 text-center">
                    <h2 class="fw-bold heading">My<span class="sm-red-title"> Order</span></h2>
                </div>
                <div class="col-lg-12 table-responsive">
                    <table id="VisitorDt" class="table table-striped dataTable" cellspacing="0" width="100%">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th class="th-sm text-center">Order Id</th>
                                <th class="th-sm text-center">Course Name</th>
                                <th class="th-sm text-center">Email</th>
                                <th class="th-sm text-center">Amount</th>
                                <th class="th-sm text-center">Status</th>

                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($myorder as $item)
                                @if ($item->status == 'Approved' || $item->status == 'Pending')
                                    <tr class="text-center">
                                        <td class="th-sm ">{{ $item->id }}</td>
                                        @php
                                            $activeCourse = DB::table('active_courses')->where('id',$item->active_course_id)->first();
                                            $course_name = DB::table('add_courses')->where('id',$activeCourse->course_id)->first();
                                        @endphp
                                       
                                            <td class="th-sm ">{{ $course_name->course_title}}</td>
                                      
                                        
                                        <td class="th-sm ">{{ $item->email }}</td>
                                        <td class="th-sm ">{{ $item->amount }}</td>
                                        <td class="th-sm">
                                            @if ($item->status == 'Approved')
                                                <b class="text-success">{{ $item->status }}</b>
                                            @else
                                                <p>{{ $item->status }}</p>
                                            @endif
                                        </td>

                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
