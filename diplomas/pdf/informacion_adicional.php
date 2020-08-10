<?php

fwrite($gestor, "\n2< Información Adicional >");

$query_adicional = "SELECT * FROM perfil_personal WHERE usuario_id = '$usuario_id'";
$resultado_adicional = $mysqli->query($query_adicional);
if ($resultado_adicional->num_rows) {
    $row_perfil = $resultado_adicional->fetch_assoc();
    $sexo = ($row_perfil['genero'] == 'F') ? 'Femenino' : 'Masculino';
    $viaje_interior = ($row_perfil['viaje_interior'] == 'S') ? 'Si' : 'No';
    $viaje_extranjero = ($row_perfil['viaje_extranjero'] == 'S') ? 'Si' : 'No';

    // Estado civil
    switch ($row_perfil['estado_civil']) {
        case 'S':
            $estado_civil = 'Solter';
            break;
        case 'C':
            $estado_civil = 'Casad';
            break;
        case 'D':
            $estado_civil = 'Divorciad';
            break;
        case 'E':
            $estado_civil = 'Separad';
            break;
        case 'U':
            $estado_civil = 'Unid';
            break;
        case 'V':
            $estado_civil = 'Viud';
            break;
    }
    if ($row_perfil['genero'] == 'F') {
        $estado_civil .= 'a';
    } else {
        $estado_civil .= 'o';
    }

    // Vehiculo
    switch ($row_perfil['vehiculo']) {
        case 'A':
            $vehiculo = 'Automovil';
            break;
        case 'M':
            $vehiculo = 'Moto';
            break;
        case 'B':
            $vehiculo = 'Automovil y moto';
            break;
        case 'N':
            $vehiculo = 'No posee';
            break;
    }

    // Discapacidad
    $discapacidad = ($row_perfil['tiene_discapacidad'] == 'S') ? 'Si' : 'No';
    if ($row_perfil['discapacidad_expl'] != '') {
        $discapacidad .= ". " . $row_perfil['discapacidad_expl'];
    }

    fwrite($gestor, "\n");

    fwrite($gestor, "#X\n");
    fwrite($gestor, '$data = array(');

    fwrite($gestor, 'array(\'clave\'=>\'DPI\', \'valor\'=>\'' . $row_perfil['dpi'] . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Fecha de Nacimiento\', \'valor\'=>\'' . arreglar_fecha($row_perfil['fecha_nacimiento'], TRUE) . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Edad\', \'valor\'=>\'' . calcular_edad($row_perfil['fecha_nacimiento']) . ' años\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Sexo\', \'valor\'=>\'' . $sexo . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Estado Civil\', \'valor\'=>\'' . $estado_civil . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Tiene disposición para viajar al interior\', \'valor\'=>\'' . $viaje_interior . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Tiene disposición para viajar al extranjero\', \'valor\'=>\'' . $viaje_extranjero . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Posee Vehículo\', \'valor\'=>\'' . $vehiculo . '\'),');
    fwrite($gestor, 'array(\'clave\'=>\'Tiene alguna discapacidad\', \'valor\'=>\'' . arreglar_texto_pdf($discapacidad) . '\'),');

    // Las redes sociales
    if ($row_perfil['facebook'] != '') {
        fwrite($gestor, 'array(\'clave\'=>\'Perfil de Facebook\', \'valor\'=>\'' . $row_perfil['facebook'] . '\'),');
    }
    if ($row_perfil['instagram'] != '') {
        fwrite($gestor, 'array(\'clave\'=>\'Perfil de Instagram\', \'valor\'=>\'' . $row_perfil['instagram'] . '\'),');
    }if ($row_perfil['twitter'] != '') {
        fwrite($gestor, 'array(\'clave\'=>\'Perfil de Twitter\', \'valor\'=>\'' . $row_perfil['twitter'] . '\'),');
    }if ($row_perfil['otra_red'] != '') {
        fwrite($gestor, 'array(\'clave\'=>\'Otra red Social\', \'valor\'=>\'' . $row_perfil['otra_red'] . '\'),');
    }

    fwrite($gestor, ');');
    fwrite($gestor, "\n");
    include 'tabla.php';
    fwrite($gestor, "#x\n");
    fwrite($gestor, "\n");
} else {
    fwrite($gestor, "\nNo existen información adicional.\n");
}