<?php

// OJO: estamos en el directorio /diplomas
// Las distancias $x para toda la información
$x = 20;
$tamaño_texto = 10;

fwrite($gestor, "\n");
fwrite($gestor, "#X\n");

// La foto va a la derecha
$x_foto = 440;
$y_foto = 430;
$foto = "../archivos/estudiantes/" . $id_estudiante . "/foto_personal.jpg";
// Necesitamos un ancho máximo de 150
$ancho_foto = scaleimage($foto, 150, 150)[0];
fwrite($gestor, '$pdf->addJpegFromFile(\'' . $foto . '\', ' . $x_foto . ',' . $y_foto . ', ' . $ancho_foto . ', 0);');
fwrite($gestor, "\n");


$y_texto = 580;
fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 30) . ',' . $tamaño_texto . ',\'Nombres y Apellidos: ' . arreglar_texto_pdf($nombre) . '\');');
fwrite($gestor, "\n\n");

$query = "SELECT
	usuarios.email, programas_academicos.nombre_programa,
    ofertas_educativas.nombre_oferta, grupos.nombre_grupo,
    grupos.fecha_inicio, grupos.fecha_final, convenios.convenio,
    convenios.matricula, convenios.pension,
    estudiantes.* 
FROM 
	estudiantes, usuarios, programas_academicos, ofertas_educativas,
    grupos, convenios
WHERE 
	estudiantes.id_programa_academico = programas_academicos.id AND
    estudiantes.id_oferta_educativa = ofertas_educativas.id AND
	estudiantes.id_usuario = usuarios.id AND 
    estudiantes.id_grupo = grupos.id AND
    grupos.id_convenio = convenios.id AND
    id_usuario = '$id_estudiante'";

$resultado = $mysqli->query($query);
$row = $resultado->fetch_assoc();

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 45) . ',' . $tamaño_texto . ',\'Cédula de Ciudadanía: ' . $row['numero_identificacion'] . ' Expedido en: ' . arreglar_texto_pdf($row['lugar_expedido']) . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 60) . ',' . $tamaño_texto . ',\'Lugar y fecha de nacimiento: ' . arreglar_texto_pdf($row['lugar_nacimiento']) . ', ' . arreglar_fecha($row['fecha_nacimiento']) . '\');');
fwrite($gestor, "\n\n");

$rh = (substr($row['grupo_sanguineo'], -1) == 'P') ? "+":"-";
$grupo_sanguineo = substr($row['grupo_sanguineo'], 0, -1);
$genero = ($row['genero'] == 'M') ? 'Masculino' : 'Femenino';
fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 75) . ',' . $tamaño_texto . ',\'Tipo de sangre y RH: ' . strtoupper($grupo_sanguineo) . $rh . ' Género: ' . $genero . ' EPS: ' . $row['eps'] . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 90) . ',' . $tamaño_texto . ',\'Dirección completa: ' . arreglar_texto_pdf($row['direccion']) . ', ' . arreglar_texto_pdf($row['pais']) . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 105) . ',' . $tamaño_texto . ',\'Teléfono: ' . $row['telefono'] . ', Email: ' . $row['email'] . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 120) . ',' . $tamaño_texto . ',\'Programa de estudio: ' . arreglar_texto_pdf($row['nombre_programa']) . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 135) . ',' . $tamaño_texto . ',\'' . arreglar_texto_pdf($row['nombre_oferta']) . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 165) . ',' . $tamaño_texto . ',\'Grupo: ' . arreglar_texto_pdf($row['nombre_grupo']) . ' Fecha inicio: ' . arreglar_fecha($row['fecha_inicio']) . ' Fecha final: ' . arreglar_fecha($row['fecha_final']) . '\');');
fwrite($gestor, "\n\n");

fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 180) . ',' . $tamaño_texto . ',\'Convenio No. ' . $row['convenio'] . ' Valor de matrícula: $' . number_format($row['matricula'], 0, '', '.') . ' Pensión Mensual: $' . number_format($row['pension'], 0, '', '.') . '\');');

fwrite($gestor, "\n\n");fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 210) . ',' . $tamaño_texto . ',\'Canasta Academica: Camibuzo: $15.000 Carnet y Seguro: $20.000 Derecho de Grado Téc Laboral: $150.000\');');
fwrite($gestor, "\n\n");

fwrite($gestor, "\n\n");fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 225) . ',' . $tamaño_texto . ',\'Seminario I Téc: $100.000 Seminario II Téc: $100.000 Siet: $20.000\');');
fwrite($gestor, "\n\n");

fwrite($gestor, "\n\n");fwrite($gestor, '$pdf->addText(' . $x . ',' . ($y_texto - 240) . ',' . $tamaño_texto . ',\'TOTAL: $625.000\');');
fwrite($gestor, "\n\n");

fwrite($gestor, "\n");
fwrite($gestor, "\n");
fwrite($gestor, "#x\n");
fwrite($gestor, "\n");
