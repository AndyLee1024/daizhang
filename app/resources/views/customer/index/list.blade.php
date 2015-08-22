@extends('layouts.master')

@section('customer', 'active')

@section('title', '客户管理')

@section('content')
    <div class="page page-ui-tables">
        <ol class="breadcrumb breadcrumb-small">
            <li>首页</li>
            <li class="active"><a href="#">客户列表</a></li>
        </ol>

        <div class="page-wrap">
            <!-- row -->
            <div class="row">
                <!-- Basic Table -->
                <div class="col-md-12">

                    <a href="{{action('CustomerController@getCreate')}}" class="btn btn-line-info btn-icon-inline waves-effect"><i class="ion fa fa-plus"></i>新增客户</a>
                    <br/><br/>

                    <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                        <div class="panel-heading">
                            全部客户
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <a href="{{action('CustomerController@getIndex')}}">全部</a>
                                    @foreach(alphabeticaly() as $k=>$v)
                                        <a href="{{$v}}">{{$k}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>公司简称</th>
                                    <th>资料完成度</th>
                                    <th>首选联系人</th>
                                    <th>待申报税</th>
                                    <th>待收款项</th>
                                    <th class="col-lg-2">备注</th>
                                    <th>操作</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)

                                    <tr>

                                    <td><a href="{{action('CustomerController@getCustomerCompanyInfo', $company->id)}}">{{$company->name}}</a></td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-primary" style="width:55%"></div>
                                        </div>
                                    </td>
                                    <td>{{{$company->leader}}}</td>
                                    <td>
                                        国税 <label class="label label-danger mr5">{{$company->getTaxStatus()->where('guoshui_status', 0)->count()}}</label>
                                        地税 <label class="label label-pink mr5">{{$company->getTaxStatus()->where('dishui_status', 0)->count()}}</label>
                                    </td>
                                    <td>¥{{$company->sumAllUnpaidBill(Session::get('company_id'))}}({{$company->countUnpaidBill(Session::get('company_id'))}} 项)</td>
                                    <td>{{$company->remarks}}</td>
                                        <td><a class="label label-info" href="{{action('CustomerController@getModifyCompany',$company->id)}}" target="_blank">编辑</a> </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #end row -->
        </div> <!-- #end page-wrap -->
    </div>
@endsection