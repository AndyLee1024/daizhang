
<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="为 1200 万会计服务。">
    <meta name="author" content="Suzhou LXN Information Technology Co., Ltd.">
    <!-- <base href="/"> -->

    <title>选择代账公司 - 代账通</title>

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
    <!--[if IE 9]> <script src="{{ get_static('scripts/ie/matchMedia.js')}}"></script>  <![endif]-->


</head>
<body id="app" class="app off-canvas body-full">

<!-- main-container -->
<div class="main-container clearfix">

    <!-- content-here -->
    <div class="content-container" id="content">
        <div class="page page-select-account">

            <div class="select-container panel mb20 panel-primary panel-hovered">
                <div class="panel-heading">选择代帐公司</div>
                <div class="panel-body">
                    @if(Session::has('error'))
                        <div class="alert alert-error">
                            <div>{{Session::get('error')}}</div>
                        </div>
                    @endif
                    <div class="alert alert-warning">
                        <div>欢迎，{{auth()->user()->username}}！请选择一个已加入的代帐公司，或创建一家新公司。</div>
                    </div>

                    <div class="list-group">
                        @if(!empty($record))
                            @foreach($record as $single)
                                <a href="{{action('HomeController@getSetCompany', $single->company->id)}}" class="list-group-item">
                                    {{{$single->company->name}}}
                                    {{--<span class="badge right badge-info">上次使用</span>--}}
                                    @if($single->company->registion_type == 'personal')
                                        <div class="clearfix"><label class="label label-primary">个人版</label></div>
                                    @else
                                        <div class="clearfix"><label class="label label-primary">企业版</label></div>
                                    @endif
                                </a>
                            @endforeach
                        @endif

                        <a href="{{action('HomeController@getCreateCompany')}}" class="list-group-item">
                            创建新的账户...
                        </a>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- #end content-container -->

</div> <!-- #end main-container -->

<!-- Dev only -->
<!-- Vendors -->
<script src="{{ get_static('assets/scripts/vendors.js')}}"></script>

</body>
</html>