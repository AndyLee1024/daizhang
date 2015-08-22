@extends('layouts.master')

@section('title', '证照列表')
@section('customer', 'active')
@section('css_link')
     <link href="{{ get_static('assets/plugins/gridgallery/css/component.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('nav', '证照列表')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">


        <div class="row">
            <div class="col-md-3">
                <a href="{{action('CertificateController@getCreateCertificate')}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 添加证照</a>
            </div>
        </div>
        @foreach($result as $k => $v)
            <div class="row">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">{{$k}}</h4>
                    </div>
                    <div class="panel-body">
                        @foreach($v as $title => $value)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="{{unserialize($value['certificate_path'])[0]}}" alt="{{{$value['name']}}}">
                                    <div class="caption">
                                        <h3>{{{$value['name']}}}</h3>
                                        <p>{{{$value['remarks']}}}</p>
                                        <p><a href="{{action('CertificateController@getCertificateDetail', $value['id'])}}" class="btn btn-primary" role="button">查看详情</a> <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default" role="button">删除</button></p>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">系统提示</h4>
                                            </div>
                                            <div class="modal-body">
                                                此操作不可恢复，你确定要删除此证件吗?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                <button type="button" class="btn btn-success del_certificate" data-rel="{{$value['id']}}">删除</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script src="{{ get_static('assets/plugins/gridgallery/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ get_static('assets/plugins/gridgallery/js/masonry.pkgd.min.js')}}"></script>
    <script src="{{ get_static('assets/plugins/gridgallery/js/classie.js')}}"></script>
    <script src="{{ get_static('assets/plugins/gridgallery/js/cbpgridgallery.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.del_certificate').click(function(){
                var cert_id = $(this).attr('data-rel');
                window.location.replace("{{action('CertificateController@getDeleteCertificate')}}?certificate_id="+cert_id);
            })

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
