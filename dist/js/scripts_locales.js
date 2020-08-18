// Seleccionar por valor en un SELECT
function setSelectedIndex(s, valsearch) {
    // recorremos todos los items del listado (select)
    for (i = 0; i < s.options.length; i++) {
        if (s.options[i].value == valsearch) {
            // Lo encontramos, lo marcamos como seleccionado y salimos
            s.options[i].selected = true;
            break;
        }
    }
    return;
}

// Datepickers
// HAY QUE FORMATEAR LA FECHA ANTES DE ENVIARLA A LA BD!
$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true
});

// Datatables
$(document).ready(function () {
    $('#dt_listado').DataTable({
        "columnDefs": [
            {"searchable": false, "targets": 0}
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
});

$(document).ready(function () {
// Popovers
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

// Tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});