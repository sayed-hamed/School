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
                                <a href="{{route('fee.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('site.Add Amount')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('site.pname')}}</th>
                                            <th>{{trans('site.amount')}}</th>
                                            <th>{{trans('site.Grade')}}</th>
                                            <th>{{trans('site.classrooms')}}</th>
                                            <th>{{trans('site.academic_year')}}</th>
                                            <th>{{trans('site.Description')}}</th>
                                            <th>{{trans('site.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$fee->title}}</td>
                                                <td>{{ number_format($fee->amount, 2) }}</td>
                                                <td>{{$fee->grade->name}}</td>
                                                <td>{{$fee->classroom->class_name}}</td>
                                                <td>{{$fee->year}}</td>
                                                <td>{{$fee->desc}}</td>
                                                <td>
                                                    <a href="{{route('fee.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('site.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>




                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_Fee{{ $fee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('site.Deleted_Fees')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('fee.destroy',$fee->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <input type="hidden" name="id" value="{{$fee->id}}">
                                                                <h5>{{trans('site.are you sure')}}</h5>

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
@endsection
