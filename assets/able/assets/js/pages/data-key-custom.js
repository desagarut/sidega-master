$(document).ready(function() {
    setTimeout(function() {

        // [ Basic Initialisation ]
        $('#basic-key-table').DataTable({
            keys: true,
        });

        // [ Scrolling Table ]
        $('#scrool-key').DataTable({
            scrollY: 300,
            paging: false,
            keys: true,
        });

        $('#focus-key').DataTable({
            keys: true,
        });
    }, 350);
});
