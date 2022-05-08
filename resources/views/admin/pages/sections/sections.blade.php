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
                <h4 class="mb-0"> {{trans('site.classrooms')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('site.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('site.classrooms')}}</li>
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
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('site.add_section') }}</a>
            </div>

           @include('admin.pages.errors')

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($grads as $Grade)

                            <div class="acd-group">
                                <a href="#" class="acd-heading">{{ $Grade->name }}</a>
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

                                                                        <a href="#"
                                                                           class="btn btn-outline-info btn-sm"
                                                                           data-toggle="modal"
                                                                           data-target="#edit{{ $list_Sections->id }}">{{ trans('site.edit') }}</a>
                                                                        <a href="#"
                                                                           class="btn btn-outline-danger btn-sm"
                                                                           data-toggle="modal"
                                                                           data-target="#delete{{ $list_Sections->id }}">{{ trans('site.delete') }}</a>
                                                                    </td>
                                                                </tr>


{{--                                                                <!--تعديل قسم جديد -->--}}
                                                                <div class="modal fade"
                                                                     id="edit{{ $list_Sections->id }}"
                                                                     tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    style="font-family: 'Cairo', sans-serif;"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('site.edit_Section') }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <form
                                                                                    action="{{ route('section.update',$list_Sections->id) }}"
                                                                                    method="POST">
                                                                                    {{ method_field('patch') }}
                                                                                    {{ csrf_field() }}
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <input type="text"
                                                                                                   name="Name_Section_Ar"
                                                                                                   class="form-control"
                                                                                                   value="{{ $list_Sections->getTranslation('section_name', 'ar') }}">
                                                                                        </div>

                                                                                        <div class="col">
                                                                                            <input type="text"
                                                                                                   name="Name_Section_En"
                                                                                                   class="form-control"
                                                                                                   value="{{ $list_Sections->getTranslation('section_name', 'en') }}">
                                                                                            <input id="id"
                                                                                                   type="hidden"
                                                                                                   name="id"
                                                                                                   class="form-control"
                                                                                                   value="{{ $list_Sections->id }}">
                                                                                        </div>

                                                                                    </div>
                                                                                    <br>


                                                                                    <div class="col">
                                                                                        <label for="inputName"
                                                                                               class="control-label">{{ trans('site.Name_Grade') }}</label>
                                                                                        <select name="Grade_id"
                                                                                                class="custom-select"
                                                                                                onclick="console.log($(this).val())">
                                                                                            <!--placeholder-->
                                                                                            <option
                                                                                                value="{{ $Grade->id }}">
                                                                                                {{ $Grade->name }}
                                                                                            </option>
                                                                                            @foreach ($list_grads as $list_Grade)
                                                                                                <option
                                                                                                    value="{{ $list_Grade->id }}">
                                                                                                    {{ $list_Grade->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>

                                                                                    <div class="col">
                                                                                        <label for="inputName"
                                                                                               class="control-label">{{ trans('site.Name_Class') }}</label>
                                                                                        <select name="Class_id"
                                                                                                class="custom-select">
                                                                                            <option
                                                                                                value="{{ $list_Sections->classroom->id }}">
                                                                                                {{ $list_Sections->classroom->class_name }}
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>

                                                                                    <div class="col">
                                                                                        <div class="form-check">

                                                                                            @if ($list_Sections->Status === 1)
                                                                                                <input
                                                                                                    type="checkbox"
                                                                                                    checked
                                                                                                    class="form-check-input"
                                                                                                    name="Status"
                                                                                                    id="exampleCheck1">
                                                                                            @else
                                                                                                <input
                                                                                                    type="checkbox"
                                                                                                    class="form-check-input"
                                                                                                    name="Status"
                                                                                                    id="exampleCheck1">
                                                                                            @endif
                                                                                            <label
                                                                                                class="form-check-label"
                                                                                                for="exampleCheck1">{{ trans('site.Status') }}</label>
                                                                                        </div>
                                                                                    </div>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('site.Close') }}</button>
                                                                                <button type="submit"
                                                                                        class="btn btn-danger">{{ trans('site.Save') }}</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- delete_modal_Grade -->
                                                                <div class="modal fade"
                                                                     id="delete{{ $list_Sections->id }}"
                                                                     tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                    class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('site.delete_Section') }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('section.destroy',$list_Sections->id) }}"
                                                                                    method="post">
                                                                                    {{ method_field('Delete') }}
                                                                                    @csrf
                                                                                    {{ trans('site.are you sure') }}
                                                                                    <input id="id" type="hidden"
                                                                                           name="id"
                                                                                           class="form-control"
                                                                                           value="{{ $list_Sections->id }}">
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('site.Close') }}</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">{{ trans('site.Save') }}</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>




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

                <!--اضافة قسم جديد -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                    id="exampleModalLabel">
                                    {{ trans('site.add_section') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('section.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="Name_Section_Ar" class="form-control"
                                                   placeholder="{{ trans('site.Section_name_ar') }}">
                                        </div>

                                        <div class="col">
                                            <input type="text" name="Name_Section_En" class="form-control"
                                                   placeholder="{{ trans('site.Section_name_en') }}">
                                        </div>

                                    </div>
                                    <br>


                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ trans('site.Name_Grade') }}</label>
                                        <select name="Grade_id" class="custom-select"
                                                onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="" selected
                                                    disabled>{{ trans('site.Select_Grade') }}
                                            </option>
                                            @foreach ($list_grads as $list_Grade)
                                                <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ trans('site.Name_Class') }}</label>
                                        <select name="Class_id" class="custom-select">
                                        </select>
                                    </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('site.Close') }}</button>
                                <button type="submit"
                                        class="btn btn-danger">{{ trans('site.Save') }}</button>
                            </div>
                            </form>
                        </div>
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
