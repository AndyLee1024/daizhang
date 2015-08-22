<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title> 登录 | {{ Config::get('app.site_name') }}</title>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link href='http://fonts.useso.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="{{ get_static('assets/plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
    <link href="{{ get_static('assets/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
    <link href="{{ get_static('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/line-icons/simple-line-icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/waves/waves.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/switchery/switchery.min.css')}}'" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/plugins/3d-bold-navigation/css/style.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Theme Styles -->
    <link href="{{ get_static('assets/css/modern.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ get_static('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>

    <script src="{{ get_static('assets/plugins/3d-bold-navigation/js/modernizr.js')}}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-login">
<main class="page-content">
    <div class="page-inner">
        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-3 center">
                    <div class="login-box">
                        <a href="{{action('HomeController@getHome')}}" class="logo-name text-lg text-center">                   <img src="{{ asset('assets/images/dzt_logo.png') }}" />
                        </a>
                        <p class="text-center m-t-md">请输入你的手机号码,密码进行登录</p>
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{Session::get('error')}}
                            </div>
                        @endif

                        <form class="m-t-md" action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="mobile" placeholder="手机号码" required>
                            </div>

                            <input name="_token" type="hidden" value="<?php echo csrf_token();?>">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="密码" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">登录</button>
                            <a href="forgot.html" class="display-block text-center m-t-md text-sm">忘记密码?</a>
                            <p class="text-center m-t-xs text-sm">第一次使用我们的产品?</p>
                            <a href="{{action('Auth\AuthController@getRegister')}}" class="btn btn-default btn-block m-t-md">创建一个账号</a>
                        </form>
                        <p class="text-center m-t-xs text-sm">
                            {{date('Y', time())}} &copy; Copyright 苏州白羽软件技术有限公司
                        </p>
                    </div>
                </div>
            </div><!-- Row -->
        </div><!-- Main Wrapper -->
    </div><!-- Page Inner -->
</main><!-- Page Content -->


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
<script src="{{ get_static('assets/js/modern.min.js')}}"></script>

</body>
</html>