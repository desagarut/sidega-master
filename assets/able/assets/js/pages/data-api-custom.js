$(document).ready(function() {
    setTimeout(function() {

        // [ Add Rows ]
        var t = $('#add-row-table').DataTable();
        var counter = 1;

        $('#addRow').on('click', function() {
            t.row.add([
                counter + '.1',
                counter + '.2',
                counter + '.3',
                counter + '.4',
                counter + '.5'
            ]).draw(false);

            counter++;
        });

        $('#addRow').click();

        // [ Individual Column Searching (Text Inputs) ]
        $('#footer-search tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
        });

        var table = $('#footer-search').DataTable();

        // [ Apply the search ]
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

        // [ Individual Column Searching (Select Inputs) ]
        $('#footer-select').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control form-control-sm"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
        var srow = $('#row-select').DataTable();

        $('#row-select tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });

        var drow = $('#row-delete').DataTable();

        $('#row-delete tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                drow.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#row-delete-btn').on('click', function() {
            drow.row('.selected').remove().draw(!1);
        });

        function format(d) {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>Full name:</td>' +
                '<td>' + d.name + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Extension number:</td>' +
                '<td>' + d.extn + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Extra info:</td>' +
                '<td>And any further details here (images etc)...</td>' +
                '</tr>' +
                '</table>';
        }

        // [ Form input ]
        var table = $('#form-input-table').DataTable();

        $('#form-input-btn').on('click', function() {
            var data = table.$('input, select').serialize();
            alert(
                "The following data would have been submitted to the server: \n\n" +
                data.substr(0, 120) + '...'
            );
            return false;
        });

        // [ Show-hide table js ]
        var sh = $('#show-hide-table').DataTable({
            "scrollY": "200px",
            "paging": false
        });

        $('a.toggle-vis').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = sh.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        });

        // [ Search API ]
        function filterGlobal() {
            $('#search-api').DataTable().search(
                $('#global_filter').val(),
                $('#global_regex').prop('checked'),
                $('#global_smart').prop('checked')
            ).draw();
        }

        function filterColumn(i) {
            $('#search-api').DataTable().column(i).search(
                $('#col' + i + '_filter').val(),
                $('#col' + i + '_regex').prop('checked'),
                $('#col' + i + '_smart').prop('checked')
            ).draw();
        }

        $('#search-api').DataTable();

        $('input.global_filter').on('keyup click', function() {
            filterGlobal();
        });

        $('input.column_filter').on('keyup click', function() {
            filterColumn($(this).parents('tr').attr('data-column'));
        });
        
    }, 350);
});
