<?php

fwrite($gestor, "\n2< Educación >");

$query_estudios = "SELECT * FROM estudios WHERE usuario_id = '$usuario_id'";
$resultado_estudios = $mysqli->query($query_estudios);
if ($resultado_estudios->num_rows) {

    $row_eg = $resultado_estudios->fetch_assoc();
    fwrite($gestor, "\n");

    fwrite($gestor, "#X\n");
    fwrite($gestor, '$data = array(');

    switch ($row_eg['ultimo_grado']) {
        case 0:
            $ultimo_grado = 'Primaria sin terminar';
            break;
        case 1:
            $ultimo_grado = 'Primaria terminada';
            break;
        case 2:
            $ultimo_grado = 'Básicos sin terminar';
            break;
        case 3:
            $ultimo_grado = 'Básicos terminados';
            break;
        case 4:
            $ultimo_grado = 'Carrera o Diversificado sin terminar';
            break;
        case 5:
            $ultimo_grado = 'Carrera o Diversificado terminado';
            break;
        case 6:
            $ultimo_grado = 'Menos de tres años de Universidad';
            break;
        case 7:
            $ultimo_grado = 'Pensum cerrado';
            break;
        case 8:
            $ultimo_grado = 'Graduado universitario';
            break;
    }

    fwrite($gestor, 'array(\'clave\'=>\'Ultimo grado terminado\', \'valor\'=>\'' . arreglar_texto_pdf($ultimo_grado) . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Nombre del plantel\', \'valor\'=>\'' . arreglar_texto_pdf($row_eg['nombre_establecimiento']) . '\'),');
    if ($row_eg['nombre_carrera'] != '') {
        fwrite($gestor, 'array(\'clave\'=>\'Nombre de la carrera\', \'valor\'=>\'' . arreglar_texto_pdf($row_eg['nombre_carrera']) . '\'),');
    }
    fwrite($gestor, 'array(\'clave\'=>\'Año\', \'valor\'=>\'' . arreglar_texto_pdf($row_eg['anho']) . '\'),');


    fwrite($gestor, ');');
    fwrite($gestor, "\n");
    include 'tabla.php';
    fwrite($gestor, "#x\n");
    fwrite($gestor, "\n");
} else {
    fwrite($gestor, "\nNo existen referencias de educación general.\n");
}