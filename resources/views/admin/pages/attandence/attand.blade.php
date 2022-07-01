@extends('admin.layouts.master')
@section('css')

    @toastr_css

@section('title')
    {{trans('site.Grades')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('site.Attendance')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('site.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('site.Attendance')}}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
    <form method="post" action="{{ route('attandence.store') }}">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
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
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->gender->name}}</td>
                    <td>{{$student->grade->name}}</td>
                    <td>{{$student->classroom->class_name}}</td>
                    <td>{{$student->section->section_name}}</td>
                    <td>

                        @if(isset($student->attandence()->where('attandence_date',date('Y-m-d'))->first()->student_id))

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" disabled
                                       {{ $student->attandence()->first()->attandence_status == 1 ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="presence">
                                <span class="text-success">حضور</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" disabled
                                       {{ $student->attandence()->first()->attandence_status == 0 ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">غياب</span>
                            </label>

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

                        @endif

                        <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                        <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                        <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('site.Save') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
            @endsection
            @section('js')

                @toastr_js
                @toastr_render

                {{--            <script>--}}
                {{--                $(document).ready(function (){--}}
                {{--                    $('select[name="Grade_id"]').on('change',function (){--}}
                {{--                        var Grid_id=$(this).val();--}}
                {{--                        if (Grid_id){--}}
                {{--                            $.ajax({--}}

                {{--                                url:{{URL::to('classess')}}/+Grid_id,--}}
                {{--                                type:"Get",--}}
                {{--                                dataType:"json",--}}
                {{--                                success:function (data) {--}}

                {{--                                    $('select[name="Class_id"]').empty();--}}
                {{--                                    $.each(data,function (key,value) {--}}

                {{--                                        $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');--}}
                {{--                                    });--}}


                {{--                                }--}}

                {{--                            });--}}
                {{--                        }else {--}}
                {{--                            console.log('Ajax not woking');--}}
                {{--                        }--}}
                {{--                    });--}}

                {{--                });--}}
                {{--            </script>--}}


                <script>
                    $(document).ready(function () {
                        $('select[name="Grade_id"]').on('change', function () {
                            var Grade_id = $(this).val();
                            if (Grade_id) {
                                $.ajax({
                                    url: "{{ URL::to('classes') }}/" + Grade_id,
                                    type: "GET",
                                    dataType: "json",
                                    success: function (data) {
                                        $('select[name="Class_id"]').empty();
                                        $.each(data, function (key, value) {
                                            $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                        });
                                    },
                                });
                            } else {
                                console.log('AJAX load did not work');
                            }
                        });
                    });
                </script>




@endsection
