@extends('layouts.master')

@section('customer', 'active')

@section('title', '录入客户信息')

@section('css_link')
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/bootstrap-datepicker.css')}}">
@endsection

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')



            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-8">
                    {!! $result['body']['INFO'] !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">

        function queryInfor(url,corp_org,corp_id,seq_id,reg_id,str){
            window.location.replace("{{action('CustomerController@getCompanyDetail')}}?org="+corp_org+"&id="+corp_id+"&seq_id="+seq_id+'&name={{$input['name']}}');
        }
    </script>
@endsection

