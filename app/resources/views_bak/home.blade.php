@extends('layouts.master')

@section('title', '选择公司')
@section('dashboard', 'active')

@section('nav', '选择公司')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{action('HomeController@getCreateCompany')}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 创建代账公司</a>
        </div>
    </div>

    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        欢迎您 {{Auth::user()->username}}，选择需要登录的账户
    </div>

    @if(!empty($record))
    @foreach($record as $single)
    <div class="well well-sm">
        <h3><a href="{{action('HomeController@getSetCompany', $single->company->id)}}" target="_blank">{{{$single->company->name}}}</a></h3>
        <p>
            @if($single->company->registion_type == 'personal')
               <h4 class="text-center text-danger">个人版</h4>
            @else
                <h4 class="text-center text-danger">企业版</h4>
            @endif
        </p>
    </div>
    @endforeach
    @endif
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