@extends('layouts.master')

@section('title', '系统提示')

@section('nav', '系统提示')
@section('customer', 'active')


@section('content')
    <div class="panel panel-white" id="js-alerts">
        <div class="panel-heading clearfix">
            <h3 class="panel-title">系统提示</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>对不起</strong> 您的操作无法完成，原因: {{$message}}
            </div>

            <p>
                <a href="{{action('CustomerController@getCreate')}}" class="btn btn-danger">返回重新输入</a>
            </p>
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