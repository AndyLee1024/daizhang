@extends('layouts.master')

@section('title', '收款项')
@section('customer', 'active')

@section('nav', '编辑收款项')

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
                <h4 class="panel-title">编辑收款项</h4>
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="item" class="col-sm-2 control-label">项目名称</label>

                        <div class="col-md-4">
                            <input type="text" id="item" name="item" class="form-control" placeholder="请键入项目名称"
                                   value="{{{$bill->item }}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="grand_total" class="col-sm-2 control-label">金额</label>

                        <div class="col-md-4">
                            <div class="input-group m-b-sm">

                                <input type="text" id="grand_total" name="grand_total" class="form-control"
                                       placeholder="金额" value="{{{$bill->grand_total }}}">
                                <span class="input-group-addon" id="basic-addon-yuan">元</span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="deadline" class="col-sm-2 control-label">到期时间</label>

                        <div class="col-md-4">
                            <input type="text" class="form-control date-picker" id="deadline"
                                   name="deadline"
                                   placeholder="到期时间"
                                   value="{{$bill->deadline->format('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">备注</label>

                        <div class="col-md-4">
                            <textarea cols="20" rows="4" class="form-control" name="remarks">{{{$bill->remarks}}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-md-4">
                            <button type="button" class="btn btn-default" onclick="history.back(-1);" style="margin-left: 20px;">取消</button>
                            <button type="submit" class="btn btn-primary">更新收款项</button>
                            <input type="hidden" name="_token" value="{!! csrf_token()!!}">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}" type="text/javascript"></script>
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
