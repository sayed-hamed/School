@extends('admin.layouts.master')
@section('css')

    @toastr_css

@section('title')
    {{trans('site.students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('site.students')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('site.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('site.students')}}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('site.add_student') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('site.sname')}}</th>
                                            <th>{{trans('site.Email')}}</th>
                                            <th>{{trans('site.Gender')}}</th>
                                            <th>{{trans('site.Grade')}}</th>
                                            <th>{{trans('site.classrooms')}}</th>
                                            <th>{{trans('site.section')}}</th>
                                            <th>{{trans('site.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->class_name}}</td>
                                                <td>{{$student->section->section_name}}</td>
                                                <td>
                                                    <a href="{{route('students.edit',$student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $student->id }}" title="{{ trans('site.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="{{route('students.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('fee_invoices.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="{{trans('site.add-invoice')}}"><i class="fa fa-money"></i></a>
                                                </td>
                                            </tr>
                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        </div>
        @endif

        @if (session('status'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('status') }}</li>
                </ul>
            </div>
        @endif

        <h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
        <form method="post" action="{{route('attendance')}}" autocomplete="off">

            @csrf
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                   style="text-align: center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('site.sname')}}</th>
                    <th>{{trans('site.Email')}}</th>
                    <th>{{trans('site.Gender')}}</th>
                    <th>{{trans('site.Grade')}}</th>
                    <th>{{trans('site.classrooms')}}</th>
                    <th>{{trans('site.section')}}</th>
                    <th class="alert-success">الحضور والغياب</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->gender->name}}</td>
                        <td>{{$student->grade->name}}</td>
                        <td>{{$student->classroom->class_name}}</td>
                        <td>{{$student->section->section_name}}</td>
                        <td>

                            @if(isset($student->attandence()->where('attandence_date',date('Y-m-d'))->where('student_id',$student->id)->first()->student_id))

                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendences[{{ $student->id }}]" disabled
                                           {{ $student->attandence()->first()->attendence_status == 1 ? 'checked' : '' }}
                                           class="leading-tight" type="radio" value="presence">
                                    <span class="text-success">حضور</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendences[{{ $student->id }}]" disabled {{ $student->attandence()->first()->attendence_status == 0 ? 'checked' : '' }}
                                    class="leading-tight" type="radio" value="absent">
                                    <span class="text-danger">غياب</span>
                                </label>
                                <button type="button" class="btn btn-secondary btn-sm"
                                        data-toggle="modal"
                                        data-target="#edit_attendance{{ $student->id }}" title="حذف"><i
                                        class="fa fa-edit"></i></button>
{{--                                @include('pages.Teachers.dashboard.students.edit_attendance')--}}
                            @else

                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                           value="presence">
                                    <span class="text-success">حضور</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                           value="absent">
                                    <span class="text-danger">غياب</span>
                                </label>

                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                                <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <P>
                <button class="btn btn-success" type="submit">{{ trans('site.Save') }}</button>
            </P>
        </form><br>

    </div>
        <!-- row closed -->
@endsection
@section('js')

    @toastr_js
    @toastr_render
@endsection
