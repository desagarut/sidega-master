$(document).ready(function() {
    setTimeout(function() {
        // [ left-right-fix
        var table = $('#left-right-fix').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
        var table = $('#right-fix').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 1
            }
        });

    }, 350);
});
