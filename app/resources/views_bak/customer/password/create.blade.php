@extends('layouts.master')

@section('title', '添加账户')
@section('customer', 'active')

@section('nav', '账户与密码  /  添加账户')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">@yield('title')</h4>
                    </div>
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
                                    <input type="button" class="btn btn-default make_password" value="生成随机密码">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
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

            @if(Session::has('success'))
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 5000
                };
                toastr.success('{{Session::get('success')}}', '操作成功');
            }, 1800);
            @endif
             @if(Session::has('error'))
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 5000
                };
                toastr.error('{{Session::get('error')}}', '发生错误');
            }, 1800);
            @endif

        })
    </script>
@endsection