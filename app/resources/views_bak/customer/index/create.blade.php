@extends('layouts.master')

@section('title', '增加客户')
@section('customer', 'active')

@section('nav', '增加客户')

@section('content')

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">新增客户</h4>
            </div>
            <div class="panel-body">
                <form action="{{action('CustomerController@postMainProcess')}}" method="post">
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
                        <input type="text" name="captcha" class="form-control" id="name" placeholder="验证码">
                        <img src="{{asset('captcha/'.sha1(Auth::user()->id))}}.png" class=""/>
                        <input type="hidden" class="mode" name="mode" value="on">
                    </div>
                    @else
                        <input type="hidden" class="mode" name="mode" value="off">
                        @endif
                    <input type="hidden" name="_token" value="<?php echo csrf_token()?>">

                    <button type="submit" class="btn btn-primary next">下一步</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            var get_company_info = function(url, data){
                $.ajax({
                    url: url,
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    success:function(res){
                        console.log(res)
                    },
                    error:function(){

                    }

                })
            }

            $('#new_company').change(function(){
                if(this.checked){
                    $(".check_code").hide(200);
                    $('.mode').val('off')
                }else{
                    $('.mode').val('on')
                    $(".check_code").show(200);

                }
            })
//            $('.next').click(function(){
//                //筹建的公司
//
//
//                }else{
//
//                }
//
//            })



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