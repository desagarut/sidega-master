$(document).ready(function() {
    setTimeout(function() {
        // [ fix-header ]
        $('#fix-header').DataTable({
            fixedHeader: true
        });

        // [ Header and Footer fix ]
        var hfoot = $('#header-footer-fix').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            }
        });

        // [ ColReorder integration ] 
        var colheader = $('#col-header').DataTable({
            fixedHeader: true,
            colReorder: true
        });
    }, 350);
});
