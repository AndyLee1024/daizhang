@extends('layouts.master')

@section('customer', 'active')

@section('title', '证件证照')

@section('css_link')
    <link href="{{ get_static('assets/plugins/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

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
                    <a href="{{action('CertificateController@getCreateCertificate', $customer_id)}}" class="btn btn-line-info btn-icon-inline waves-effect"><i class="ion fa fa-plus"></i>新增证照</a>
                    <br/><br/>

                    @foreach($result  as $single => $cert)

                        <div class="row">

                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">{{$single}}</h4>
                                </div>
                                <div class="panel-body">
                                    @foreach($cert as $k=>$v)
                                        <div class="col-sm-6 col-md-4">
                                            <div class="thumbnail">
                                                @if(!empty($v['certificate_path']))
                                                    <img width="230" height="230" src="{{unserialize($v['certificate_path'])[0]}}" alt="{{$v['name']}}">
                                                @else
                                                    <div action="{{action('CertificateController@postUploadCertificate', $customer_id)}}?name={{urlencode($v['name'])}}&id={{$v['id']}}" id="uploader" class="dropzone">
                                                        <div class="fallback">
                                                            <input name="file" type="file"/>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="caption">
                                                    <h3>{{$v['name']}}</h3>
                                                    @if(!empty($v['remarks']))
                                                        <p>{{$v['remarks']}}</p>
                                                    @endif
                                                    @if(!empty($v['certificate_path']))
                                                        <p><a href="{{action('CertificateController@getCertificateDetail', [$customer_id,$v['id']])}}" class="btn btn-primary" role="button">查看详情</a> <button type="button" data-toggle="modal" data-target="#myModal_{{$v['id']}}" data-rel="{{$v['id']}}" class="btn btn-default" role="button">删除</button></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal_{{$v['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                            <button type="button" class="btn btn-success del_certificate" data-rel="{{$v['id']}}">删除</button>
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
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/plugins/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('.del_certificate').click(function () {
                var cert_id = $(this).attr('data-rel');
                window.location.replace("{{action('CertificateController@getDeleteCertificate', $customer_id)}}?certificate_id=" + cert_id);
            });

            Dropzone.options.uploader = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                maxFiles: 1,
                success: function (data, response) {
                    alert('上传证照成功');
                    window.location.reload();

                }
            };
        })
    </script>
@endsection