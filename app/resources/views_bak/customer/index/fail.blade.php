@extends('layouts.master')

@section('title', '查询失败')
@section('customer', 'active')

@section('nav', '查询失败')

@section('content')

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">查询失败</h4>
            </div>
            <div class="panel-body">
                <ol>
                    <li> 在工商数据库中未能找到该公司。</li>
                    <li> 查询结果超过五个。</li>
                    <li> 目前工商数据库暂停服务。</li>
                </ol>
            </div>
        </div>

        <a href="{{action('CustomerController@getCreate')}}?mode=off" class="btn btn-primary">手动录入</a>
        <a href="{{action('CustomerController@getCreate')}}?mode=off" class="btn btn-primary">返回上一步</a>
    </div>
    <div class="col-md-3"></div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#new_company').click(function(){
                if($('.check_code').is(":visible")){
                    $('.check_code').hide(200);
                }else{
                    $('.check_code').show(200);
                }
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