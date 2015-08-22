@extends('layouts.master')

@section('title', '银行账户')
@section('customer', 'active')

@section('css_link')
    <style type="text/css">
        .bank_pic {
            background: url({{{asset('assets/images/banks.jpg')}}}) no-repeat scroll left top transparent;
            display: inline-block;
            vertical-align: middle;
        }
        .bank_icbc { background-position: 0 -748px; height: 33px; width: 141px;}
        .bank_abc { background-position: 0 0; height: 33px; width: 141px;}
        .bank_abc_qy { background-position: 0 -34px; height: 33px; width: 141px;}
        .bank_bcom { background-position: 0 -68px; height: 33px; width: 141px;}
        .bank_bea { background-position: 0 -102px; height: 33px; width: 141px;}
        .bank_bjrcb { background-position: 0 -136px;height: 33px;width: 141px;}
        .bank_bob {background-position: 0 -170px;height: 33px; width: 141px;}
        .bank_boc { background-position: 0 -204px; height: 33px; width: 141px;}
        .bank_cbhb { background-position: 0 -238px; height: 33px; width: 141px; }
        .bank_ccb { background-position: 0 -272px; height: 33px; width: 141px; }
        .bank_ccb_qy { background-position: 0 -306px; height: 33px; width: 141px;}
        .bank_ceb { background-position: 0 -340px; height: 33px; width: 141px; }
        .bank_cib { background-position: 0 -374px; height: 33px; width: 141px;}
        .bank_citic { background-position: 0 -408px; height: 33px; width: 141px;}
        .bank_cmb { background-position: 0 -442px; height: 33px; width: 141px;}
        .bank_cmbc { background-position: 0 -476px; height: 33px; width: 141px;}
        .bank_czb { background-position: 0 -510px; height: 33px; width: 141px;}
        .bank_gdb { background-position: 0 -544px; height: 33px; width: 141px;}
        .bank_gzcb { background-position: 0 -578px; height: 33px; width: 141px;}
        .bank_gzrcc { background-position: 0 -612px; height: 33px; width: 141px;}
        .bank_hsb { background-position: 0 -646px; height: 33px; width: 141px;}
        .bank_hxb { background-position: 0 -680px; height: 33px; width: 141px;}
        .bank_hzb { background-position: 0 -714px; height: 33px; width: 141px;}
        .bank_icbc { background-position: 0 -748px; height: 33px; width: 141px;}
        .bank_icbc_qy { background-position: 0 -782px; height: 33px; width: 141px;}
        .bank_nbcb { background-position: 0 -816px; height: 33px; width: 141px;}
        .bank_njcb { background-position: 0 -850px; height: 33px; width: 141px;}
        .bank_pab { background-position: 0 -884px; height: 33px; width: 141px;}
        .bank_post { background-position: 0 -918px; height: 33px; width: 141px;}
        .bank_sdb {background-position: 0 -952px; height: 33px; width: 141px;}
        .bank_shb { background-position: 0 -986px; height: 33px;width: 141px;}
        .bank_shrcc { background-position: 0 -1020px; height: 33px; width: 141px;}
        .bank_spdb { background-position: 0 -1054px; height: 33px; width: 141px;}
        .bank_spdb_qy { background-position: 0 -1088px; height: 33px; width: 141px;}
        .bank_jsb { background-position: 0 -1121px; height: 33px; width: 141px;}
        .bank_wzb { background-position: 0 -1155px; height: 33px; width: 141px;}
        .bank_jhb { background-position: 0 -1189px; height: 33px; width: 141px;}

        .bank_cdb { background-position: 0 -1223px; height: 33px; width: 141px;}
        .bank_hanb { background-position: 0 -1257px; height: 33px; width: 141px;}
        .bank_jinb { background-position: 0 -1290px; height: 33px; width: 141px;}
        .bank_gzrb{ background-position: 0 -1325px; height: 33px; width: 141px;}
        .bank_zhrb{ background-position: 0 -1358px; height: 33px; width: 141px;}
        .bank_sdrb{ background-position: 0 -1393px; height: 33px; width: 141px;}
        .bank_ydrb{ background-position: 0 -1427px; height: 33px; width: 141px;}
    </style>
@endsection

@section('nav', '银行账户')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <a href="{{action('BankAccountController@getCreateBankAccount', $customer_id)}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 添加银行账户</a>
            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">银行账户列表</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="row">

                    @foreach($lists as $single)
                            <div class="col-md-6">
                        <div class="panel panel-white">
                        <div class="panel-heading clearfix">
                            <h4 class="panel-title"><a href="{{action('BankAccountController@getModifyBankAccount', [$customer_id,$single->id])}}">{{{$single->account_name}}}</a></h4>
                        </div>
                        <div class="panel-body">
                            <blockquote>
                                 <p><span style="font-size: 26px">{{{$single->account}}}</span> <span class="copy-button" data-clipboard-text="{{{$single->account}}}" class="label label-success">复制</span></p>
                                <p>{{{$single->bank_branch}}} <a href="http://ditu.amap.com/search?query={{$single->bank_address}}" target="_blank" class="label label-success">高德地图</a></p>
                            </blockquote>
                            <blockquote>
                                <p>

                                    @if(get_bank_logo($single->bank)['state'] == 'found')
                                        <span class="bank_pic {{get_bank_logo($single->bank)['name']}}  cur" title="{{{$single->bank}}}"></span>
                                    @else
                                        {{$single->bank}}
                                    @endif
                                    官网 <a href="{{$single->bank_url}}" target="_blank" class="label label-success">访问</a></p>
                                <footer> <cite title="Source Title">{{$single->province}} {{$single->city}} {{$single->town}}</cite></footer>
                            </blockquote>
                            <blockquote class="blockquote-reverse">
                                <p>{{{$single->remarks}}}</p>
                                {{--<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>--}}
                            </blockquote>
                        </div>
                    </div>
                            </div>
                    @endforeach
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script src="{{ get_static('assets/js/ZeroClipboard/ZeroClipboard.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            var client = new ZeroClipboard( $(".copy-button") );

            client.on( "ready", function( readyEvent ) {
                // alert( "ZeroClipboard SWF is ready!" );

                client.on( "aftercopy", function( event ) {
                    // `this` === `client`
                    // `event.target` === the element that was clicked
//                    event.target.style.display = "none";
                    alert("复制成功: " + event.data["text/plain"] );
                } );
            } );

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