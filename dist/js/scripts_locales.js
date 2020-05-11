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

