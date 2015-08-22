@extends('layouts.master')

@section('title', '账户与密码')
@section('customer', 'active')

@section('nav', '账户与密码')

@section('css_link')
    <link href="{{ get_static('assets/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">


        <div class="row">
            <div class="col-md-3">
                <a href="{{action('PasswordController@getCreatePassword', $customer_id)}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 添加登录</a>
            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">账户与密码</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="passwords" class="table display">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>平台名称</th>
                            <th>用户名</th>
                            <th>密码</th>
                            <th>类型</th>
                            <th>备注</th>
                            <th>操作</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach($passwords as $password)
                            <?php $i++; ?>
                            <tr>
                                <td scope="row">{{$i}}</td>
                                <td>
                                    <img src="{{$password->favicon_url}}" width="36px" height="36px" class="img-circle" alt="logo">
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
        {{--<div class="row">--}}
            {{--<div class="col-md-3">--}}
 {{----}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script src="{{ get_static('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $('.delete_password').click(function(){
                var cert_id = $(this).attr('data-rel');
                window.location.replace("{{action('PasswordController@getDeletePassword', $customer_id)}}?id="+cert_id);
            })

            $('#passwords').DataTable({
                "language": {
                    "lengthMenu": "每页显示 _MENU_ 条纪录",
                    "zeroRecords": "您还尚未添加纪录",
                    "info": "当前在第 _PAGE_ 页, 共 _PAGES_ 页",
                    "infoEmpty": "没有活动的纪录",
                    "loadingRecords": "读取中...",
                    "processing":     "处理中...",
                    "search":         "搜索:",
                    "paginate": {
                        "first":      "首页",
                        "last":       "末页",
                        "next":       "下一页",
                        "previous":   "上一页"
                    },
                    "infoFiltered": "(从 _MAX_ 条纪录中过滤)"
                }
            } );

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