@extends('layouts.master')

@section('customer', 'active')

@section('title', '待办事项')
@section('css_link')
    <link rel="stylesheet" href="{{ get_static('assets/styles/plugins/bootstrap-datepicker.css')}}">
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

                    <div class="col-md-12">
                        <div class="col-md-5">
                            <div class="panel panel-default panel-hovered mb20 todo" id="todoApp">
                                <div class="panel-heading">
                                    <span>待办事项</span>
                                </div>

                                <div class="panel-body">
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label for="task_name">任务名称</label>
                                            <input type="text" class="form-control" id="task_name" name="task_name" value="{{$input}}" placeholder="请键入任务名称">
                                        </div>
                                        <div class="form-group">
                                            <label for="alert_time">到期时间</label>
                                            <div class="row">
                                                <div class="col-md-5 date" id="datepickerDemo">
                                                    <input type="text" class="form-control col-md-5  date-picker" id="alert_time" name="alert_time"
                                                           placeholder="到期时间">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="remarks">备注</label>
                                            <textarea class="form-control" name="remarks" id="remarks"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">创建任务</button>
                                        </div>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                    </form>
                                </div>


                            </div> <!-- #end panel -->
                        </div>
                    </div>

                    <!-- #end row -->
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/scripts/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ get_static('assets/scripts/plugins/locales/bootstrap-datepicker.zh-CN.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            $('.date-picker').datepicker({
                orientation: "top auto",
                format: 'yyyy-mm-dd',
                autoclose: true,
                language: 'zh-CN'
            });
        });
    </script>
@endsection