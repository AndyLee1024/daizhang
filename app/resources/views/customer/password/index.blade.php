@extends('layouts.master')

@section('customer', 'active')

@section('title', '账号密码')

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
                <div class="col-md-10">

                    <div class="col-md-12">
                        <a href="{{action('PasswordController@getCreatePassword', $customer_id)}}" class="btn btn-line-info btn-icon-inline waves-effect"><i class="ion fa fa-plus"></i>新增账号密码</a>
                        <br/><br/>

                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                            <div class="panel-heading">

                                账号密码列表
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>平台名称</th>
                                        <th>用户名</th>
                                        <th>密码</th>
                                        <th>类型</th>
                                        <th>备注</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($passwords as $password)
                                         <tr>
                                             <td>
                                                <span class="user-name">{{{$password->site_name}}}</span>
                                            </td>
                                            <td>{{$password->login_name}}</td>
                                            <td id="decrypt_{{$password->id}}"><span class="decrypt" prefix="{{$password->id}}" data-rel="{{$password->password}}">查看密码</span></td>
                                            <td>{{$password->account_type}}</td>
                                            <td>{{$password->remarks}}</td>
                                            <td><a href="{{$password->site_url}}" class="btn btn-default" target="_blank">登录</a> <a class="btn btn-default" href="{{action('PasswordController@getModifyPassword', [$customer_id, $password->id])}}">编辑</a> <a data-toggle="modal" data-target="#myModal" class="btn btn-default" href="#">删除</a></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">系统提示</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        此操作不可恢复，你确定要删除此密码纪录吗?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                        <button type="button" class="btn btn-success delete_password" data-rel="{{$password->id}}">删除</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- #end row -->
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(function(){
            $('.delete_password').click(function(){
                var cert_id = $(this).attr('data-rel');
                window.location.replace("{{action('PasswordController@getDeletePassword', $customer_id)}}?id="+cert_id);
            });

            $('.decrypt').click(function(){
                var password = $(this).attr('data-rel');
                var password_id = $(this).attr('prefix');
                $.ajax({
                    url: '{{action('PasswordController@postDecryptHash', $customer_id)}}',
                    type: 'post',
                    dataType: 'json',
                    error: function(){
                        alert('发生错误');
                        return false;
                    },
                    success: function(data){
                        $('#decrypt_'+password_id).html(data.decrypt)
                    },
                    data: {password: password}
                })
            })
        })
    </script>
@endsection