$(document).ready(function() {
    setTimeout(function() {

        // [ Plugin data table ] 
        $.fn.dataTable.Api.register('column().data().sum()', function() {
            return this.reduce(function(a, b) {
                var x = parseFloat(a) || 0;
                var y = parseFloat(b) || 0;
                return x + y;
            });
        });

        var table = $('#dt-plugin-method').DataTable();

        $('<button class="btn  btn-primary m-b-20">sum of age in all rows</button>')
            .prependTo('.dt-plugin-buttons')
            .on('click', function() {
                alert('Column sum is: ' + table.column(3).data().sum());
            });

        $('<button class="btn  btn-primary m-r-10 m-b-20">sum of age of visible rows</button>')
            .prependTo('.dt-plugin-buttons')
            .on('click', function() {
                alert('Column sum is: ' + table.column(3, {
                    page: 'current'
                }).data().sum());
            });

        $.fn.dataTable.ext.type.detect.unshift(
            function(d) {
                return d === 'Low' || d === 'Medium' || d === 'High' ?
                    'salary-grade' :
                    null;
            }
        );

        $.fn.dataTable.ext.type.order['salary-grade-pre'] = function(d) {
            switch (d) {
                case 'Low':
                    return 1;
                case 'Medium':
                    return 2;
                case 'High':
                    return 3;
            }
            return 0;
        };

        $('#dt-ordering').DataTable();

        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = parseInt($('#min').val(), 10);
                var max = parseInt($('#max').val(), 10);
                var age = parseFloat(data[3]) || 0; // use data for the age column

                if ((isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && age <= max) ||
                    (min <= age && isNaN(max)) ||
                    (min <= age && age <= max)) {
                    return true;
                }
                return false;
            }
        );

        var dtage = $('#dt-range').DataTable();

        /* Event listener to the two range filtering inputs to redraw on input */
        $('#min, #max').keyup(function() {
            dtage.draw();
        });

        /* Create an array with the values of all the input boxes in a column */
        $.fn.dataTable.ext.order['dom-text'] = function(settings, col) {
            return this.api().column(col, {
                order: 'index'
            }).nodes().map(function(td, i) {
                return $('input', td).val();
            });
        }

        /* Create an array with the values of all the input boxes in a column, parsed as numbers */
        $.fn.dataTable.ext.order['dom-text-numeric'] = function(settings, col) {
            return this.api().column(col, {
                order: 'index'
            }).nodes().map(function(td, i) {
                return $('input', td).val() * 1;
            });
        }

        /* Create an array with the values of all the select options in a column */
        $.fn.dataTable.ext.order['dom-select'] = function(settings, col) {
            return this.api().column(col, {
                order: 'index'
            }).nodes().map(function(td, i) {
                return $('select', td).val();
            });
        }

        /* Create an array with the values of all the checkboxes in a column */
        $.fn.dataTable.ext.order['dom-checkbox'] = function(settings, col) {
            return this.api().column(col, {
                order: 'index'
            }).nodes().map(function(td, i) {
                return $('input', td).prop('checked') ? '1' : '0';
            });
        }

        /* Initialise the table with the required column ordering data types */
        $(document).ready(function() {
            $('#dt-live-dom').DataTable({
                "columns": [
                    null,
                    { "orderDataType": "dom-text-numeric" },
                    { "orderDataType": "dom-text", type: 'string' },
                    { "orderDataType": "dom-select" }
                ]
            });
        });
    }, 350);
});
