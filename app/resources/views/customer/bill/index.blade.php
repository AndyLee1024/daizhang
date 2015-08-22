
@extends('layouts.master')

@section('customer', 'active')

@section('title', '待收款')

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

                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                            <div class="panel-heading">
                                @if( Request::input('type') == 'cycle')
                                    <span class="panel-title">周期收款列表</span>
                                    <a href="{{action('CompanyBillController@toAddCycleBill',$customer_id)}}" class="btn btn-line-info btn-icon-inline waves-effect" style="float: right;"><i class="ion fa fa-plus"></i>新增周期收款</a>
                                @else
                                    <span class="panel-title">待收款列表</span>
                                    <a href="{{action('CompanyBillController@toAddBill',$customer_id)}}" class="btn btn-line-info btn-icon-inline waves-effect" style="float: right;"><i class="ion fa fa-plus"></i>新增待收款项</a>

                                @endif
                            </div>

                            <div class="panel-body">
                                <ul class="nav nav-pills">
                                    <li class="@if(Request::input('type') == null or Request::input('type') == 'normal') active @endif">
                                        <a href="{{action('CompanyBillController@getAllBills',$customer_id)}}?type=normal">待收款项</a>
                                    </li>
                                    <li class="@if(Request::input('type') == 'cycle') active @endif">
                                        <a href="{{action('CompanyBillController@getAllBills',$customer_id)}}?type=cycle">周期款项</a>
                                    </li>
                                </ul>
                                @if(Request::input('type') == null or Request::input('type') == 'normal')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="col-sm-3">收款项目</th>
                                        <th>金额</th>
                                        <th>收款/开票</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bills as $bill)
                                        <tr>
                                            <td>{{{$bill->item}}}</td>
                                            <td>
                                                <p>应收：¥{{{$bill->grand_total}}}</p>
                                                <p>实收：¥{{{$bill->amount_tendered}}}</p>
                                            </td>
                                            <td>
                                                <p>收款：@if($bill->is_paid==\App\CompanyBill::IS_PAID_NO)<span class='label label-danger'>否</span>@else<span class='label label-success'>是</span>@endif</p>
                                                <p>开票：@if($bill->is_invoice==\App\CompanyBill::IS_INVOICE_NO)<span class='label label-danger'>否</span>@else<span class='label label-success'>是</span>@endif</p>
                                            </td>
                                            <td>
                                                @if($bill->is_paid==\App\CompanyBill::IS_PAID_NO)
                                                    <a class="label label-primary" href="{{action('CompanyBillController@toPayBill',[$customer_id,$bill->id])}}">收款</a>
                                                @endif
                                                @if($bill->is_paid==\App\CompanyBill::IS_PAID_YES and $bill->is_invoice==\App\CompanyBill::IS_INVOICE_NO)
                                                    <a class="label label-success" href="{{{action('CompanyBillController@doInvoice',[$customer_id,$bill->id])}}}">开票</a>
                                                @endif
                                                @if($bill->is_paid==\App\CompanyBill::IS_PAID_NO)
                                                    <a class="label label-info" href="{{action('CompanyBillController@updateBill',[$customer_id,$bill->id])}}">编辑</a>
                                                    <a class="label label-danger"  href="{{action('CompanyBillController@deleteBill',[$customer_id,$bill->id])}}"
                                                       onclick="return confirm('确认删除收款项？')">删除</a>
                                                @else
                                                    <a class="label label-info detail" href="javascript:void(0);" data-item="{{$bill->item}}" data-remarks="{{$bill->remarks}}" data-grandtotal="{{$bill->grand_total}}" data-amounttendered="{{$bill->amount_tendered}}" data-isinvoice="{{$bill->is_invoice}}" data-paiddate="{{$bill->paid_date->format('Y-m-d')}}" data-deadline="{{$bill->deadline->format('Y-m-d')}}"> 查看</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                               @endif
                                @if( Request::input('type') == 'cycle')
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>周期收款项目</th>
                                            <th>金额</th>
                                            <th>周期</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bills as $cycleBill)
                                            <tr>
                                                <td>{{{$cycleBill->item}}}</td>
                                                <td>¥{{{$cycleBill->grand_total}}}</td>
                                                <td>{{{$cycleBill->getRuleDescription()}}}</td>
                                                <td>
                                                    <a class="label label-info" href="{{action('CompanyBillController@updateCycleBill',[$customer_id,$cycleBill->id])}}">编辑</a>
                                                    <a class="label label-danger" href="{{action('CompanyBillController@deleteCycleBill',[$customer_id,$cycleBill->id])}}"
                                                       onclick="return confirm('删除周期收款项目将会连带删除今天后的所有关联未付款项，是否确认删除？')">删除</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- #end row -->
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>



    <div id="detailModal" class="modal fade in" tabindex="-1" role="dialog" style="display: none;" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">收款详细信息</h4>
                </div>
                <div class="modal-body">
                    <p><label class="control-label">项目名称： </label>  <span class="item"></span></p>
                    <p><label class="control-label">应付款：  </label>  ¥<span class="grandtotal"></span></p>
                    <p><label class="control-label">实付款：  </label>  ¥<span class="amounttendered"></span></p>
                    <p><label class="control-label">到期时间：</label>  <span class="deadline"></span></p>
                    <p><label class="control-label">收款时间：</label>  <span class="paiddate"></span></p>
                    <p><label class="control-label">是否开票：</label>  <span class="isinvoice"></span></p>
                    <p><label class="control-label">备注： </label>  <span class="remarks"></span></p>

                </div> <!-- / .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">

        $(document).ready(function () {

            $('.detail').click(function(){
                var grandtotal = $(this).data('grandtotal');
                var amounttendered = $(this).data('amounttendered');
                var isinvoice = $(this).data('isinvoice');
                if(isinvoice==1){
                    isinvoice="是";
                }else{
                    isinvoice="否";
                }
                var paiddate = $(this).data('paiddate');
                var deadline = $(this).data('deadline');
                var item = $(this).data('item');
                var remarks = $(this).data('remarks');
                $("#detailModal").find(".item").text(item);
                $("#detailModal").find(".grandtotal").text(grandtotal);
                $("#detailModal").find(".amounttendered").text(amounttendered);
                $("#detailModal").find(".isinvoice").text(isinvoice);
                $("#detailModal").find(".paiddate").text(paiddate);
                $("#detailModal").find(".deadline").text(deadline);
                $("#detailModal").find(".remarks").text(remarks);
                $("#detailModal").modal('show');
            });
        })
    </script>
@endsection


