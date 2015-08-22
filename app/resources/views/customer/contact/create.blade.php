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
                <div class="col-md-5">

                    <div class="panel panel-default panel-hovered panel-stacked mb30">
                        <div class="panel-heading">新增联系人</div>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal"  method="post" action=""> <!-- form horizontal acts as a row -->
                                <!-- normal control -->
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">联系人名称</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" placeholder="请输入联系人姓名" class="form-control">
                                    </div>
                                </div>

                                <!-- with hint -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">职位</label>
                                    <div class="col-md-9">
                                        <input type="text" name="post" class="form-control" placeholder="请输入职位">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">手机号</label>
                                    <div class="col-md-9">
                                        <input type="text" name="mobile" class="form-control" placeholder="请输入手机号">
                                    </div>
                                </div>

                                <!-- Disabled control -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">电子邮件</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" class="form-control" placeholder="请输入电子邮件" >
                                    </div>
                                </div>

                                <!-- textarea control -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">备注</label>
                                    <div class="col-md-9">
                                        <textarea rows="5" class="form-control resize-v" name="remarks" placeholder="请输入备注"></textarea>
                                    </div>
                                </div>


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