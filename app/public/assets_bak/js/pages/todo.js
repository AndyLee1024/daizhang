$( document ).ready(function() {
    var todo = function() {
        $('.todo-list .todo-item input').click(function() {

        if($(this).is(':checked')) {
            $(this).parent().parent().parent().toggleClass('complete');
        } else {
            $(this).parent().parent().parent().toggleClass('complete');
        }
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
    });
    
    $('.todo-nav .all-task').click(function() {

        $('.todo-list').removeClass('only-active');
        $('.todo-list').removeClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .active-task').click(function() {
        $('.todo-list').removeClass('only-complete');
        $('.todo-list').addClass('only-active');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .completed-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').addClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#uniform-all-complete input').click(function() {

        if($(this).is(':checked')) {
            $('.todo-item .checker span:not(.checked) input').click();
        } else {
            $('.todo-item .checker span.checked input').click();
        }
    });
    
    $('.remove-todo-item').click(function() {
        var cid = $(this).attr('cid')
        var user = $(this).attr('data-rel');
        var task_id = $(this).attr('task');
        if(user == 'other'){
            r = confirm('您确定要删除任务吗?')
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

                $(this).parent().remove();
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

            $(this).parent().remove();

        }
    });
    };
    
    todo();
    
    $(".add-task").keypress(function (e) {
        if ((e.which == 13)&&(!$(this).val().length == 0)) {
            $('<div class="todo-item added"><input type="checkbox"><span class="todo-description">' + $(this).val() + '</span><a href="javascript:void(0);" class="pull-right remove-todo-item"><i class="fa fa-times"></i></a></div>').insertAfter('.todo-list .todo-item:last-child');
            //$(this).val('');
        } else if(e.which == 13) {
            alert('Please enter new task');
        }
        $('.todo-list .todo-item.added input').uniform();
        $('.todo-list .todo-item.added input').click(function() {

            if($(this).is(':checked')) {
                $(this).parent().parent().parent().toggleClass('complete');
            } else {
                $(this).parent().parent().parent().toggleClass('complete');
            }
        });
        $('.todo-list .todo-item.added .remove-todo-item').click(function() {

            $(this).parent().remove();
        });
    });
});