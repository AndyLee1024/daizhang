@extends('layouts.master')

@section('customer', 'active')

@section('title', '录入客户信息')

@section('css_link')
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/bootstrap-datepicker.css')}}">
@endsection

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')



            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-8">

                    <form class="form-horizontal" method="post" action="{{action('CustomerController@postCompanyDetail')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <div class="panel panel-white">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">基本信息</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="full_name" class="col-sm-2 control-label">公司全称</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" value="{{$input['company_name']}}" name="full_name" id="full_name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-help-block" class="col-sm-2 control-label">公司简称</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="name" value="{{$input['name']}}" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="leader" class="col-sm-2 control-label">法人</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="leader" id="leader" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">详细地址</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="registion_type" class="col-sm-2 control-label">注册类型</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="registion_type" id="registion_type">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="registed_funds" class="col-sm-2 control-label">注册资本</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="registed_funds" id="registed_funds">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="registed_funds_type" class="col-sm-2 control-label">注册资本类型</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="默认为人民币，可以填入美元，人民币" name="registed_funds_type" value="" id="registed_funds_type">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="register_time" class="col-sm-2 control-label">经营期限开始</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control date-picker" id="register_time" name="register_time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="end_time" class="col-sm-2 control-label">经营期限结束</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control date-picker" id="end_time" name="end_time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="register_number" class="col-sm-2 control-label">工商注册号</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="register_number" name="register_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fanwei" class="col-sm-2 control-label">经营范围</label>
                                    <div class="col-sm-10">
                                        <textarea  class="form-control" id="fanwei" name="scope" ></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-white">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">业务信息</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="contact" class="col-sm-2 control-label">联系人</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="contact" name="contact">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">联系人手机</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="mobile" name="mobile">
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="clearfix right">
                            <br/>
                            <button type="submit" class="btn btn-primary">保存</button>
                            {{--<button class="btn btn-default waves-effect">Cancel</button>--}}
                        </div>

                    </form>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/scripts/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ get_static('assets/scripts/plugins/locales/bootstrap-datepicker.zh-CN.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.date-picker').datepicker({
                orientation: "top auto",
                autoclose: true,
                language: 'zh-CN'
            });
        });
    </script>
@endsection