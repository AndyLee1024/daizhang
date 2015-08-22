@extends('layouts.master')

@section('title', '总览')

@section('dashboard', 'active')

@section('content')
    <!-- dashboard page -->
    <div class="page page-dashboard">

        <div class="page-wrap">

            <div class="row">
                <!-- dashboard header -->
                <div class="col-md-12">
                    <div class="dash-head clearfix mt15 mb20">
                        <div class="left">
                            <h4 class="mb5 text-light">欢迎使用</h4>
                            <p class="small">您正在使用一个<strong>开发中版本</strong>，期待您的反馈。</p>
                        </div>
                    </div>
                </div>
            </div> <!-- #end row -->

            <!-- mini boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default mb20 mini-box panel-hovered">
                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="info left">
                                    <h4 class="mt0 text-primary text-bold">{{$count}}</h4>
                                    <h5 class="text-light mb0">已有客户</h5>
                                </div>
                                <div class="right ion ion-ios-people-outline icon"></div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix panel-footer-sm panel-footer-primary">
                            <p class="mt0 mb0 left">今日新增 {{$new}} 家</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default mb20 mini-box panel-hovered">
                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="info left">
                                    <h4 class="mt0 text-bold"><a class="text-pink " href="{{action('CompanyBillController@getSummaryUnpaidBills')}}">¥{{\App\CompanyBill::sumAllUnpaidByUser(Session::get('company_id'))}}<a/></h4>
                                    <h5 class="text-light mb0">待收款项</h5>
                                </div>
                                <div class="right ion icon fa fa-rmb"></div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix panel-footer-sm panel-footer-pink">
                            <p class="mt0 mb0 left">本月已收 ¥{{\App\CompanyBill::sumCurrentMonthPaidByUser(Session::get('company_id'))}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default mb20 mini-box panel-hovered">
                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="info left">
                                    <h4 class="mt0 text-success text-bold">4</h4>
                                    <h5 class="text-light mb0">在办业务</h5>
                                </div>
                                <div class="right ion icon fa fa-tasks"></div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix panel-footer-sm panel-footer-success">
                            <p class="mt0 mb0 left">本月完结 3 件</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default mb20 mini-box panel-hovered">
                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="info left">
                                    <h4 class="mt0 text-info text-bold">{{$tasks}}</h4>
                                    <h5 class="text-light mb0">待办事项</h5>
                                </div>
                                <div class="right ion icon fa fa-check-square-o"></div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix panel-footer-sm panel-footer-info">
                            <p class="mt0 mb0 left">本月完成 {{$finish}} 项</p>
                        </div>
                    </div>
                </div>

                <!-- #end mini boxes -->
            </div> <!-- #end row -->

            <!-- row -->
            <div class="row">

                <!-- list widgets -->
                <div class="col-md-6 col-sm-12">
                    <div class="panel panel-default mb20 list-widget">
                        <div class="panel-heading">最近访问客户</div>
                        <ul class="list-unstyled clearfix">

                            @foreach($order as $k)
                            <li>
                                <a target="_blank" href="{{action('CustomerController@getCustomerCompanyInfo', $k->id)}}">
                                <i class="fa fa-file"></i>
                                <span class="text">{{$k->full_name}}</span>
                                <span class="badge badge-xs badge-primary right">{{mdate($k->last_active_time)}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- list widgets -->
                <div class="col-md-3 col-sm-12">
                    <div class="panel panel-default mb20 list-widget">
                        <div class="panel-heading">快捷访问</div>
                        <ul class="list-unstyled clearfix">
                            <li>
                                <i class="fa fa-file-o"></i>
                                <span class="text">全国工商信用年报系统</span>
                            </li>
                            <li>
                                <i class="fa fa-comments-o"></i>
                                <span class="text">江苏省地税局</span>
                            </li>
                            <li>
                                <i class="fa fa-bullhorn"></i>
                                <span class="text">江苏省国税局</span>
                            </li>
                            <li>
                                <i class="fa fa-hdd-o"></i>
                                <span class="text">苏州工业园区一站式服务中心</span>
                            </li>
                            <li>
                                <i class="fa fa-hdd-o"></i>
                                <span class="text">苏州工商联络人系统</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- list widgets -->
                <div class="col-md-3 col-sm-12">
                    <div class="panel panel-default mb20 list-widget">
                        <div class="panel-heading">使用配额</div>
                        <ul class="list-unstyled clearfix">
                            <li>
                                <i class="fa fa-file-o"></i>
                                <span class="text">文件数量</span>
                                <span class="badge badge-xs badge-primary right">100</span>
                            </li>
                            <li>
                                <i class="fa fa-database"></i>
                                <span class="text">已用空间</span>
                                <span class="badge badge-xs badge-info right">370MB/1GB</span>
                            </li>
                            <li>
                                <i class="fa fa-bullhorn"></i>
                                <span class="text">短信发送</span>
                                <span class="badge badge-xs badge-success right">22/100</span>
                            </li>
                            <li>
                                <i class="fa fa-hdd-o"></i>
                                <span class="text">已开通账户</span>
                                <span class="badge badge-xs badge-danger right">4/10</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div> <!-- #end row -->

        </div> <!-- #end page-wrap -->
    </div>
    <!-- #end dashboard page -->
@endsection