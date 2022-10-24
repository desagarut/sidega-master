$(document).ready(function() {
    setTimeout(function() {
        // [ Custom button ]
        $('#custom-btn').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: 'My Custom button',
                action: function(e, dt, node, config) {
                    alert('Button activated');
                }
            }]
        });

        // [ Class names ]
        $('#class-btn').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: 'Warning',
                className: 'btn-warning'
            }, {
                text: 'Danger',
                className: 'btn-danger'
            }, {
                text: 'Inverse',
                className: 'btn-inverse'
            }]
        });

        // [ Keyboard activation ]
        $('#keyboard-btn').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: 'Button <u>1</u>',
                key: '1',
                action: function(e, dt, node, config) {
                    alert('Button 1 activated');
                }
            }, {
                text: 'Button <u><i>alt</i> 2</u>',
                key: {
                    altKey: true,
                    key: '2'
                },
                action: function(e, dt, node, config) {
                    alert('Button 2 activated');
                }
            }]
        });

        // [ Multi-Level collections ] 
        $('#multilevel-btn').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'collection',
                text: 'Table control',
                buttons: [{
                    text: 'Toggle start date',
                    action: function(e, dt, node, config) {
                        dt.column(-2).visible(!dt.column(-2).visible());
                    }
                }, {
                    text: 'Toggle salary',
                    action: function(e, dt, node, config) {
                        dt.column(-1).visible(!dt.column(-1).visible());
                    }
                }, 'colvis']
            }]
        });

        // [ Multiple Button Groups ] start
        var table = $('#multibtn-grup').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: 'Button 1',
                action: function(e, dt, node, config) {
                    alert('Button 1 clicked on');
                }
            }]
        });

    }, 350);
});
