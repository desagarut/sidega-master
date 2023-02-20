'use strict';
$(document).ready(function() {
    $('button#create-task').on('click', function() {
        $(".md-form-control").removeClass("md-valid");
        if ('.nothing-message') {
            $('.nothing-message').hide('slide', {
                direction: 'left'
            }, 300)
        };
        var task = $('input[name=task-insert]').val();
        if (task.length == 0) {
            alert('please enter a task');
        } else {
            var newTask = '<li>' + '<p>' + task + '</p>' + '</li>'
            $('#task-list').append(newTask);
            $('input').val('');
            $('#controls').fadeIn();
            $('.task-headline').fadeIn();
        }
    });
    $(document).on('click', 'li', function() {
        $(this).toggleClass('complete');
    });    
    $(document).on('dblclick', '#task-container li', function() {
        $(this).remove();
    });
    $('button#clear-all-tasks').on('click', function() {
        $('#task-list li').remove();
        $('.task-headline').fadeOut();
        $('#controls').fadeOut();
        $('.nothing-message').show('fast');
    });
    $(".icofont icofont-ui-delete").on("click", function() {
        $(this).parent().parent().parent().fadeOut();
    });
    var i = 7;
    $("#add-btn").on("click", function() {
        $(".md-form-control").removeClass("md-valid");
        var task = $('.add_task_todo').val();
        if (task == "") {
            alert("please enter task");
        } else {
            var add_todo = $('<div class="to-do-list mb-3" id="' + i + '"><div class="d-inline-block"><label class="check-task custom-control custom-checkbox d-flex justify-content-center"><input type="checkbox" class="custom-control-input" onclick="check_task(' + i + ')" id="checkbox' + i + '"><span class="custom-control-label" for="checkbox' + i + '">' + task + '</span></label></div><div class="float-right"><a onclick="delete_todo(' + i + ');" href="#!" class="delete_todolist"><i class="far fa-trash-alt"></i></a></div></div>');
            i++;
            $(add_todo).appendTo(".new-task").hide().fadeIn(300);
            $('.add_task_todo').val('');
        }
    });
    $(".delete_todolist").on("click", function() {
        $(this).parent().parent().fadeOut();
    });
    $(".btn_save").on("click", function() {
        $(".md-form-control").removeClass("md-valid");
        var saveTask = $('.save_task_todo').val();
        if (saveTask == "") {
            alert("please enter task");
        } else {
            var add_todo = $('<div class="to-do-list mb-3" id="' + i + '"><div class="d-inline-block"><label class="check-task custom-control custom-checkbox d-flex justify-content-center"><input type="checkbox" class="custom-control-input" onclick="check_task(' + i + ')" id="checkbox' + i + '"><span class="custom-control-label" for="checkbox' + i + '">' + saveTask + '</span></label></div><div class="float-right"><a onclick="delete_todo(' + i + ');" href="#!" class="delete_todolist"><i class="far fa-trash-alt"></i></a></div></div>');
            i++;
            $(add_todo).appendTo(".tasks-widget").hide().fadeIn(300);
            $('.save_task_todo').val('');
            $("#flipFlop").modal('hide');
        }
    });
    $(".close_btn").on("click", function() {
        $('.save_task_todo').val('');
    });
    $(".delete_todo").on("click", function() {
        $(this).parent().parent().parent().parent().fadeOut();
    });
});

function delete_todo(e) {
    $('#' + e).fadeOut();
}
$('.to-do-list input[type=checkbox]').on("click", function() {
    if ($(this).prop('checked'))
        $(this).parent().addClass('done-task');
    else
        $(this).parent().removeClass('done-task');
});

function check_task(elem) {
    if ($('#checkbox' + elem).prop('checked'))
        $('#checkbox' + elem).parent().addClass('done-task');
    else
        $('#checkbox' + elem).parent().removeClass('done-task');
}
$('.to-do-label input[type=checkbox]').on('click', function() {
    if ($(this).prop('checked'))
        $(this).parent().addClass('done-task');
    else
        $(this).parent().removeClass('done-task');
});

function check_label(elem) {
    if ($('#checkbox' + elem).prop('checked'))
        $('#checkbox' + elem).parent().addClass('done-task');
    else
        $('#checkbox' + elem).parent().removeClass('done-task');
}
