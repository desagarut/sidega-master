$(document).ready(function() {
    setTimeout(function() {

        // [ Simple Initialization ]
        $('#single-select').DataTable({
            select: true
        });

        // [ Multi Item Selection ]
        $('#multi-select').DataTable({
            select: {
                style: 'multi'
            }
        });

        // [ Cell Selection ]
        $('#cell-select').DataTable({
            select: {
                style: 'os',
                items: 'cell'
            }
        });

        // [ Checkbox Selection ]
        $('#checkbox-select').DataTable({
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ]
        });

        // [ Button ] 
        var table = $('#button-select').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'selected',
                'selectedSingle',
                'selectAll',
                'selectNone',
                'selectRows',
                'selectColumns',
                'selectCells'
            ],
            select: true
        });

    }, 350);
});
