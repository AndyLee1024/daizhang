@extends('layouts.master')

@section('customer', 'active')

@section('css_link')
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/select2.css')}}">
@endsection

@section('title', '编辑股东')

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
                <div class="col-md-5">

                    <div class="panel panel-default panel-hovered panel-stacked mb30">
                        <div class="panel-heading">编辑股东</div>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal"  method="post" action=""> <!-- form horizontal acts as a row -->
                                <!-- normal control -->
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">股东姓名</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{{$record->name}}}" name="partner_name" placeholder="请输入股东姓名" class="form-control">
                                    </div>
                                </div>

                                <!-- with hint -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">出资额度</label>
                                    <div class="col-md-9">
                                        <input type="text" name="credits" value="{{{$record->credits}}}" class="form-control" placeholder="请输入出资额度">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">股东类型</label>
                                    <div class="col-md-9">
                                        <select name="partner_type" class="form-control">
                                            <option value="0" selected disabled>请选择一个股东类型</option>
                                            <option @if($record->partner_type =='境内中国公民') selected @endif value="境内中国公民">境内中国公民</option>
                                            <option @if($record->partner_type =='全民所有制') selected @endif value="全民所有制">全民所有制</option>
                                            <option @if($record->partner_type =='有限公司') selected @endif value="有限公司">有限公司</option>
                                            <option @if($record->partner_type =='股份有限公司') selected @endif value="股份有限公司">股份有限公司</option>
                                            <option @if($record->partner_type =='外国企业') selected @endif value="外国企业">外国企业</option>
                                            <option @if($record->partner_type =='其他') selected @endif value="其他">其他</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">职位</label>
                                    <div class="col-md-9">
                                        <select name="post" id="post" class="form-control">
                                            <option value="0" selected disabled>请选择一个职位</option>
                                            <option @if($record->post =='董事长') selected @endif value="董事长">董事长</option>
                                            <option @if($record->post =='董事') selected @endif value="董事">董事</option>
                                            <option @if($record->post =='总经理') selected @endif value="总经理">总经理</option>
                                            <option @if($record->post =='监事') selected @endif value="监事">监事</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">证件类型</label>
                                    <div class="col-md-9">
                                        <select name="certificate" id="certificate" class="form-control">
                                            <option @if($record->certificate =='身份证') selected @endif value="身份证">身份证</option>
                                            <option @if($record->certificate =='营业执照') selected @endif value="营业执照">营业执照</option>
                                            <option @if($record->certificate =='注册证书') selected @endif  value="注册证书">注册证书</option>
                                            <option @if($record->certificate =='港澳台胞证') selected @endif  value="港澳台胞证">港澳台胞证</option>
                                            <option @if($record->certificate =='其他') selected @endif  value="其他">其他</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Disabled control -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">证件号码</label>
                                    <div class="col-md-9">
                                        <input type="text" name="certificate_number" value="{{{$record->certificate_number}}}"gut class="form-control" placeholder="请输入证件号码" >
                                    </div>
                                </div>

                                {{--<!-- textarea control -->--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="col-md-3 control-label">备注</label>--}}
                                {{--<div class="col-md-9">--}}
                                {{--<textarea rows="5" class="form-control resize-v" name="remarks" placeholder="请输入备注"></textarea>--}}
                                {{--</div>--}}
                                {{--</div>--}}


                                <div class="clearfix right">
                                    <button class="btn btn-primary mr5 waves-effect" type="submit">提交</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/scripts/plugins/select2.min.js')}}"></script>
@endsection