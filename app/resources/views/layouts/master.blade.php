
<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="为 1200 万会计服务。">
    <meta name="author" content="Suzhou LXN Information Technology Co., Ltd.">
    <meta name="csrf-token" content="{{ csrf_token()}}" />
    <link href="http://daizhangtong.com/img/favicon.ico" rel="icon">

    <!-- <base href="/"> -->

    <title>@yield('title') - 代账通</title>

    <!-- Icons -->
    <link rel="stylesheet" href="{{ get_static('assets/fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ get_static('assets/fonts/font-awesome/css/font-awesome.min.css')}}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/c3.css')}}">
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/waves.css')}}">
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/perfect-scrollbar.css')}}">

    <!-- Css/Less Stylesheets -->
    <link rel="stylesheet" href="{{ get_static('assets/styles/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ get_static('assets/styles/main.min.css')}}">

    <link href='http://fonts.useso.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

    <!-- Match Media polyfill for IE9 -->
    <!--[if IE 9]> <script src="{{ get_static('assets/scripts/ie/matchMedia.js')}}"></script>  <![endif]-->
    @yield('css_link')

</head>
<body id="app" class="app off-canvas">

<!-- header -->
<header class="site-head" id="site-head">
    <ul class="list-unstyled left-elems">
        <!-- nav trigger/collapse -->
        <li>
            <a href="javascript:;" class="nav-trigger ion ion-drag"></a>
        </li>
        <!-- #end nav-trigger -->

        <!-- Search box -->
        <li>
            <div class="form-search hidden-xs">
                <form id="site-search" action="javascript:;">
                    <input type="search" class="form-control" placeholder="搜索客户...">
                    <button type="submit" class="ion ion-ios-search-strong"></button>
                </form>
            </div>
        </li>	<!-- #end search-box -->

        <!-- site-logo for mobile nav -->
        <li>
            <div class="site-logo visible-xs">
                <a href="javascript:;" class="text-uppercase h3">
                    <span class="text">代账通</span>
                </a>
            </div>
        </li> <!-- #end site-logo -->

        <!-- fullscreen -->
        <li class="fullscreen hidden-xs">
            <a href="javascript:;"><i class="ion ion-qr-scanner"></i></a>

        </li>	<!-- #end fullscreen -->

        <!-- notification drop -->
        <li class="notify-drop hidden-xs dropdown">
            <a href="javascript:;" data-toggle="dropdown">
                <i class="ion ion-speakerphone"></i>
                <span class="badge badge-danger badge-xs circle">1</span>
            </a>

            <div class="panel panel-default dropdown-menu">
                <div class="panel-heading">
                    您有 1 条新通知
                    <a href="javascript:;" class="right btn btn-xs btn-pink mt-3">全部</a>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="clearfix">
                            <a href="javascript:;">
                                <span class="ion ion-archive left bg-success"></span>
                                <div class="desc">
                                    <strong>全新的管理面板已上线</strong>
                                    <p class="small text-muted">1 分钟前</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </li>	<!-- #end notification drop -->

    </ul>

    <ul class="list-unstyled right-elems">
        <!-- profile drop -->
        <li class="profile-drop hidden-xs dropdown">
            <a href="javascript:;" data-toggle="dropdown">
                <img src="{{ auth()->user()->avatar }}" alt="admin-pic">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="javascript:;"><span class="ion ion-person">&nbsp;&nbsp;</span>资料</a></li>
                <li><a href="javascript:;"><span class="ion ion-settings">&nbsp;&nbsp;</span>设置</a></li>
                <li class="divider"></li>
                <li><a href="javascript:;"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>锁定屏幕</a></li>
                <li><a href="{{action('Auth\AuthController@getLogOut')}}"><span class="ion ion-power">&nbsp;&nbsp;</span>注销</a></li>
            </ul>
        </li>
        <!-- #end profile-drop -->

    </ul>

</header>
<!-- #end header -->

<!-- main-container -->
<div class="main-container clearfix nav-expand">
    <!-- main-navigation -->
    <aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
        <div class="nav-head">
            <!-- site logo -->
            <a href="{{action('HomeController@getHome')}}" class="site-logo text-uppercase">
                <img src="{{ get_static('assets/images/dzt_logo_white.png')}}" height="36px">
            </a>
        </div>

        <!-- Site nav (vertical) -->

        <nav class="site-nav clearfix" role="navigation">
            <div class="profile clearfix mb15">
                <img src="{{ auth()->user()->avatar }}" alt="admin">
                <div class="group">
                    <h5 class="name">{{auth()->user()->username}}</h5>
                    <small class="desig text-uppercase">超级管理员</small>
                </div>
            </div>

            <!-- navigation -->
            <ul class="list-unstyled clearfix nav-list mb15">
                <li class="@yield('dashboard')">
                    <a href="{{action('HomeController@getDashBoard')}}">
                        <i class="ion ion-monitor"></i>
                        <span class="text">总览</span>
                    </a>
                </li>
                <li class="@yield('customer')">
                    <a href="{{action('CustomerController@getIndex')}}">
                        <i class="ion fa fa-user"></i>
                        <span class="text">客户管理</span>
                    </a>
                </li>

                <li class="@yield('unpaid-bill')">
                    <a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}">
                        <i class="ion fa fa-rmb"></i>
                        <span class="text">收款管理</span>
                        <span class="badge badge-xs badge-primary">{{\App\CompanyBill::countUnpaidCompany(Session::get('company_id'))}}</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="ion fa fa-suitcase"></i>
                        <span class="text">业务管理</span>
                        <span class="badge badge-xs badge-purple">开发中</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="ion fa fa-file-text"></i>
                        <span class="text">备忘录</span>
                        <span class="badge badge-xs badge-purple">开发中</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="ion fa fa-thumbs-up"></i>
                        <span class="text">办事助手</span>
                        <span class="badge badge-xs badge-purple">开发中</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="ion fa fa-users"></i>
                        <span class="text">帐户与员工</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="ion fa fa-wechat"></i>
                        <span class="text">微信版</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="ion fa fa-question"></i>
                        <span class="text">帮助</span>
                    </a>
                </li>
            </ul> <!-- #end navigation -->
        </nav>

        <!-- nav-foot -->
        <footer class="nav-foot">
            <p>{{date('Y', time())}} &copy; <span>白羽软件</span></p>
        </footer>

    </aside>
    <!-- #end main-navigation -->

    <!-- content-here -->




    <div class="content-container nav-expand fixedHeader" id="content">
        @yield('content')
    </div>


</div> <!-- #end main-container -->

<!-- theme settings -->
<div class="site-settings clearfix hidden-xs">
    <div class="settings clearfix">
        <div class="trigger ion ion-settings left"></div>
        <div class="wrapper left">
            <ul class="list-unstyled other-settings">
                <li class="clearfix mb10">
                    <div class="left small">Nav Horizontal</div>
                    <div class="md-switch right">
                        <label>
                            <input type="checkbox" id="navHorizontal">
                            <span>&nbsp;</span>
                        </label>
                    </div>

                </li>
                <li class="clearfix mb10">
                    <div class="left small">Fixed Header</div>
                    <div class="md-switch right">
                        <label>
                            <input type="checkbox"  id="fixedHeader">
                            <span>&nbsp;</span>
                        </label>
                    </div>
                </li>
                <li class="clearfix mb10">
                    <div class="left small">Nav Full</div>
                    <div class="md-switch right">
                        <label>
                            <input type="checkbox"  id="navFull">
                            <span>&nbsp;</span>
                        </label>
                    </div>
                </li>
            </ul>
            <hr/>
            <ul class="themes list-unstyled" id="themeColor">
                <li data-theme="theme-zero" class="active"></li>
                <li data-theme="theme-one"></li>
                <li data-theme="theme-two"></li>
                <li data-theme="theme-three"></li>
                <li data-theme="theme-four"></li>
                <li data-theme="theme-five"></li>
                <li data-theme="theme-six"></li>
                <li data-theme="theme-seven"></li>
            </ul>
        </div>
    </div>
</div>
<!-- #end theme settings -->

<!-- Dev only -->
<!-- Vendors -->
<script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
<script src="{{ get_static('assets/scripts/vendors.js')}}"></script>
{{--<script src="{{ get_static('assets/scripts/plugins/d3.min.js')}}"></script>--}}
{{--<script src="{{ get_static('assets/scripts/plugins/c3.min.js')}}"></script>--}}
<script src="{{ get_static('assets/scripts/plugins/screenfull.js')}}"></script>
<script src="{{ get_static('assets/scripts/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{ get_static('assets/scripts/plugins/waves.min.js')}}"></script>
<script src="{{ get_static('assets/scripts/plugins/jquery.sparkline.min.js')}}"></script>
<script src="{{ get_static('assets/scripts/plugins/jquery.easypiechart.min.js')}}"></script>
<script src="{{ get_static('assets/scripts/plugins/bootstrap-rating.min.js')}}"></script>
<script src="{{ get_static('assets/scripts/app.js')}}"></script>
<script src="{{ get_static('assets/scripts/index.init.js')}}"></script>
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