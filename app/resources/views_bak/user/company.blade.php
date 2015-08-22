@extends('layouts.master')

@section('title', '代账公司设置')

@section('nav', '代账公司设置')
@section('setting', 'active')

@section('css_link')
    <link href="{{ get_static('assets/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="col-md-2">
        @include('layouts.user_menu')
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h1 class="panel-title">{{$company->name}}                         <span class="label label-success">修改公司名称</span>
                        </h1>
                        <div class="panel-control">
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-collapse" data-original-title="Expand/Collapse"><i class="icon-arrow-down"></i></a>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-remove" data-original-title="Remove"><i class="icon-close"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>公司创建于 {{$company->created_at}}</p>
                        <p></p>
                        <p>当前套餐: @if($company->package_id == 0)免费版 <span class="label label-danger">升级套餐</span>@else 企业版 @endif</p>
                        <p>公司员工数量: {{$count}}人</p>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h1 class="panel-title">成员管理</h1>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="passwords" class="table display">
                                <thead>
                                <tr>
                                    <th>头像</th>
                                    <th>账号</th>
                                    <th>真实名称</th>
                                    <th>手机</th>
                                    <th>登录次数</th>
                                    <th>操作</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0;?>
                                @foreach($users as $user)
                                    <?php $i++; ?>
                                    <tr>
                                        <td scope="row">
                                            <div class="inbox-item-img"><img src="{{$user->user->avatar}}" width="40" height="40" class="img-circle" alt="{{$user->user->realname}}"></div>
                                        </td>
                                        <td>
                                            {{$user->user->username}}
                                        </td>
                                        <td>{{$user->user->realname}}</td>
                                        <td>{{$user->user->mobile}}</td>
                                        <td>10次</td>
                                        <td><a href="" class="btn btn-default" target="_blank">登录</a> <a class="btn btn-default" href="">编辑</a> <a data-toggle="modal" data-target="#myModal" class="btn btn-default" href="#">踢出团队</a></td>
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
                                                    <button type="button" class="btn btn-success delete_password" data-rel="{{$user->user->id}}">删除</button>
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
            </div>

        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script src="{{ get_static('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
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