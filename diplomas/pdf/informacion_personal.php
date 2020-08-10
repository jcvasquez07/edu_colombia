<?php

// OJO: estamos en el directorio CV

fwrite($gestor, "\n");
fwrite($gestor, "#X\n");

// La foto va a la izquierda
$y_foto = 600;
$foto = "../fotos/$usuario_id.jpg";
fwrite($gestor, '$pdf->addJpegFromFile(\'' . $foto . '\', 50,' . $y_foto . ', 100, 0);');
fwrite($gestor, "\n");

// Bajamos para colocar el bloque siguiente
fwrite($gestor, '$pdf->ezSetDy(-120);');
fwrite($gestor, "\n");

// Las distancias 'y' las tomamos en base a la posición de la foto
fwrite($gestor, '$pdf->addText(50,' . ($y_foto - 30) . ',24,\'' . $row_perfil['nombre'] . '\');');
fwrite($gestor, '$pdf->addText(50,' . ($y_foto - 60) . ',24,\'' . $row_perfil['apellidos'] . '\');');
fwrite($gestor, "\n\n");

// La información a la derecha
fwrite($gestor, '$pdf->ezText(\'' . $row_perfil['direccion'] . '\', \'\', array(\'justification\'=>\'right\'));');
$ubicacion = ucwords(strtolower($row_perfil['municipio'] . ", " . $row_perfil['departamento']));
fwrite($gestor, '$pdf->ezText(\'' . $ubicacion . '\', \'\', array(\'justification\'=>\'right\'));');

//$separador = "";
//fwrite($gestor, '$pdf->ezText(\'' . $separador . '\', \'\', array(\'justification\'=>\'right\'));');

if ($row_perfil['tel_cel1'] != '') {
    $celular = $row_perfil['tel_cel1'];
}
if ($row_perfil['tel_cel2'] != '') {
    $celular .= ", " . $row_perfil['tel_cel1'];
}
fwrite($gestor, '$pdf->ezText(\'Celular: ' . $celular . '\', \'\', array(\'justification\'=>\'right\'));');

if ($row_perfil['tel_casa'] != '') {
    fwrite($gestor, '$pdf->ezText(\'Casa: ' . $row_perfil['tel_casa'] . '\', \'\', array(\'justification\'=>\'right\'));');
}

fwrite($gestor, '$pdf->ezText(\'Email: ' . $row_perfil['email'] . '\', \'\', array(\'justification\'=>\'right\'));');

// Bajamos para el siguiente bloque ('Acerca de mi')
fwrite($gestor, '$pdf->ezSetDy(-20);');
fwrite($gestor, "\n");
fwrite($gestor, "\n");
fwrite($gestor, "#x\n");
fwrite($gestor, "\n");
