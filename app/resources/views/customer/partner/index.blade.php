@extends('layouts.master')

@section('customer', 'active')

@section('title', '股东')

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')

            <div class="row">
                <h3 class="customer-title">{{$customer->name}}</h3>
            </div>

            <div class="row">
                <div class="col-md-2">
                    @include('layouts.customer_menu')
                </div>
                <div class="col-md-10">

                    <div class="col-md-12">
                        <a href="{{action('PartnerController@getCreatePartner', $customer_id)}}" class="btn btn-line-info btn-icon-inline waves-effect"><i class="ion fa fa-plus"></i>新增股东</a>
                        <br/><br/>

                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                            <div class="panel-heading">

                                股东列表
                            </div>
                            <div class="panel-body">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        {{--<th class="col-lg-1"><button type="button" class="btn btn-default btn-sm fa fa-trash waves-effect"></button></th>--}}
                                        <th>股东</th>
                                        <th>股东类型</th>
                                        <th>出资额/比例</th>
                                        <th>职位</th>
                                        <th>证件</th>
                                        <th>证件号码</th>
                                        <th>操作</th>
                                        {{--<th class="col-lg-2">Date</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($partners as $partner)

                                        <tr>
                                            <td>{{{$partner->name}}}</td>
                                            <td>{{{$partner->partner_type}}}</td>
                                            <td>开发中</td>
                                            <td>{{$partner->post}}</td>
                                            <td>{{$partner->certificate}}</td>
                                            <td>{{{$partner->certificate_number}}}</td>
                                            <td><a class="label label-info " href="{{action('PartnerController@getModifyPartner', [$customer_id, $partner->id])}}">编辑 </a> <a class="label label-danger " href="{{action('PartnerController@getDeletePartner', [$customer_id,$partner->id])}}">删除</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- #end row -->
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection