@extends('layouts.master')

@section('title', '代账公司设置')

@section('nav', '代账公司设置')
@section('setting', 'active')

@section('css_link')
    <link href="{{ get_static('assets/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="col-md-2">
        @include('layouts.user_menu')
    </div>
    <div class="col-md-10">

        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-success btn-block"><i class="fa fa-plus m-r-xs"></i>邀请成员</button>
            </div>
        </div>

        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="panel-title">公司成员</div>
                    </div>
                    <div class="panel-body">
                        <div class="team">
                            <div class="team-member">
                                <div class="online on"></div>
                                <img src="{{ get_static('assets/images/avatar1.png')}}" alt="">
                            </div>
                            <div class="team-member">
                                <div class="online off"></div>
                                <img src="{{ get_static('assets/images/avatar2.png')}}" alt="">
                            </div>
                            <div class="team-member">
                                <div class="online on"></div>
                                <img src="{{ get_static('assets/images/avatar3.png')}}" alt="">
                            </div>
                            <div class="team-member">
                                <div class="online on"></div>
                                <img src="{{ get_static('assets/images/avatar5.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
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