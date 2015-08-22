@extends('layouts.master')

@section('customer', 'active')

@section('title', '账号密码')

@section('content')
    <div class="page page-customer">

        <div class="page-wrap">

            @include('layouts.notification')



            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    <div class="col-md-5">
                        <form action="{{action('CustomerController@postMainProcess')}}" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="full_name">公司全称</label>
                                <input type="text" name="company_name" class="form-control" id="full_name" placeholder="公司全称">
                            </div>
                            <div class="form-group">
                                <label for="name">公司简称</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="公司简称">
                            </div>
                            <div class="form-group">
                                <label for="new">新设立公司</label>
                                <div class="checkbox">
                                    <label>
                                        <div class="checker"><span><input id="new_company" name="new_company" value="1" type="checkbox"></span></div> 筹建中公司
                                    </label>
                                </div>
                            </div>

                            @if(!isset($mode))
                                <div class="form-group check_code">
                                    <label for="name">验证码</label>
                                    <div class="div">
                                        <div class="col-md-9">
                                            <input type="text" name="captcha" class="form-control" id="name" placeholder="验证码">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{asset('captcha/'.sha1(Auth::user()->id))}}.png" class=""/>
                                        </div>
                                    </div>
                                    <input type="hidden" class="mode" name="mode" value="on">
                                </div>
                            @else
                                <input type="hidden" class="mode" name="mode" value="off">
                            @endif
                            <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                            <div class="clearfix right">
                                <button class="btn btn-primary mr5 waves-effect" type="submit">下一步</button>
                                {{--<button class="btn btn-default waves-effect">Cancel</button>--}}
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">

        $(document).ready(function () {
            var get_company_info = function (url, data) {
                $.ajax({
                    url: url,
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    success: function (res) {
                        console.log(res)
                    },
                    error: function () {

                    }

                })
            }

            $('#new_company').change(function () {
                if (this.checked) {
                    $(".check_code").hide(200);
                    $('.mode').val('off')
                } else {
                    $('.mode').val('on')
                    $(".check_code").show(200);

                }
            })
        });

    </script>
@endsection