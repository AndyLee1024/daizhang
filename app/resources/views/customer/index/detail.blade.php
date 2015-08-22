@extends('layouts.master')

@section('customer', 'active')

@section('title', '客户管理')

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')
            <div class="row">
                <h3 class="customer-title">{{$company->name}}</h3>
            </div>

            <div class="row">
                <div class="col-md-2">
                    @include('layouts.customer_menu')
                </div>
                <div class="col-md-10">
                    <div class="panel panel-default mb20">
                        <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="col-md-4">
                                                <div class="md-input-container">
                                                    <input value="{{$company->full_name}}" type="text" name="full_name" class="md-input">
                                                    <label>公司全称</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="md-input-container">
                                                    <input value="{{$company->name}}" type="text" name="name" class="md-input">
                                                    <label>公司简称</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="md-input-container">
                                                    <input value="{{$company->leader}}" type="text" name="leader" class="md-input">
                                                    <label>法人</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="md-input-container">
                                                    <input value="{{$company->registed_funds}} 万 {{$company->funds_type}}" type="text" name="registed_funds" class="md-input">
                                                    <label>注册资本</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 clearfix">
                                            <div class="md-input-container">
                                                <input value="{{$company->scope}}" name="scope" type="text" class="md-input" >
                                                <label>经营范围</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 clearfix">
                                            <div class="md-input-container">
                                                <input value="{{$company->location}}" name="location" type="text" class="md-input" >
                                                <label>注册地址</label>
                                            </div>
                                        </div>

                                        <div class="clearfix">

                                            <div class="col-md-4">
                                                <div class="md-input-container">
                                                    <input value="{{$company->register_number}}" type="text" name="register_number" class="md-input">
                                                    <label>工商注册号</label>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="md-input-container">
                                                    <input value="{{date('Y-m-d',$company->register_time)}}" type="text" name="register_time" class="md-input">
                                                    <label>注册时间</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="md-input-container">
                                                    <input value="{{date('Y-m-d',$company->end_time)}}" type="text" name="end_time" class="md-input">
                                                    <label>过期时间</label>
                                                </div>
                                            </div>
                                        </div>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default panel-hovered panel-stacked mb20">
                                <div class="panel-heading">证照信息</div>
                                <div class="panel-body">
                                    <ul>
                                        @foreach($result as $k => $v)
                                            <li>{{$k}} @if($v=='exist')
                                                    <i class="fa fa-check"></i>
                                                @else
                                                    <i class="fa fa-close"></i>
                                                @endif</li>
                                        @endforeach
                                        {{--<li>Lorem ipsum dolor sit amet consector adipsi.</li>--}}
                                        {{--<li>Nulla volutpat aliquam velit kim seio lecti.</li>--}}
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default panel-hovered panel-stacked mb20">
                                <div class="panel-heading">联系人</div>
                                <div class="panel-body">
                                    @if(!empty($contact))
                                        <table class="table">
                                             <tr>
                                                <th scope="row">姓名</th>
                                                <td>{{$contact->name}}</td>

                                            </tr>
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
                                         </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default panel-hovered panel-stacked mb20">
                                <div class="panel-heading">待办事项</div>
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
            </div>
            <!-- #end row -->
        </div>
        <!-- #end page-wrap -->
    </div>
@endsection