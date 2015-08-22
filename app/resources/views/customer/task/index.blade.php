@extends('layouts.master')

@section('customer', 'active')

@section('title', '待办事项')

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
                                    @if($tasks->count() == 0)
                                        <h2>暂无待办事项</h2>
                                    @else
                                    <ul class="list-unstyled todo-list">
                                        <!-- this will be add via jquery, as we don't have ngrepeat in jquery like angular -->
                                        @foreach($tasks as $task)
                                            @if($task->is_finish ==1)
                                                <li data-index="{{$task->id}}"class="completed">
                                                <div class="ui-checkbox ui-checkbox-pink">
                                                    <label>
                                                        <input type="checkbox" cid="{{$customer_id}}" data-rel="{{$task->id}}" checked class="toggle"/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                    <div class="todo-title">
                                                        {{$task->todo_name}}
                                                        <form class="todo-edit">
                                                            <input type="text"/>
                                                        </form>
                                                    </div>
                                                    <span class="destroy ion ion-close right"  task="{{{$task->id}}}" cid="{{$customer_id}}" @if($task->operator_id != Auth::user()->id) data-rel="other" @endif></span>
                                                </li>

                                            @else
                                         <li data-index="{{$task->id}}">
							    			<div class="ui-checkbox ui-checkbox-pink">
							    				<label>
							    					<input type="checkbox" cid="{{$customer_id}}" data-rel="{{$task->id}}" class="toggle"/>
							    					<span></span>
							    				</label>
							    			</div>
                                             <div class="todo-title">
                                                 {{$task->todo_name}}    @if(($task->remind_time - time()) < 172800 and !empty($task->remind_time))
                                                     <label class="label label-pink">{{date('Y-m-d', $task->remind_time)}}</label>
                                                 @endif
                                                 <form class="todo-edit">
                                                     <input type="text"/>
                                                 </form>
                                             </div>
                                             <span class="destroy ion ion-close right"  task="{{{$task->id}}}" cid="{{$customer_id}}" @if($task->operator_id != Auth::user()->id) data-rel="other" @endif></span>
                                         </li>
                                             @endif
                                        @endforeach
                                    @endif
                                    <!-- Add todo input -->
                                    <form id="input-todo" class="input-todo" action="{{action('TaskController@getCreateTask', $customer_id)}}" method="get">
                                        <input placeholder="请在此键入待办事项..." name="task_name" type="text">
                                    </form>
                                </div> <!-- #end panel-body -->
                                {{--<div class="panel-footer todo-foot clearfix" id="todo-filters">--}}
                                    {{--<div class="left">--}}
                                        {{--<button class="btn btn-pink btn-xs right toggle-all waves-effect">Toggle All</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="right">--}}
                                        {{--<span class="remaining btn btn-xs btn-default waves-effect">1 left</span>--}}
                                        {{--<button class="btn btn-pink btn-xs clear-completed waves-effect">Clear Completed</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div> <!-- #end panel -->
                        </div>
                    </div>

                    <input type="hidden" name="todo_storage" id="todo_storage" value="{{$tasks}}">
                    <!-- #end row -->
                </div>
                <!-- #end page-wrap -->
            </div>
        </div>
    </div>
@endsection
