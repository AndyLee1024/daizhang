@extends('layouts.master')

@section('title', '股东信息')
@section('customer', 'active')

@section('nav', '股东信息')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{action('PartnerController@getCreatePartner', $customer_id)}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 创建股东</a>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">股东信息</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>股东</th>
                                <th>股东类型</th>
                                <th>出资额/比例</th>
                                <th>职位</th>
                                <th>证件</th>
                                <th>证件号码</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($partners as $partner)
                                <?php $i++; ?>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{{$partner->name}}}</td>
                                <td>{{{$partner->partner_type}}}</td>
                                <td>开发中</td>
                                <td>{{$partner->post}}</td>
                                <td>{{$partner->certificate}}</td>
                                <td>{{{$partner->certificate_number}}}</td>
                                <td><a href="{{action('PartnerController@getModifyPartner', [$customer_id, $partner->id])}}">编辑 </a>| <a href="{{action('PartnerController@getDeletePartner', [$customer_id,$partner->id])}}">删除</a></td>
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