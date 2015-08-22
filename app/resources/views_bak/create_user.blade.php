@extends('layouts.master')

@section('title', '选择套餐')

@section('nav', '选择套餐')
@section('dashboard', 'active')

@section('content')
        <div class="col-sm-12 col-lg-6">

            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">个人版</h4>
                </div>
                <div class="panel-body">
                     <p class="text-center">

                         适用于独立会计与经纪人

                         限单用户使用

                         轻松管理我的客户与账单
                     </p>

                    <p class="">
                        <h3 class="text-center text-danger">免费</h3>
                    </p>

                </div>
            </div>

        </div>

        <div class="col-sm-12 col-lg-6">

            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">企业版</h4>
                </div>
                <div class="panel-body">
                    <p class="text-center">
                        适用于财务公司与事务所

                        多用户使用，不限用户数

                        业务协作与知识共享
                    </p>

                    <p class="">
                    <h3 class="text-center text-danger">1999RMB/年</h3>
                    </p>

                </div>
            </div>

        </div>

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-white">

                <div class="panel-body">
                    <form method="post" action="{{action('HomeController@postChooseType')}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">公司名称: </label>
                            <input type="text" name="company" class="form-control" id="exampleInputEmail1" placeholder="公司名称">
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token();?>" />
                        <input type="hidden" name="type" value="0" />
                        <div class="form-group">
                            <label for="exampleInputPassword1">联系电话: </label>
                            <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="联系电话">
                        </div>

                        <button type="submit" class="btn btn-primary">下一步</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>

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
                toastr.success('选择一个账户类型继续', '系统通知');
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
                toastr.error('{{Session::get('error')}}', '系统通知');
            }, 1800);
            @endif


        })
    </script>
@endsection