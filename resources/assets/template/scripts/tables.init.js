
(function($) {

    "use strict";

    function toggleBasicTableFns() {
        var $btable = $(".basic-table");
        var btns = [".btable-bordered", ".btable-striped", ".btable-condensed", ".btable-hover"];
        btns.forEach(function(btn) {
            $btable.find(btn).on("click touchstart", function(e) {
                var tableClass = $(this).data("table-class");
                e.preventDefault();
                $(this).toggleClass("active");
                $btable.find("table").toggleClass(tableClass);
            });
        });
    }


    function initDataTable() {
        var $dataTable = $(".data-table"),
            $table = $dataTable.find("table");



        var table = $table.DataTable({
            searching: true,
            dom: 'rtip',
            ordering: false,

            pageLength: 10,
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

            }
        });


        // custom search input
        $dataTable.find(".searchInput").on("keyup", function() {
            table.search(this.value).draw();
        });


        // custom select box
        $dataTable.find(".lengthSelect").on("change", function() {
            table.page.len(this.value).draw();
        });

        // custom styling via jquery
        $dataTable.find(".dataTables_info").css({
            "margin-left": "20px",
            "font-size": "12px"
        });



    }




    function _init() {
        toggleBasicTableFns();
        initDataTable();
    }
    _init();

})(jQuery);