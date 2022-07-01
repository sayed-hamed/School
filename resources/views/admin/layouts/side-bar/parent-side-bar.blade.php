<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('site.Dashboard')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('dashboard')}}">{{trans('site.Dashboard')}}</a> </li>
                        </ul>
                    </li>

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('site.School System')}}</li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('site.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{{route('grad.index')}}}">{{trans('site.Grad_list')}}</a></li>
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('site.classrooms')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classroom.index')}}">{{trans('site.list_classrooms')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item Charts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">{{trans('site.Sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('section.index')}}">{{trans('site.Sections')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{trans('site.students')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('students.index')}}">{{trans('site.List Students')}}</a> </li>
                            <li> <a href="{{route('students.create')}}">{{trans('site.add_student')}}</a> </li>
                            <li> <a href="{{route('promotion.index')}}">{{trans('site.student promotion')}}</a> </li>
                            <li> <a href="{{route('promotion.create')}}">{{trans('site.student magmt promotion')}}</a> </li>
                            <li> <a href="{{route('graduated.create')}}">{{trans('site.Add New Graduated')}}</a> </li>
                            <li> <a href="{{route('graduated.index')}}">{{trans('site.Graduated List')}}</a> </li>
                        </ul>
                    </li>

                    <!-- menu item Form-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">{{trans('site.Teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Form" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teachers.index')}}">{{trans('site.Teachers-List')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item table -->

                    <!-- menu font icon-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('site.parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('add-parent')}}">{{trans('site.parents_list')}}</a> </li>
                        </ul>
                    </li>



                    <!-- menu item Custom pages-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{trans('site.Fees')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('fee.index')}}">{{trans('site.School Fees')}}</a> </li>
                            <li> <a href="{{route('fee_invoices.index')}}">{{trans('site.invoices')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item Authentication-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('site.Attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attandence.index')}}">{{trans('site.List Students')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subject">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('site.Subjects')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subject" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('subject.index')}}">{{trans('site.l_Subjects')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('site.Library')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('library.index')}}">{{trans('site.l_books')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#exam">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('site.Exams')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="exam" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('exam.index')}}">{{trans('site.l_Exams')}}</a> </li>
                            <li> <a href="{{route('question.index')}}">{{trans('site.l_Questions')}}</a> </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#online">
                            <div class="pull-left"><i class="ti-zoom-in"></i><span
                                    class="right-nav-text">{{trans('site.Online Meetings')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="online" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('meetings.index')}}">{{trans('site.Direct Meetings')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('setting.index')}}"><i class="fa fa-cogs"></i><span class="right-nav-text">{{trans('site.Settings')}} </span></a>
                    </li>


                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
