@extends('layouts.master')

@section('title', $company->name)
@section('customer', 'active')

@section('nav', $company->name.' 详细信息')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-white ui-sortable-handle">
                    <div class="panel-heading">
                        <h3 class="panel-title">基本信息</h3>
                        <div class="panel-control">
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-collapse" data-original-title="Expand/Collapse"><i class="icon-arrow-down"></i></a>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-remove" data-original-title="Remove"><i class="icon-close"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">

                                <tbody>
                                <tr>
                                    <th scope="row">公司全称</th>
                                    <td>{{{$company->full_name}}}</td>
                                    <td>公司简称</td>
                                    <td>{{{$company->name}}}</td>

                                </tr>
                                <tr>
                                    <th scope="row">注册资本</th>
                                    <td>{{{$company->registed_funds}}}万{{$company->funds_type}}</td>
                                    <td>成立时间</td>
                                    <td>{{{date('Y-m-d', $company->register_time)}}}</td>

                                </tr>
                                <tr>
                                    <th scope="row">住所地址</th>
                                    <td>{{{$company->location}}}</td>
                                    <td>法人</td>
                                    <td>{{{$company->leader}}}</td>

                                </tr>
                                <tr>
                                    <th scope="row">公司类型</th>
                                    <td>{{$company->registion_type}}</td>
                                    <td>工商注册号</td>
                                    <td>{{$company->register_number}}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <div class="panel panel-white ui-sortable-handle">
                    <div class="panel-heading">
                        <h3 class="panel-title">证件信息</h3>
                    </div>
                    <div class="panel-body">

                            @foreach($result as $k => $v)
                            <li>{{$k}} @if($v=='exist')
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="fa fa-close"></i>
                                @endif</li>
                            @endforeach
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="panel panel-white ui-sortable-handle">
                    <div class="panel-heading">
                        <h3 class="panel-title">联系人</h3>
                    </div>
                    <div class="panel-body">

                        @if(!empty($contact))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>姓名</th>
                                <th>{{$contact->name}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">职务</th>
                                <td>{{$contact->post}}</td>

                            </tr>
                            <tr>
                                <th scope="row">手机</th>
                                <td>{{$contact->mobile}}</td>

                            </tr>
                            <tr>
                                <th scope="row">电邮</th>
                                <td>
                                    <a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                            @endif

                    </div>
                </div>

            </div>


            <div class="col-md-4">

                <div class="panel panel-white ui-sortable-handle">
                    <div class="panel-heading">
                        <h3 class="panel-title">待办事项</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            @foreach($todo as $k=>$v)
                            <li>{{$v->todo_name}}</li>
                            @endforeach
                        </ul>
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