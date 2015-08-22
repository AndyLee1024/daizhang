@extends('layouts.master')

@section('title', '添加联系人')
@section('customer', 'active')

@section('nav', '联系人')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">添加联系人信息</h4>
            </div>
            <div class="panel-body">
                <form action="{{action('ContactController@postCreateContact', $customer_id)}}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label for="name">联系人名称</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="请输入联系人名称">
                    </div>
                    <div class="form-group">
                        <label for="post">职位</label>
                        <input type="text" name="post" class="form-control" id="post" placeholder="请输入职位">
                    </div>

                    <div class="form-group">
                        <label for="mobile">手机号</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="请输入手机号码">
                    </div>


                    <div class="form-group">
                        <label for="email">电邮</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="请输入电邮">
                    </div>

                    <div class="form-group">
                        <label for="remarks">备注</label>
                        <textarea name="remarks" class="form-control" id="remarks"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
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