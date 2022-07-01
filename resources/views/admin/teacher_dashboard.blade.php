<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>{{trans('site.School')}}</title>
    @include('admin.layouts.head')

</head>

<body>

<div class="wrapper">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="assets/images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
preloader -->

@include('admin.layouts.main-header')

@include('admin.layouts.main-sidebar')

<!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> مرحبا بك : {{auth()->user()->name}}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">عدد الاقسام</p>
                                <h4>{{$tsc}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> <a href="{{route('sec.index')}}">عرض الاقسام</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">عدد الطلاب</p>
                                <h4>{{$stcount}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> <a href="{{route('std.index')}}">عرض الطلاب</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Orders Status widgets-->
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="tab nav-border" style="position: relative;">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block w-100">
                                    <h5 class="card-title">العمليات الاخيرة علي النظام</h5>
                                </div>
                                <div class="d-block d-md-flex nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="months-tab" data-toggle="tab"
                                               href="#months" role="tab" aria-controls="months"
                                               aria-selected="true"> الطلاب</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="year-tab" data-toggle="tab" href="#year"
                                               role="tab" aria-controls="year" aria-selected="false">المعلمين
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="year-tab" data-toggle="tab" href="#parent"
                                               role="tab" aria-controls="year" aria-selected="false">اولياء الامور
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="months" role="tabpanel"
                                     aria-labelledby="months-tab">

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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(App\Models\Student::latest()->take(10)->get() as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->class_name}}</td>
                                                <td>{{$student->section->section_name}}</td>

                                            </tr>
                                        </tbody>

                                        @endforeach

                                    </table>



                                </div>
                                <div class="tab-pane fade" id="year" role="tabpanel" aria-labelledby="year-tab">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('site.Name_Teacher')}}</th>
                                            <th>{{trans('site.Gender')}}</th>
                                            <th>{{trans('site.Joining_Date')}}</th>
                                            <th>{{trans('site.specialization')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach(\App\Models\Teacher::latest()->take(10)->get() as $Teacher)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$Teacher->name}}</td>
                                                <td>{{$Teacher->gend->name}}</td>
                                                <td>{{$Teacher->joining_data}}</td>
                                                <td>{{$Teacher->special->name}}</td>

                                            </tr>
                                        @endforeach
                                    </table>

                                </div>

                                <div class="tab-pane fade" id="parent" role="tabpanel" aria-labelledby="year-tab">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="table-success">
                                            <th>#</th>
                                            <th>{{ trans('site.Email') }}</th>
                                            <th>{{ trans('site.Name_Father') }}</th>
                                            <th>{{ trans('site.National_ID_Father') }}</th>
                                            <th>{{ trans('site.Passport_ID_Father') }}</th>
                                            <th>{{ trans('site.Phone_Father') }}</th>
                                            <th>{{ trans('site.Job_Father') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach (\App\Models\My_Parent::latest()->take(10)->get() as $my_parent)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $my_parent->Email }}</td>
                                                <td>{{ $my_parent->Name_Father }}</td>
                                                <td>{{ $my_parent->National_ID_Father }}</td>
                                                <td>{{ $my_parent->Passport_ID_Father }}</td>
                                                <td>{{ $my_parent->Phone_Father }}</td>
                                                <td>{{ $my_parent->Job_Father }}</td>
                                            </tr>
                                        @endforeach
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <livewire:calendar />

        <!--=================================wrapper -->

        <!--=================================footer -->

        @include('admin.layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('admin.layouts.footer-scripts')

</body>

</html>
