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


    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">

                @include('admin.pages.errors')

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($grads as $Grade)

                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{$Grade->name}}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('site.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('site.Name_Class') }}</th>
                                                                    <th>{{ trans('site.Status') }}</th>
                                                                    <th>{{ trans('site.processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($Grade->sections as $list_Sections)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $list_Sections->section_name }}</td>
                                                                        <td>{{ $list_Sections->classroom->class_name }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($list_Sections->Status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('site.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('site.Status_Section_No') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>
                                                                            <a href="{{route('attandence.show',$list_Sections->id)}}" class="btn btn-warning btn-sm">{{trans('site.List Students')}}</a>
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
                                    @endforeach
                                </div>
                        </div>
                    </div>


                </div>
            </div>
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
