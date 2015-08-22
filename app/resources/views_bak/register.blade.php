
<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title> 注册产品 | {{Config::get('app.site_name')}} </title>

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
<body class="page-register">
<main class="page-content">
    <div class="page-inner">
        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-3 center">
                    <div class="login-box">
                        <a href="{{action('HomeController@getHome')}}" class="logo-name text-lg text-center">
                            <img src="{{ asset('assets/images/dzt_logo.png') }}" />
                        </a>
                        <p class="text-center m-t-md">创建一个代账通帐号</p>

                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{Session::get('error')}}
                        </div>
                        @endif

                        <form class="m-t-md" method="post" action="{{action('Auth\AuthController@postRegister')}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="phone" placeholder="手机号码" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn captcha btn-info">获取验证码</button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="captcha" placeholder="验证码" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="nickname" placeholder="昵称" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="secret" placeholder="密码" required>
                            </div>
                            <label>
                                <input type="checkbox"> 我已经阅读并且接受用户协议
                            </label>
                            <button type="submit" class="btn btn-success btn-block m-t-xs">提交</button>
                            <p class="text-center m-t-xs text-sm">已经拥有代账通账户?</p>
                            <a href="{{action('Auth\AuthController@getLogin')}}" class="btn btn-default btn-block m-t-xs">登录</a>
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
<script type="text/javascript">
    $(function(){

        $('.captcha').click(function(){
            var mobile = $('input[name=phone]').val();
            if(mobile == ''){
                alert('请填写手机号码');
                return false;
            }

            $.get('{{action("Auth\AuthController@getCaptcha")}}',{'mobile': mobile},function(data){
                if(data.message_code != 1){
                    alert(data.message)
                }else{
                    $('.captcha').html('发送成功');
                }
            })
        })

    });
</script>
</body>
</html>