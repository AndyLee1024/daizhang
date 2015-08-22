@extends('layouts.master')

@section('customer', 'active')

@section('title', '联系人')

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

                        <a href="{{action('ContactController@getCreateContact', $customer_id)}}" class="btn btn-line-info btn-icon-inline waves-effect"><i class="ion fa fa-plus"></i>新增联系人</a>

                        <br/><br/>

                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                            <div class="panel-heading">

                                联系人列表
                            </div>
                            <div class="panel-body">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        {{--<th class="col-lg-1"><button type="button" class="btn btn-default btn-sm fa fa-trash waves-effect"></button></th>--}}
                                        <th>联系人</th>
                                        <th>职位</th>
                                        <th>手机号</th>
                                        <th>电邮</th>
                                        <th>默认联系人</th>
                                        <th>操作</th>
                                        {{--<th class="col-lg-2">Date</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($contacts as $contact)

                                        <tr>
                                        {{--<td>--}}
                                            {{--<div class="ui-checkbox ui-checkbox-primary ml5">--}}
                                                {{--<label><input type="checkbox"><span></span>--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                        <td>{{{$contact->name}}}</td>
                                        <td>{{{$contact->post}}}</td>
                                        <td>{{{$contact->mobile}}}</td>
                                        <td><a href="mailto:{{{$contact->email}}}">{{{$contact->email}}}</a></td>
                                        <td>
                                            @if($contact->is_default == 0)
                                                <span class="label label-info">否</span>
                                            @else
                                                <span class="label label-success">是</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="label label-success " href="{{action('ContactController@getSetDefaultContact', [$customer_id,$contact->id])}}" >设为默认</a>
                                            <a class="label label-info " href="{{action('ContactController@getModifyContact', [$customer_id,$contact->id])}}">编辑</a>
                                            <a class="label label-danger " href="{{action('ContactController@getDeleteContact', [$customer_id,$contact->id])}}">删除</a></td>
                                        {{--<td>--}}
                                            {{--<label class="label label-pink mr5">wordpress</label>--}}
                                            {{--<label class="label label-pink mr5">blog</label>--}}
                                        {{--</td>--}}
                                        {{--<td>20-3-2004</td>--}}
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