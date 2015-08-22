@extends('layouts.master')

@section('title', '联系人信息')
@section('customer', 'active')

@section('nav', '联系人')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <a href="{{action('ContactController@getCreateContact', $customer_id)}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 添加联系人</a>
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
                            <th>联系人</th>
                            <th>职位</th>
                            <th>手机号</th>
                            <th>电邮</th>
                            <th>默认联系人</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                            @foreach($contacts as $contact)
                                <?php $i++; ?>
                              <tr>
                                  <td>{{{$i}}}</td>
                                  <td>{{{$contact->name}}}</td>
                                  <td>{{{$contact->post}}}</td>
                                  <td>{{{$contact->mobile}}}</td>
                                  <td><a href="mailto:{{{$contact->email}}}">{{{$contact->email}}}</a></td>
                                  <td>
                                      @if($contact->is_default == 0)
                                          <span class="label label-info">否</span>
                                      @else
                                          <span class="label label-success">是</span>
                                      @endif
                                  </td>
                                  <td>
                                      <a href="{{action('ContactController@getSetDefaultContact', [$customer_id,$contact->id])}}" >设为默认</a>|
                                      <a href="{{action('ContactController@getModifyContact', [$customer_id,$contact->id])}}">编辑</a>|
                                      <a href="{{action('ContactController@getDeleteContact', [$customer_id,$contact->id])}}">删除</a></td>
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