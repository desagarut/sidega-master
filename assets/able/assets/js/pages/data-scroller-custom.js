$(document).ready(function() {
    setTimeout(function() {

        // [ Basic Table Scroll ]
        $('#basic-scroller').DataTable({
            ajax: "assets/json/2500.txt",
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true
        });

        // [ State Saving ]
        $('#state-scroller').DataTable({
            ajax: "assets/json/2500.txt",
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            stateSave: true
        });

        // [ API scroller ]
        $('#api-scroller').DataTable({
            ajax: "assets/json/2500.txt",
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            initComplete: function() {
                this.api().row(1000).scrollTo();
            }
        });

    }, 350);
});
