


@extends('layouts.master')

@section('customer', 'active')

@section('title', '更新周期收款项')

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

                    <div class="panel panel-default panel-hovered panel-stacked mb30">
                        <div class="panel-heading">更新周期收款项</div>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal"  method="post" action=""> <!-- form horizontal acts as a row -->
                                <!-- normal control -->
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="item" class="col-sm-2 control-label">项目名称</label>

                                    <div class="col-md-4">
                                        <input type="text" id="item" name="item" class="form-control" placeholder="请键入项目名称"
                                               value="{{{$cycleBill->item}}}">
                                        <p class="help-block"><a class="fr_item" href="javascript:void(0)">代理记账服务费</a>  <a class="fr_item" href="javascript:void(0)">垫付费用</a>  <a class="fr_item" href="javascript:void(0)">交通费用</a></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="grand_total" class="col-sm-2 control-label">金额</label>

                                    <div class="col-md-4">
                                        <div class="input-group m-b-sm">

                                            <input type="text" id="grand_total" name="grand_total" class="form-control"
                                                   placeholder="金额"
                                                   value="{{{$cycleBill->grand_total}}}"
                                                    >
                                            <span class="input-group-addon" id="basic-addon-yuan">元</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="start_date" class="col-sm-2 control-label">开始时间</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control date-picker" id="start_date"
                                               name="start_date"
                                               placeholder="开始时间"
                                               value="{{{$cycleBill->start_date->format('Y-m-d')}}}"
                                                >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="rule" class="col-sm-2 control-label">周期</label>

                                    <div class="col-md-4">
                                        <select name="rule" id="rule" class="form-control m-b-sm">
                                            <option value="1m" {{{$cycleBill->rule=="1m"?"selected='selected'":""}}}>每月</option>
                                            <option value="3m" {{{$cycleBill->rule=="3m"?"selected='selected'":""}}}>每季度</option>
                                            <option value="12m" {{{$cycleBill->rule=="12m"?"selected='selected'":""}}}>每年</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">备注</label>

                                    <div class="col-md-4">
                                        <textarea cols="20" rows="4" class="form-control" name="remarks">{{{$cycleBill->remarks}}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-md-4">
                                        <button type="button" class="btn btn-default" onclick="history.back(-1);" style="margin-left: 20px;">取消</button>
                                        <button type="submit" class="btn btn-primary">更新收款周期</button>
                                    </div>
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
    <script src="{{ get_static('assets/scripts/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ get_static('assets/scripts/plugins/bootstrap-datepicker.zh-CN.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $('.date-picker').datepicker({
                orientation: "top auto",
                autoclose: true,
                language: 'zh-CN'
            });

            $('.fr_item').click(function(){
                $('#item').val($(this).text());
            });
        })
    </script>
@endsection

