@extends('layouts.master')

@section('title', '待办事项')
@section('customer', 'active')

@section('nav', '待办事项')

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">
        <div class="panel panel-white todo">
            <div class="panel-body">
                <form action="{{action('TaskController@getCreateTask', $customer_id)}}" method="get" >
                    <input type="text" class="form-control add-task" name="task_name" placeholder="在此键入新任务...">
                </form>
                <ul class="nav nav-pills todo-nav">
                    <li role="presentation" class="active all-task"><a href="#">全部任务</a></li>
                    <li role="presentation" class="active-task"><a href="#">活动中</a></li>
                    <li role="presentation" class="completed-task"><a href="#">已完成</a></li>
                </ul>
                <div class="todo-list">
                    @foreach($tasks as $task)
                        @if($task->is_finish ==1)
                            <div class="todo-item complete">
                                <input type="checkbox" cid="{{$customer_id}}" data-rel="{{$task->id}}" checked>
                                <span>{{{$task->todo_name}}}</span>
                                <a task="{{{$task->id}}}" href="javascript:void(0);" cid="{{$customer_id}}"  @if($task->operator_id != Auth::user()->id) data-rel="other" @endif class="pull-right remove-todo-item"><i class="fa fa-times"></i></a>
                            </div>
                            @else
                    <div class="todo-item">
                        <input type="checkbox" cid="{{$customer_id}}" data-rel="{{$task->id}}">
                        <span>{{{$task->todo_name}}}</span>

                        @if(($task->remind_time - time()) < 172800 and !empty($task->remind_time))
                        <span class="label label-danger">{{date('Y-m-d', $task->remind_time)}}</span>
                        @endif
                        <a href="javascript:void(0);" task="{{{$task->id}}}" cid="{{$customer_id}}" @if($task->operator_id != Auth::user()->id) data-rel="other" @endif class="pull-right remove-todo-item"><i class="fa fa-times"></i></a>
                    </div>
                        @endif
                    @endforeach

                </div>

            </div>
        </div>
        </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}" type="text/javascript"></script>
    <script src="{{ get_static('assets/js/pages/todo.js')}}" type="text/javascript"></script>
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
