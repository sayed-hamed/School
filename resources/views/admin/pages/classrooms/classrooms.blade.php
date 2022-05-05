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

    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @include('admin.pages.errors')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModalScrollable">
                                {{trans('site.Add Class')}}
                            </button>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('site.class_name')}}</th>
                                <th>{{trans('site.Grad Name')}}</th>
                                <th>{{trans('site.processes')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($classrooms as $class)
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td>{{$class->class_name}}</td>
                                    <td>{{$class->Grads->name}}</td>
                                    <td>
                                        <a class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#edit{{$class->id}}"><i class="fa fa-edit" style="color: #ffffff"></i></a>
                                        <a class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#delete{{$class->id}}"><i class="fa fa-trash" style="color: #ffffff"></i></a>

                                    </td>
                                </tr>



{{--                    //edit modal--}}
                                <div class="modal fade" id="edit{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">{{trans('site.update Class')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('classroom.update','test')}}">
                                                    @csrf
                                                    {{@method_field('patch')}}

                                                    <input type="hidden" name="id" value="{{$class->id}}">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{trans('site.name_ar')}}</label>
                                                        <input type="text" value="{{$class->getTranslation('class_name','ar')}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{trans('site.name_ar')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">{{trans('site.name_en')}}</label>
                                                        <input type="text" value="{{$class->getTranslation('class_name','en')}}" name="name_en" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.name_en')}}">
                                                    </div>

                                                        <label for="Name_en"
                                                               class="mr-sm-2">{{ trans('site.Grad Name') }}
                                                        </label>

                                                        <div class="form-select">
                                                            <select class="fancyselect" name="Grade_id">
                                                                <option value="{{$class->Grads->id}}">{{$class->Grads->name}}</option>
                                                                @foreach ($grads as $Grade)
                                                                    <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.Close')}}</button>
                                                        <button type="submit" class="btn btn-success">{{trans('site.Save')}}</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

{{--                    //delete modal--}}

                                <div class="modal fade" id="delete{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">{{trans('site.Delete Grades')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('classroom.destroy','test')}}">
                                                    @csrf
                                                    {{@method_field('Delete')}}

                                                    {{trans('site.are you sure')}}

                                                    <input type="hidden" name="id" value="{{$class->id}}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.Close')}}</button>
                                                        <button type="submit" class="btn btn-success">{{trans('site.delete')}}</button>
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

    <!-- row closed -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{trans('site.Add Class')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>

                                        <div class="row">

                                            <div class="col">
                                                <label for="Name"
                                                       class="mr-sm-2">{{ trans('site.Classroom In Arabic') }}
                                                    </label>
                                                <input class="form-control" type="text" name="name"  />
                                            </div>


                                            <div class="col">
                                                <label for="Name"
                                                       class="mr-sm-2">{{ trans('site.Classroom In English') }}
                                                    </label>
                                                <input class="form-control" type="text" name="name_en"  />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en"
                                                       class="mr-sm-2">{{ trans('site.Grad Name') }}
                                                    </label>

                                                <div class="box">
                                                    <select class="fancyselect" name="Grade_id">
                                                        @foreach ($grads as $Grade)
                                                            <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                       class="mr-sm-2">{{ trans('site.processes') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block col-8" data-repeater-delete
                                                       type="button" value="{{ trans('site.delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('site.add_row') }}"/>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('site.Close') }}</button>
                                    <button type="submit"
                                            class="btn btn-success">{{ trans('site.Save') }}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
                </div>

            </div>
    </div>


@endsection
@section('js')

    @toastr_js
    @toastr_render
@endsection
