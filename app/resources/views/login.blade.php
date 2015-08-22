<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>代账通 - 登录</title>
    <link rel="stylesheet" href="{{ get_static('assets/css/style.css')}}">
    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <link href="http://daizhangtong.com/img/favicon.ico" rel="icon">

</head>
<body>
<div class="wrapper">

    <div class="signup-logo">代账通</div>

    <div class="signup-wrap">
        <div class="signup-header">
            <h1>登录代账通</h1>
        </div>

        <div class="signup-body">

            <div class="signup-body-l signin-body-l">
                <form action="" method="post">
                    {!! csrf_field() !!}
                    <div class="form-row">
                        <input type="text" name="mobile" placeholder="手机号">
                    </div>
                    <div class="form-row @if(Session::has('error'))form-row-error @endif" >
                        <input type="password" name="password" placeholder="密码">
                        @if(Session::has('error'))
                            <p class="error-message">{{Session::get('error')}}</p>
                        @endif
                    </div>
                    <div class="form-row form-row-pw">
                        <label for="keepLogin" class="auto-login">
                            <input type="checkbox" id="remember_me" name="remember_me" checked="true">
                            记住密码
                        </label>
                        <label class="forgot-password">
                            <a href="#">忘记密码？</a>
                        </label>
                    </div>
                    <button class="btn" type="submit">登录</button>
                </form>
            </div>

            <div class="signup-body-r">
                <h4>还没有代账通账户?</h4>
                <a class="btn-outline" href="{{action('Auth\AuthController@getRegister')}}">点击这里注册</a>
                <img class="qr-img" src="{{ get_static('assets/img/dzt_qrcode.png')}}" alt="">
                <p>扫一扫，关注代账通微信版</p>
            </div>
        </div>

    </div>

    <div class="signup-copyright">
        2011-2015 © BaiYuSoft.Com. ALL Rights Reserved    苏ICP备11078079号-5
    </div>
</div>
</body>
</html>