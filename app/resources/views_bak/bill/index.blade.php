@extends('layouts.master')

@section('title', '收款账单')
@section('bill', 'active')

@section('nav', '收款')

@section('content')
    <div class="col-md-2">
        <ul class="list-unstyled mailbox-nav">
            <li @if(Request::input('type') == 'all') class="active" @endif><a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}?type=all">全部({{$allNum}})</a></li>
            <li @if(Request::input('type') == 'unpaid' or Request::input('type')=='') class="active" @endif><a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}?type=unpaid">待收款({{$unpaidNum}})</a></li>
            <li @if(Request::input('type') == 'cycle') class="active" @endif><a href="{{action('CompanyBillController@getSummaryUnpaidBills')}}?type=cycle">定期款项目({{$cycleNum}})</a></li>

        </ul>
    </div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">收款账单</h3>
            </div>
            @foreach($companyBills as $companyBill)
                <div class="panel-body">
                    <span><a href="{{action('CompanyBillController@getAllBills',$companyBill->id)}}">{{{$companyBill->name}}}</a></span>
                    <br />
                    <span>待收款 ¥{{{$companyBill->grand_total}}} ({{{$companyBill->total_item}}}项)</span>
                    <br />
                    <span>定期款项 {{$companyBill->has_cycle?"有":"无"}}</span>
                    @if($companyBill->has_cycle)
                        <span style="float: right;"><form action="{{{action('CompanyBillController@sendBillNotice',$companyBill->id)}}}" method="post"><input type="hidden" name="_token" value="{!! csrf_token()!!}"><input type="hidden" name="companyId" value="{{{$companyBill->id}}}"><input type="hidden" name="grand_total" value="{{{$companyBill->grand_total}}}"><input type="hidden" name="total_item" value="{{{$companyBill->total_item}}}"><a href="javascript:void(0);" onclick="this.parentNode.submit();">短信催款</a></form></span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
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