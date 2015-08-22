@extends('layouts.master')

@section('title', '客户')
@section('customer', 'active')

@section('nav', '客户')
@section('css_link')
    <link href="{{ get_static('assets/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <a href="{{action('CustomerController@getCreate')}}" class="btn btn-success btn-addon m-b-sm"><i class="fa fa-plus"></i> 新增客户</a>


            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">
                    <a href="{{action('CustomerController@getIndex')}}">全部</a>
                    @foreach(alphabeticaly() as $k=>$v)
                        <a href="{{$v}}">{{$k}}</a>
                    @endforeach
                </h4>
            </div>
        </div>
        </div>
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">客户列表</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="customers" class="display table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>客户全称</th>
                            <th>客户简称</th>
                            <th>热度</th>
                            <th>资料完成度</th>
                            <th>第一联系人</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; ?>
                           @foreach($companys as $company)
                        <?php $i++;?>
                               <tr>
                            <th scope="row">{{$i}}</th>
                            <td><a href="{{action('CustomerController@getCustomerCompanyInfo', $company->id)}}">{{{$company->full_name}}}</a></td>
                            <td>{{{$company->name}}}</td>
                            <td>开发中</td>
                            <td>开发中</td>
                            <td>{{{$company->leader}}}</td>
                                   <td><a href="{{action('CustomerController@getModifyCompany', $company->id)}}">编辑</a></td>
                            {{--<td>编辑 | 删除</td>--}}
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
    <script src="{{ get_static('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#customers').DataTable({
                "language": {
                    "lengthMenu": "每页显示 _MENU_ 条纪录",
                    "zeroRecords": "您还尚未添加纪录",
                    "info": "当前在第 _PAGE_ 页, 共 _PAGES_ 页",
                    "infoEmpty": "没有活动的纪录",
                    "loadingRecords": "读取中...",
                    "processing":     "处理中...",
                    "search":         "搜索:",
                    "paginate": {
                        "first":      "首页",
                        "last":       "末页",
                        "next":       "下一页",
                        "previous":   "上一页"
                    },
                    "infoFiltered": "(从 _MAX_ 条纪录中过滤)"
                }
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