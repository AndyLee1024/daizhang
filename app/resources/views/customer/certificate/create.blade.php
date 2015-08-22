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
                    <div class="row">
                        <form action="" method="post" class="my-form">
                            <div class="form-group col-md-6">
                                <label for="name">证件名称</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="请输入证件名称 ...">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="type">证件类型</label>
                                <select name="type" id="type" class="form-control m-b-sm">
                                    @foreach(Config::get('customer.certificate') as $k => $v)
                                        <option value="{{$k}}">{{$k}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {!! csrf_field()!!}
                            <div class="form-group col-md-12">
                                <label for="number">证件号码</label>
                                <input type="text" class="form-control" name="number" id="number" placeholder="请输入证件号码 ...">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="remarks">备注</label>
                                <input type="text" class="form-control" name="remarks" id="remarks" placeholder="请输入备注 ...">
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div action="{{action('CertificateController@postUploadCertificate', $customer_id)}}" id="dropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->

                    <div class="row">
                        <br/>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success">提交</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ get_static('assets/plugins/dropzone/dropzone.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            Dropzone.options.dropzone = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data, response){
                    alert('上传证照成功');
                    var form = $('.my-form');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'foo_'+response.file_path,
                        name: 'path[]',
                        value: response.file_path
                    }).appendTo(form);

                }
            };
            })
    </script>
@endsection
