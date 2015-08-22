jQuery(function() {
    "use strict";
    function initSparklines() {
        g.find(".sparkline").sparkline("html", {
            enableTagOptions: !0,
            tagOptionsPrefix: "data-"
        })
    }
    function initC3Chart() {
        var a = {
                bindto: "#c3chartAnalytics",
                data: {
                    columns: [["Network Load", 30, 100, 80, 140, 150, 200], ["CPU Load", 90, 100, 170, 140, 190, 50]],
                    type: "spline",
                    types: {
                        "Network Load": "bar"
                    }
                },
                color: {
                    pattern: ["#3F51B5", "#38B4EE", "#4CAF50", "#E91E63"]
                },
                legend: {
                    position: "inset"
                },
                size: {
                    height: 330
                }
            },
            browserconfig = {
                bindto: "#c3chartbrowsershare",
                data: {
                    columns: [["Chrome", 48.9], ["Firefox", 16.1], ["Safari", 10.9], ["IE", 17.1], ["Other", 7]],
                    type: "donut"
                },
                size: {
                    width: 260,
                    height: 260
                },
                donut: {
                    width: 50
                },
                color: {
                    pattern: ["#3F51B5", "#4CAF50", "#f44336", "#E91E63", "#38B4EE"]
                }
            };
        c3.generate(a),
            c3.generate(browserconfig)
    }
    function initEasyPieChart() {
        var b = [{
            selector: ".easypiechart.storageOpts",
            options: {
                size: 100,
                lineWidth: 2,
                lineCap: "square",
                barColor: "#E91E63"
            }
        },
            {
                selector: ".easypiechart.serverOpts",
                options: {
                    size: 100,
                    lineWidth: 2,
                    lineCap: "square",
                    barColor: "#4CAF50"
                }
            },
            {
                selector: ".easypiechart.clientOpts",
                options: {
                    size: 100,
                    lineWidth: 2,
                    lineCap: "square",
                    barColor: "#FDD835"
                }
            }];
        b.forEach(function(a) {
            $(a.selector).easyPieChart(a.options)
        })
    }
    function initRating() {
        $("input.rating-control").rating()
    }
    function TodoApp() {

        function addTodoHtml(a, b) {
            //var c = '<li data-index="' + b + '" class="' + (a.completed ? "completed": "") + '">					<div class="ui-checkbox ui-checkbox-pink">	    				<label>	    					<input type="checkbox" class="toggle" ' + (a.completed ? "checked": "") + '/>	    					<span></span>	    				</label>	    			</div>	    			<div class="todo-title"><p>' + a.title + '</p><form class="todo-edit">    					<input type="text"/>    				</form>    			</div>    			<span class="destroy ion ion-close right"></span>	    		</li>';
            //f.find(".todo-list").append(c)
        }
        function reArrangeIndex() {
            f.find(".todo-list > li").each(function(i) {
                $(this).data("index", i)
            })
        }
        function removeTodo() {
            var a = $(this).parent(),
                isCompleted = a.find("input.toggle")[0].checked,
                todoNo = a.index();

            alert('aaa');
            var cid = $(this).attr('cid')
            var user = $(this).attr('data-rel');
            var task_id = $(this).attr('task');
            if(user == 'other'){
                var r = confirm('您确定要删除任务吗?')
                if (r == true) {
                    $.ajax({
                        url: '/customer/'+cid+'/task/delete',
                        data: {'task_id': task_id},
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        error: function(){
                            return false;
                        },
                        success: function(data){
                        }
                    })

                    a.remove();
                } else {
                    return false;
                }
            }else{
                $.ajax({
                    url: '/customer/'+cid+'/task/delete',
                    data: {'task_id': task_id},
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    error: function(){
                        return false;
                    },
                    success: function(data){
                    }
                })
                a.remove();
            }
        }
        function toggleCompleted() {
            var a = $(this).parents("li"),
                todoNo = a.index(),
                isCompleted = this.checked;
            console.log(todos),

                scope.remainingCount += isCompleted ? -1 : 1,
                //todoStore.put(todos),
                a.toggleClass("completed")

            var task_id = $(this).attr('data-rel');
            var cid = $(this).attr('cid')
            $.ajax({

                url: '/customer/'+cid+'/task/finish',
                data: {'task_id': task_id},
                type: 'post',
                dataType: 'json',
                cache: false,
                error: function(){
                    return false;
                },
                success: function(data){
                }

            });
        }
        function markAll() {
            var c = f.find(".todo-list li"),
                rc = 0,
                allChecked = !1;
            todos.forEach(function(a) {
                a.completed || ++rc
            }),
            0 == rc && (allChecked = !0),
                todos.forEach(function(a) {
                    a.completed = !allChecked
                }),
                scope.remainingCount = allChecked ? 0 : todos.length,
                todoStore.put(todos),
                c.each(function(i, a) {
                    var b = $(a),
                        input = b.find("input.toggle")[0];
                    allChecked ? ($(a).removeClass("completed"), input.checked = !1) : ($(a).addClass("completed"), input.checked = !0)
                }),
                f.find(".todo-foot .remaining").html(scope.remainingCount + " left")
        }
        function addTodo(e) {
            $('.input-todo').submit();
        }
        function doneEditing(a, b, c, d) {
            a.removeClass("editing"),
                b = b.trim(),
                todos[d].title = b,
            b || scope.removeTodo(a, c, d),
                todoStore.put(todos),
                a.find(".todo-title p").html(b)
        }
        function editTodo() {
            var b = $(this).parent(),
                todoNo = b.index(),
                stodo = todos[todoNo],
                isCompleted = stodo.completed;
            b.addClass("editing"),
                $(this).find("input").val(stodo.title.trim()),
                f.find(".todo-title .todo-edit").on("submit",
                    function(e) {
                        e.preventDefault();
                        var a = $(this).find("input").val();
                        doneEditing(b, a, isCompleted, todoNo)
                    })
        }
        function clearCompleted() {
            todos = todos.filter(function(a) {
                return ! a.completed
            }),
                todoStore.put(todos);
            var b = f.find(".todo-list li").filter(function(i, a) {
                return $(a).hasClass("completed")
            });
            b.remove()
        }
        var f = $("#todoApp"),
            STORAGE_ID = "_todo-task",
            todoStore = {
                todos: [],
                get: function() {
                    return JSON.parse($('#todo_storage').val());
                },
                put: function(a) {
                    localStorage.setItem(STORAGE_ID, JSON.stringify(a))
                }
            },
            demoTodos = [],
            todos = demoTodos,
            scope = {
                newTodo: "",
                remainingCount: todos.filter(function(a) {
                    return 0 == a.completed
                }).length,
                editedTodo: null,
                originalTodo: "",
                statusFilter: null,
                edited: !1,
                todoshow: "all",
                allChecked: !1
            };
        //todos.forEach(function(a, b) {
        //    addTodoHtml(a, b)
        //}),
            f.find(".todo-foot .remaining").html(scope.remainingCount + " left"),
            f.find(".destroy").on("click touchstart", removeTodo),
            f.find("li input.toggle").on("change", toggleCompleted),
            f.find("#input-todo").on("submit", addTodo),
            f.find(".todo-title").on("dblclick", editTodo),
            f.find(".todo-foot .toggle-all").on("click touchstart", markAll),
            f.find(".todo-foot .clear-completed").on("click touchstart", clearCompleted)
    }
    function _init() {
        initSparklines(),
            //initC3Chart(),
            //initEasyPieChart(),
            initRating(),
            TodoApp()
    }
    var g = $(".page-dashboard");
    _init()
});