$(document).ready(function() {
    setTimeout(function() {
        // [ Basic Column Reorder ]
        $('#basic-col-reorder').DataTable({
            colReorder: true
        });

        // [ Realtime Updating ]
        $('#realtime-reorder').dataTable({
            colReorder: {
                realtime: true
            }
        });

        // [ State Saving ]
        $('#saving-reorder').dataTable({
            colReorder: true,
            stateSave: true
        });

        // [ Predefined Column Ordering ]
        $('#predefine-reorder').dataTable({
            colReorder: {
                order: [4, 3, 2, 1, 0, 5]
            }
        });

    }, 350);
});
