@extends('layouts.master')

@section('customer', 'active')

@section('css_link')
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/select2.css')}}">
@endsection

@section('title', '创建账号密码')

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')

            <div class="row">
                <h3 class="customer-title">{{$customer->name}}</h3>
            </div>

            <div class="row">
                <div class="col-md-2">
                    @include('layouts.customer_menu')
                </div>
                <div class="col-md-8">

                    <div class="panel panel-default panel-hovered panel-stacked mb30">
                        <div class="panel-heading">新增账号密码 </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="site_name" class="col-sm-2 control-label">网站名称</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="site_name" id="site_name" placeholder="请输入网站名称">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">用户名称</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  name="username" id="username" placeholder="请输入用户名称">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">登录密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control"  name="password" id="password" placeholder="请输入登录密码">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-info waves-effect make_password">生成随机密码</button>
                                        {{--<input type="button" class="btn btn-default " value="生成随机密码">--}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="account_type" class="col-sm-2 control-label">登录类型</label>
                                    <div class="col-sm-3">
                                        <select name="account_type" id="account_type" class="form-control">
                                            @foreach(Config::get('customer.company_account_type') as $k))
                                            <option value="{{$k}}">{{$k}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_url" class="col-sm-2 control-label">网址</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"  name="site_url" id="site_url" placeholder="请输入登录网址">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="remarks" class="col-sm-2 control-label">备注</label>
                                    <div class="col-sm-7">
                                        <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">提交</button>
                                    </div>
                                </div>
                            </form>
                            {{--<form role="form" class="form-horizontal"  method="post" action=""> <!-- form horizontal acts as a row -->--}}
                                {{--<!-- normal control -->--}}
                                {{--{!! csrf_field() !!}--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">股东姓名</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="partner_name" placeholder="请输入股东姓名" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<!-- with hint -->--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">出资额度</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="credits" class="form-control" placeholder="请输入出资额度">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">股东类型</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<select name="partner_type" class="form-control">--}}
                                            {{--<option value="0" selected disabled>请选择一个股东类型</option>--}}
                                            {{--<option value="境内中国公民">境内中国公民</option>--}}
                                            {{--<option value="全民所有制">全民所有制</option>--}}
                                            {{--<option value="有限公司">有限公司</option>--}}
                                            {{--<option value="股份有限公司">股份有限公司</option>--}}
                                            {{--<option value="外国企业">外国企业</option>--}}
                                            {{--<option value="其他">其他</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">职位</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<select name="post" id="post" class="form-control">--}}
                                            {{--<option value="0" selected disabled>请选择一个职位</option>--}}
                                            {{--<option value="董事长">董事长</option>--}}
                                            {{--<option value="董事">董事</option>--}}
                                            {{--<option value="总经理">总经理</option>--}}
                                            {{--<option value="监事">监事</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">证件类型</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<select name="certificate" id="certificate" class="form-control">--}}
                                            {{--<option value="身份证">身份证</option>--}}
                                            {{--<option value="营业执照">营业执照</option>--}}
                                            {{--<option value="注册证书">注册证书</option>--}}
                                            {{--<option value="港澳台胞证">港澳台胞证</option>--}}
                                            {{--<option value="其他">其他</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<!-- Disabled control -->--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">证件号码</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="certificate_number" class="form-control" placeholder="请输入证件号码" >--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<!-- textarea control -->--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="col-md-3 control-label">备注</label>--}}
                                {{--<div class="col-md-9">--}}
                                {{--<textarea rows="5" class="form-control resize-v" name="remarks" placeholder="请输入备注"></textarea>--}}
                                {{--</div>--}}
                                {{--</div>--}}


                                {{--<div class="clearfix right">--}}
                                    {{--<button class="btn btn-primary mr5 waves-effect" type="submit">提交</button>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        </div>

                    </div>
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/scripts/plugins/select2.min.js')}}"></script>

    <script type="text/javascript">

        function makePassword(number)
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < number; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }


        function mt_rand(min, max) {
            var argc = arguments.length;
            if (argc === 0) {
                min = 0;
                max = 2147483647;
            } else if (argc === 1) {
                throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
            } else {
                min = parseInt(min, 10);
                max = parseInt(max, 10);
            }
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        $(document).ready(function () {

            $('.make_password').click(function(){

                var password = makePassword(mt_rand(9,16));
                $('input[name=password]').val('');
                $('input[name=password]').val(password);
                alert('您的随机密码是'+password);

            });
            });
    </script>
@endsection