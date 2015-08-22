@extends('layouts.master')

@section('title', '修改客户信息')
@section('customer', 'active')

@section('nav', '修改客户信息')

@section('css_link')
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="col-md-12">
        <form class="form-horizontal" method="post" action="">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">基本信息</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="full_name" class="col-sm-2 control-label">公司全称</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="{{$company->full_name}}" name="full_name" id="full_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input-help-block" class="col-sm-2 control-label">公司简称</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="name" value="{{$company->name}}" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="leader" class="col-sm-2 control-label">法人</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="leader" id="leader" value="{{$company->leader}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">详细地址</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="address" value="{{$company->location}}" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registion_type" class="col-sm-2 control-label">注册类型</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" value="{{$company->registion_type}}" name="registion_type" id="registion_type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registed_funds" class="col-sm-2 control-label">注册资本</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="registed_funds" value="{{$company->registed_funds}}" id="registed_funds">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registed_funds_type" class="col-sm-2 control-label">注册资本类型</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="默认为人民币，可以填入美元，人民币" name="registed_funds_type" value="{{$company->funds_type}}" id="registed_funds_type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register_time" class="col-sm-2 control-label">经营期限开始</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control date-picker" id="register_time" value="{{date('Y-m-d', $company->register_time)}}" name="register_time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end_time" class="col-sm-2 control-label">经营期限结束</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control date-picker" id="end_time" value="{{date('Y-m-d', $company->end_time)}}" name="end_time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register_number" class="col-sm-2 control-label">工商注册号</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="register_number" value="{{$company->register_number}}" name="register_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fanwei" class="col-sm-2 control-label">经营范围</label>
                        <div class="col-sm-10">
                            <textarea  class="form-control" id="fanwei" name="scope" >{{$company->scope}}</textarea>
                        </div>
                    </div>

                </div>
            </div>
    </div>

    <button type="submit" class="btn btn-primary">保存</button>

    </form>


@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
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