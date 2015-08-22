<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>代账通 - 注册</title>
    <link rel="stylesheet" href="{{ get_static('assets/css/style.css')}}">
    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <link href="http://daizhangtong.com/img/favicon.ico" rel="icon">
</head>
<body>
<div class="wrapper">

    <div class="signup-logo">代账通</div>

    <div class="signup-wrap">
        <div class="signup-header">
            <h1>创建一个代账通账号</h1>
        </div>

        <div class="signup-body">

            <div class="signup-body-l">
                <form action="" method="post">
                    {!! csrf_field() !!}

                    <div class="form-row">
                        <input type="text" name="phone" placeholder="手机号" required>
                    </div>
                    <div class="form-row form-row-qr">
                        <div class="form-row-l">
                            <input type="text" name="captcha"  required placeholder="验证码">
                        </div>
                        <div class="form-row-r @if(Session::get('error') == '短信验证码不正确') form-row-qr form-row-error @endif">
                            <button class="btn captcha">获取验证码</button>
                            @if(Session::get('error') == '短信验证码不正确')
                            <p class="error-message">验证码错误</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <input type="text" required name="nickname" placeholder="昵称">
                    </div>
                    <div class="form-row @if(Session::has('error') and Session::get('error') != '短信验证码不正确') form-row-error @endif">
                        <input type="password" name="secret" required placeholder="密码">
                        @if(Session::get('error') != '短信验证码不正确')
                        <p class="error-message">{{Session::get('error')}}</p>
                        @endif
                    </div>
                    <button class="btn" type="submit">创建账户</button>
                    <p class="tos">点击创建账户，表明你同意我们的<a href="">服务条款</a></p>
                </form>
            </div>

            <div class="signup-body-r">
                <h4>已经拥有代账通账户?</h4>
                <a class="btn-outline" href="{{action('Auth\AuthController@getLogin')}}">点击这里登录</a>
                <img class="qr-img" src="{{ get_static('assets/img/dzt_qrcode.png')}}" alt="代账通微信">
                <p>扫一扫，关注代账通微信版</p>
            </div>
        </div>

    </div>

    <div class="signup-copyright">
        2011-2015 © BaiYuSoft.Com. ALL Rights Reserved    苏ICP备11078079号-5
    </div>
</div>
</body>
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
</html>