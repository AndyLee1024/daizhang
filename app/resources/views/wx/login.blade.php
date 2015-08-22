<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="为 1200 万会计服务。">
    <meta name="author" content="Suzhou LXN Information Technology Co., Ltd.">
    <!-- <base href="/"> -->

    <title>登录 - 代账通</title>

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
    <!--[if IE 9]>
    <script src="{{ get_static('scripts/ie/matchMedia.js')}}"></script>  <![endif]-->


</head>
<body id="app" class="app off-canvas body-full">

<div class="row">
    <form action="" class="panel form-horizontal form-bordered panel-primary">
        <div class="panel-heading  text-center">
            <h1 class="panel-title">登录代账通</h1>
        </div>
        <div class="panel-body form-horizontal ">
            <div class="form-group no-border-t">
                <label class="col-sm-4 control-label">手机</label>

                <div class="col-sm-8">
                    <input type="text" name="mobile" class="form-control">
                </div>
            </div>
            <div class="form-group panel-padding-h">
                <label class="col-sm-4 control-label">手机验证码</label>

                <div class="input-group col-sm-8">
                    <input type="text" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button">获取验证码</button>
							</span>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary btn-block">登录</button>
        </div>
    </form>
</div>

<!-- Dev only -->
<!-- Vendors -->
<script src="{{ get_static('assets/scripts/vendors.js')}}"></script>

</body>
</html>