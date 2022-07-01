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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_promotion">
                                    {{trans('site.Delete All')}}
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('site.Student Name')}}</th>
                                            <th class="alert-danger">{{trans('site.Previouse Grade')}}</th>
                                            <th class="alert-danger">{{trans('site.Previouse Academy_Year')}}</th>
                                            <th class="alert-danger">{{trans('site.Previouse Classroom')}}</th>
                                            <th class="alert-danger">{{trans('site.Previouse Section')}}</th>
                                            <th class="alert-success">{{trans('site.C_Grade')}}</th>
                                            <th class="alert-success">{{trans('site.C_Academy_Year')}}</th>
                                            <th class="alert-success">{{trans('site.C_Classroom')}}</th>
                                            <th class="alert-success">{{trans('site.C_Section')}}</th>
                                            <th style="width: 100px">  {{trans('site.processes')}}  </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->p_grade->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->p_classroom->class_name}}</td>
                                                <td>{{$promotion->p_section->section_name}}</td>
                                                <td>{{$promotion->t_grade->name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>{{$promotion->t_classroom->class_name}}</td>
                                                <td>{{$promotion->t_section->section_name}}</td>
                                                <td style="width: 100px">
                                                    <a href="{{route('promotion.edit',$promotion->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_oneStudent{{$promotion->id}}"
                                                            title="{{ trans('site.Return') }}"><i
                                                            class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>


                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_promotion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('site.Deleted_Student')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('promotion.destroy','t')}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <input type="hidden" name="p_id" value="1">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('site.are you sure')}}</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.Close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('site.Save')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_oneStudent{{$promotion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('site.Deleted_Student')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('promotion.destroy','t')}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <input type="hidden" name="id" value="{{$promotion->id}}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('site.are you sure to return')}}{{$promotion->student->name}}</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.Close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('site.Save')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

@endsection
@section('js')

    @toastr_js
    @toastr_render



    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Classroom_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('site.Choose')}}...</option>');
                                $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="Classroom_id"]').on('change', function () {
                var classroom = $(this).val();
                if (classroom) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + classroom,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option selected disabled >{{trans('site.Choose')}}...</option>');
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>




    <script>
        $(document).ready(function () {
            $('select[name="Grade_id_new"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Classroom_id_new"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id_new"]').append('<option selected disabled >{{trans('site.Choose')}}...</option>');
                                $('select[name="Classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="Classroom_id_new"]').on('change', function () {
                var classroom = $(this).val();
                if (classroom) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + classroom,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id_new"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id_new"]').append('<option selected disabled >{{trans('site.Choose')}}...</option>');
                                $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>




@endsection
