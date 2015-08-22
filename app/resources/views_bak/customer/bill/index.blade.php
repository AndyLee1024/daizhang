@extends('layouts.master')

@section('title', '账单')
@section('customer', 'active')

@section('nav', '账单')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">账单列表</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div style="float: right; margin-left: 100px;">
                        <a href="{{action('CompanyBillController@toAddBill',$customer_id)}}"
                           class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i>添加收款项</a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>收款项目</th>
                            <th>金额</th>
                            <th>实收</th>
                            <th>是否收款</th>
                            <th>是否开票</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{{$bill->item}}}</td>
                                <td>¥{{{$bill->grand_total}}}</td>
                                <td>¥{{{$bill->amount_tendered}}}</td>
                                <td>{{{$bill->is_paid==\App\CompanyBill::IS_PAID_NO?"否":"是"}}}</td>
                                <td>{{{$bill->is_invoice==\App\CompanyBill::IS_INVOICE_NO?"否":"是"}}}</td>
                                <td>
                                    @if($bill->is_paid==\App\CompanyBill::IS_PAID_NO)
                                        <a href="{{action('CompanyBillController@toPayBill',[$customer_id,$bill->id])}}">收款</a>
                                    @endif
                                    @if($bill->is_paid==\App\CompanyBill::IS_PAID_YES and $bill->is_invoice==\App\CompanyBill::IS_INVOICE_NO)
                                        <a href="{{{action('CompanyBillController@doInvoice',[$customer_id,$bill->id])}}}">开票</a>
                                    @endif
                                    @if($bill->is_paid==\App\CompanyBill::IS_PAID_NO)
                                        <a href="{{action('CompanyBillController@updateBill',[$customer_id,$bill->id])}}">编辑</a>
                                        <a href="{{action('CompanyBillController@deleteBill',[$customer_id,$bill->id])}}"
                                           onclick="return confirm('确认删除收款项？')">删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div style="float: right; margin-left: 100px;">
                        <a href="{{action('CompanyBillController@toAddCycleBill',$customer_id)}}"
                           class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i>添加周期收款项</a>

                    </div>
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
                        @foreach($cycleBills as $cycleBill)
                            <tr>
                                <td>{{{$cycleBill->item}}}</td>
                                <td>¥{{{$cycleBill->grand_total}}}</td>
                                <td>{{{$cycleBill->getRuleDescription()}}}</td>
                                <td>
                                    <a href="{{action('CompanyBillController@updateCycleBill',[$customer_id,$cycleBill->id])}}">编辑</a>
                                    <a href="{{action('CompanyBillController@deleteCycleBill',[$customer_id,$cycleBill->id])}}"
                                       onclick="return confirm('删除周期收款项目将会连带删除今天后的所有关联未付款项，是否确认删除？')">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}" type="text/javascript"></script>
    <script src="{{ get_static('assets/js/pages/todo.js')}}" type="text/javascript"></script>
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


