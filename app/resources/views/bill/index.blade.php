@extends('layouts.master')

@section('unpaid-bill', 'active')

@section('title', '收款账单')

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')

            <div class="row">
                <div class="col-md-2">

                    <div class="list-group">
                        <a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}?type=all" class="list-group-item @if(Request::input('type') == 'all') active @endif">
                            <i class="ion fa fa-home"></i> <span class="tab">全部</span>
                            <span class="badge badge-sm right circle badge-primary">{{$allNum}}</span>
                        </a>
                            <a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}?type=unpaid" class="list-group-item @if(Request::input('type') == 'unpaid' or Request::input('type')=='')active @endif">
                            <i class="ion fa   fa-warning"></i> <span class="tab">待收款</span>
                                <span class="badge badge-sm right circle badge-danger">{{$unpaidNum}}</span>

                            </a>
                        <a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}?type=cycle" class="list-group-item @if(Request::input('type') == 'cycle') active @endif">
                            <i class="ion fa  fa-calendar"></i> <span class="tab">定期款项</span>
                            <span class="badge badge-sm right circle badge-info">{{$cycleNum}}</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default panel-hovered panel-stacked mb20">
                        <div class="panel-heading">
                            <h3 class="panel-title">收款账单</h3>
                        </div>
                        <div class="panel-body">
                        @foreach($companyBills as $companyBill)

                                <li class="list-group-item no-border-hr no-border-b padding-xs-hr">
                                <span><a href="{{action('CompanyBillController@getAllBills',$companyBill->id)}}">{{{$companyBill->name}}}</a></span>
                                <br />
                                <span>待收款 ¥{{{$companyBill->grand_total}}} ({{{$companyBill->total_item}}}项)</span>
                                <br />
                                <span>定期款项 {{$companyBill->has_cycle?"有":"无"}}</span>
                                @if($companyBill->grand_total>0)
                                    <span style="float: right;"><form action="{{{action('CompanyBillController@sendBillNotice',$companyBill->id)}}}" method="post"><input type="hidden" name="_token" value="{!! csrf_token()!!}"><input type="hidden" name="companyId" value="{{{$companyBill->id}}}"><input type="hidden" name="grand_total" value="{{{$companyBill->grand_total}}}"><input type="hidden" name="total_item" value="{{{$companyBill->total_item}}}"><a href="javascript:void(0);" onclick="this.parentNode.submit();">短信催款</a></form></span>
                                @endif
                                </li>

                        @endforeach
                        </div>
                    </div>
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection


