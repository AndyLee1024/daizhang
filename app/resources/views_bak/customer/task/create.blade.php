@extends('layouts.master')

@section('title', '待办事项')
@section('customer', 'active')

@section('nav', '创建待办事项')

@section('css_link')
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">

        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">添加任务</h4>
            </div>
            <div class="panel-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="task_name">任务名称</label>
                        <input type="text" class="form-control" id="task_name" name="task_name" value="{{{$input}}}" placeholder="请键入任务名称">
                    </div>
                    <div class="form-group">
                        <label for="alert_time">到期时间</label>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control col-md-3 date-picker" id="alert_time" name="alert_time"
                                       placeholder="到期时间">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remarks">备注</label>
                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">创建任务</button>
                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                </form>
            </div>
        </div>

    </div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ get_static('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function () {

            $('.date-picker').datepicker({
                orientation: "top auto",
                autoclose: true,
                language: 'zh-CN'
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
