'use strict';
$(document).ready(function() {
    // [ task-action ]
    $(".task-right-header-action").on('click', function() {
        $(".task-right-content-action").slideToggle();
    });
    // [ task-status ]
    $(".task-right-header-status").on('click', function() {
        $(".taskboard-right-progress").slideToggle();
    });
    // [ task-users ]
    $(".task-right-header-users").on('click', function() {
        $(".taskboard-right-users").slideToggle();
    });
    // [ task-revision ]
    $(".task-right-header-revision").on('click', function() {
        $(".taskboard-right-revision").slideToggle();
    });
    // [ task-collapse ]
    $('.collapse').on('shown.bs.collapse', function() {
        $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
    }).on('hidden.bs.collapse', function() {
        $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
    });
});
