@extends('layouts.master')

@section('title', '添加股东')
@section('customer', 'active')

@section('nav', '股东信息')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">添加股东信息</h4>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="partner_name">股东姓名</label>
                            <input type="text" name="partner_name" class="form-control" id="partner_name" placeholder="请输入股东姓名">
                        </div>
                        <div class="form-group">
                            <label for="credits">出资额度</label>
                            <input type="text" name="credits" class="form-control" id="credits" placeholder="请输入出资额度">
                        </div>
                        <div class="form-group">
                            <label for="partner_type">股东类型</label>
                            <select name="partner_type" id="partner_type" class="form-control m-b-sm">
                                <option value="境内中国公民">境内中国公民</option>
                                <option value="全民所有制">全民所有制</option>
                                <option value="有限公司">有限公司</option>
                                <option value="股份有限公司">股份有限公司</option>
                                <option value="外国企业">外国企业</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="post">职位</label>
                            <select name="post" id="post" class="form-control m-b-sm">
                                <option value="董事长">董事长</option>
                                <option value="董事">董事</option>
                                <option value="总经理">总经理</option>
                                <option value="监事">监事</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="certificate">证件类型</label>
                            <select name="certificate"  id="certificate" class="form-control m-b-sm">
                                <option value="身份证">身份证</option>
                                <option value="营业执照">营业执照</option>
                                <option value="注册证书">注册证书</option>
                                <option value="港澳台胞证">港澳台胞证</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="certificate_number">证件号码</label>
                            <input type="text" name="certificate_number" class="form-control" id="certificate_number" placeholder="请输入证件号码">
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