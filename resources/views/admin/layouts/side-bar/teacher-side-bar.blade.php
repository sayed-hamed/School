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
                            <li> <a href="{{route('teac-dash')}}">{{trans('site.Dashboard')}}</a> </li>
                        </ul>
                    </li>

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('site.School System')}}</li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table22">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{trans('site.Sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table22" class="collapse" data-parent="#sidebarnav">
                            <li> <a target="_blank" href="{{route('sec.index')}}">{{trans('site.Sections')}}</a> </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{trans('site.students')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a target="_blank" href="{{route('std.index')}}">{{trans('site.List Students')}}</a> </li>
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
                        <a href="{{route('setting.index')}}"><i class="fa fa-cogs"></i><span class="right-nav-text">{{trans('site.Settings')}} </span></a>
                    </li>



                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
