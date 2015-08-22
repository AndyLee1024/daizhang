@extends('layouts.master')

@section('customer', 'active')

@section('title', '税务申报')


@section('content')
    <div class="page page-dashboard page-customer">

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
                    <div class="row">
                        @foreach($cards as $card)
                            <div class="col-md-4">
                                <div class="panel @if($card['guoshui_status'] == 0 or $card['dishui_status'] == 0) panel-danger @else panel-default @endif">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{$card['card_name']}}</h3>
                                    </div>
                                    <div class="panel-body @if($card['guoshui_status'] == 0 or $card['dishui_status'] == 0) @endif">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span>截至日期: {{date('Y-m-d', $card['finish_time'])}}</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                <span>国税申报: @if($card['guoshui_status'] == 0)
                                        <span data-rel="{{$card['flag']}}" rel="guoshui" class="text-success apply guoshui">申报</span>
                                    @else
                                        <span class="text-muted">已完成</span>
                                    @endif</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                <span>地税申报:@if($card['dishui_status'] == 0)
                                        <span data-rel="{{$card['flag']}}" rel="dishui" class="text-success apply dishui">申报</span>
                                    @else
                                        <span class="text-muted">已完成</span>
                                    @endif</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                 </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.apply').click(function () {

                var type = $(this).attr('rel');
                if (type) {

                    $.ajax({
                        url: '{{action("TaxController@postFinishTaxApply", $customer_id)}}',
                        type: 'post',
                        dataType: 'json',
                        data: {'type': type, 'flag': $(this).attr('data-rel')},
                        cache: false,
                        error: function () {
                            alert('发生错误');
                            return false;
                        },
                        success: function (data) {
                            alert(data.message);
                            window.location.reload();
                        }
                    })

                }

            });
        });
    </script>
@endsection