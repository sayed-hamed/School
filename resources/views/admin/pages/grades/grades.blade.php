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
                <h4 class="mb-0"> {{trans('site.Grades')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('site.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('site.Grades')}}</li>
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
                                {{trans('site.Add Grades')}}
                            </button>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('site.name')}}</th>
                                <th>{{trans('site.notes')}}</th>
                                <th>{{trans('site.processes')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($grades as $grad)
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td>{{$grad->name}}</td>
                                    <td>{{$grad->notes}}</td>
                                    <td>
                                        <a class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#edit{{$grad->id}}"><i class="fa fa-edit" style="color: #ffffff"></i></a>
                                        <a class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#delete{{$grad->id}}"><i class="fa fa-trash" style="color: #ffffff"></i></a>

                                    </td>
                                </tr>





                                <div class="modal fade" id="edit{{$grad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">{{trans('site.Add Grades')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('grad.update','test')}}">
                                                    @csrf
                                                    {{@method_field('patch')}}

                                                    <input type="hidden" name="id" value="{{$grad->id}}">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{trans('site.name_ar')}}</label>
                                                        <input type="text" value="{{$grad->getTranslation('name','ar')}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{trans('site.name_ar')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">{{trans('site.name_en')}}</label>
                                                        <input type="text" value="{{$grad->getTranslation('name','en')}}" name="name_en" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.name_en')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">{{trans('site.notes_ar')}}</label>
                                                        <input type="text" name="notes" value="{{$grad->getTranslation('notes','ar')}}" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.notes')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">{{trans('site.notes_en')}}</label>
                                                        <input type="text" value="{{$grad->getTranslation('notes','en')}}" name="notes_en" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.notes')}}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.Close')}}</button>
                                                        <button type="submit" class="btn btn-success">{{trans('site.Save')}}</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{$grad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">{{trans('site.Delete Grades')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('grad.destroy','test')}}">
                                                    @csrf
                                                    {{@method_field('Delete')}}

                                                    {{trans('site.are you sure')}}

                                                    <input type="hidden" name="id" value="{{$grad->id}}">
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
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{trans('site.Add Grades')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('grad.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{trans('site.name_ar')}}</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{trans('site.name_ar')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{trans('site.name_en')}}</label>
                            <input type="text" name="name_en" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.name_en')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{trans('site.notes_ar')}}</label>
                            <input type="text" name="notes" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.notes')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{trans('site.notes_en')}}</label>
                            <input type="text" name="notes_en" class="form-control" id="exampleInputPassword1" placeholder="{{trans('site.notes')}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.Close')}}</button>
                            <button type="submit" class="btn btn-success">{{trans('site.Save')}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('js')

    @toastr_js
    @toastr_render
@endsection
