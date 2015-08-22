
<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title> @yield('title') | {{Config::get('app.site_name')}}</title>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Evolution" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Styles -->
    <link href='http://fonts.useso.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="{{ get_static('assets/plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
    <link href="{{ get_static('assets/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
    <link href="{{ get_static('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/line-icons/simple-line-icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/waves/waves.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/3d-bold-navigation/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/slidepushmenus/css/component.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Theme Styles -->
    <link href="{{ get_static('assets/css/modern.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>

    @yield('css_link')

    <script src="{{ get_static('assets/plugins/3d-bold-navigation/js/modernizr.js')}}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-header-fixed page-sidebar-fixed  compact-menu page-horizontal-bar">
<div class="overlay"></div>

{{--<form class="search-form" action="#" method="GET">--}}
    {{--<div class="input-group">--}}
        {{--<input type="text" name="search" class="form-control search-input" placeholder="Search...">--}}
                {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>--}}
                {{--</span>--}}
    {{--</div><!-- Input Group -->--}}
{{--</form><!-- Search Form -->--}}
<main class="page-content content-wrap">
    <div class="navbar">
        <div class="navbar-inner container">
            <div class="sidebar-pusher">
                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="logo-box">
                <a href="{{action('HomeController@getHome')}}" class="logo-text">
                  <img src="{{ asset('assets/images/dzt_logo.png') }}" />
                </a>
                {{--<span>{{Config::get('app.site_name')}}</span></a>--}}
            </div><!-- Logo Box -->

            <div class="topmenu-outer">
                <div class="top-menu">
                    <ul class="nav navbar-nav navbar-left">
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>--}}
                        {{--</li>--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-cogs"></i>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">--}}
                                {{--<li class="li-group">--}}
                                    {{--<ul class="list-unstyled">--}}
                                        {{--<li class="no-link" role="presentation">--}}
                                            {{--Fixed Header--}}
                                            {{--<div class="ios-switch pull-right switch-md">--}}
                                                {{--<input type="checkbox" class="js-switch pull-right fixed-header-check" checked>--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="li-group">--}}
                                    {{--<ul class="list-unstyled">--}}
                                        {{--<li class="no-link" role="presentation">--}}
                                            {{--Fixed Sidebar--}}
                                            {{--<div class="ios-switch pull-right switch-md">--}}
                                                {{--<input type="checkbox" class="js-switch pull-right fixed-sidebar-check">--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li class="no-link" role="presentation">--}}
                                            {{--Toggle Sidebar--}}
                                            {{--<div class="ios-switch pull-right switch-md">--}}
                                                {{--<input type="checkbox" class="js-switch pull-right toggle-sidebar-check">--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li class="no-link" role="presentation">--}}
                                            {{--Compact Menu--}}
                                            {{--<div class="ios-switch pull-right switch-md">--}}
                                                {{--<input type="checkbox" class="js-switch pull-right compact-menu-check" checked>--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="no-link"><button class="btn btn-default reset-options">Reset Options</button></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>--}}
                        {{--</li>--}}

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                <span class="user-name">{{{Auth::user()->username}}}<i class="fa fa-angle-down"></i></span>
                                <img class="img-circle avatar" src="{{ Auth::user()->avatar}}" width="40" height="40" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="#"><i class="fa fa-user"></i>个人资料</a></li>
                                @if(Session::has('company_id'))
                                <li role="presentation"><a href="{{action('CompanyController@getCompanyInfo')}}"><i class="fa fa-sitemap"></i>代账公司</a></li>
                                @endif
                                {{--<li role="presentation"><a href="#"><i class="fa fa-calendar"></i>Calendar</a></li>--}}
                                <li role="presentation"><a href="#"><i class="fa fa-envelope"></i>收件箱<span class="badge badge-success pull-right">4</span></a></li>
                                {{--<li role="presentation" class="divider"></li>--}}
                                <li role="presentation"><a href="#"><i class="fa fa-lock"></i>锁定屏幕</a></li>
                                <li role="presentation"><a href="{{action('Auth\AuthController@getLogOut')}}"><i class="fa fa-sign-out m-r-xs"></i>登出</a></li>
                            </ul>
                        </li>

                    </ul><!-- Nav -->
                </div><!-- Top Menu -->
            </div>
        </div>
    </div><!-- Navbar -->
    <div class="page-sidebar sidebar horizontal-bar">
        <div class="page-sidebar-inner">
            <ul class="menu accordion-menu">
                <li class="nav-heading"><span>Navigation</span></li>
                <li class="@yield('dashboard')"><a href="{{action('HomeController@getDashBoard')}}"><span class="menu-icon icon-speedometer"></span><p>概览</p></a></li>
                <li class="@yield('customer')"><a href="{{action('CustomerController@getIndex')}}"><span class="menu-icon icon-user"></span><p>客户</p><span class="arrow"></span></a>
                <li class="@yield('customer')"><a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}"><span class="menu-icon fa fa-money"></span><p>待收款</p><span class="arrow"></span></a>


                </li>
                <li class="@yield('setting')"><a href="{{action('CompanyController@getCompanyInfo')}}"><span class="menu-icon icon-grid"></span><p>设置</p><span class="arrow"></span></a>

                </li>
                <!--
                <li class="droplink"><a href="#"><span class="menu-icon icon-envelope-open"></span><p>收款</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li><a href="inbox.html">Inbox</a></li>
                        <li><a href="message-view.html">View Message</a></li>
                        <li><a href="compose.html">Compose</a></li>
                    </ul>
                </li>
                <li class="nav-heading"><span>Features</span></li>
                <li class="droplink"><a href="#"><span class="menu-icon icon-briefcase"></span><p>业务</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-icons.html">Icons</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-notifications.html">Notifications</a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                        <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-panels.html">Panels</a></li>
                        <li><a href="ui-progress.html">Progress Bars</a></li>
                        <li><a href="ui-sliders.html">Sliders</a></li>
                        <li><a href="ui-nestable.html">Nestable</a></li>
                        <li><a href="ui-tree-view.html">Tree View</a></li>
                    </ul>
                </li>
                <li class="droplink"><a href="#"><span class="menu-icon icon-layers"></span><p>帮助</p><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li class=""><a href="layout-blank.html">Blank Page</a></li>
                        <li><a href="layout-fixed-sidebar.html">Fixed Menu</a></li>
                        <li><a href="layout-static-header.html">Static Header</a></li>
                        <li><a href="layout-collapsed-sidebar.html">Collapsed Sidebar</a></li>
                        <li><a href="layout-large-menu.html">Large Menu</a></li>
                    </ul>
                </li>

                -->

            </ul>
        </div><!-- Page Sidebar Inner -->
    </div><!-- Page Sidebar -->
    <div class="page-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb container">
                <li><a href="{{action('HomeController@getHome')}}">{{Config::get('app.site_name')}}</a></li>
                @if(Session::has('company_id'))
                    <li><a href="#">{{get_company_name(Session::has('company_id'))}}</a></li>
                @endif
                <li class="active">@yield('nav')</li>
            </ol>
        </div>

        <div id="main-wrapper" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            @yield('content')
                         </div>
                    </div>
                </div>
            </div><!-- Row -->
        </div><!-- Main Wrapper -->
        <div class="page-footer">
            <div class="container">
                <p class="no-s">                            {{date('Y', time())}} &copy; Copyright 苏州白羽软件技术有限公司

                </p>
            </div>
        </div>
    </div><!-- Page Inner -->
</main><!-- Page Content -->
<nav class="cd-nav-container" id="cd-nav">
    <header>
        <h3>Navigation</h3>
        <a href="#0" class="cd-close-nav">Close</a>
    </header>
    <ul class="cd-nav list-unstyled">
        <li class="cd-selected" data-menu="index">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-home"></i>
                        </span>
                <p>Dashboard</p>
            </a>
        </li>
        <li data-menu="profile">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                <p>客户管理</p>
            </a>
        </li>
        <li data-menu="inbox">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                <p>Mailbox</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                <p>Tasks</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                <p>Settings</p>
            </a>
        </li>
        <li data-menu="calendar">
            <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                <p>Calendar</p>
            </a>
        </li>
    </ul>
</nav>
<div class="cd-overlay"></div>


<!-- Javascripts -->
<script src="{{ get_static('assets/plugins/jquery/jquery-2.1.3.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/pace-master/pace.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
<script src="{{ get_static('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/uniform/jquery.uniform.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/classie/classie.js')}}"></script>
<script src="{{ get_static('assets/plugins/waves/waves.min.js')}}"></script>
<script src="{{ get_static('assets/plugins/3d-bold-navigation/js/main.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('javascript')
</body>
</html>