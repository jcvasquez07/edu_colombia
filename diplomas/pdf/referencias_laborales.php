<?php

fwrite($gestor, "\n2< Experiencia Laboral >\n");

$query_laborales = "SELECT * FROM referencias_laborales WHERE usuario_id = '$usuario_id'";
$resultado_laborales = $mysqli->query($query_laborales);
if ($resultado_laborales->num_rows) {

    while ($row_rl = $resultado_laborales->fetch_assoc()) {
        fwrite($gestor, "\n");
        $periodo_laborado = 'Del ' . arreglar_fecha($row_rl['fecha_inicio']) . ' al ' . arreglar_fecha($row_rl['fecha_final']);

        fwrite($gestor, "#X\n");
        fwrite($gestor, '$pdf->ezText(\'<b>' . arreglar_texto_pdf($row_rl['nombre_empresa']) . '</b>\', 14);');
        fwrite($gestor, "\n");

        fwrite($gestor, '$data = array(');
        fwrite($gestor, 'array(\'clave\'=>\'Puesto Ocupado\', \'valor\'=>\'' . arreglar_texto_pdf($row_rl['puesto']) . '\'),');
        fwrite($gestor, 'array(\'clave\'=>\'Período Laborado\', \'valor\'=>\'' . $periodo_laborado . '\'),');
        fwrite($gestor, 'array(\'clave\'=>\'Funciones desempeñadas\', \'valor\'=>\'' . arreglar_texto_pdf($row_rl['funciones']) . '\'),');


        fwrite($gestor, ');');
        fwrite($gestor, "\n");
        include 'tabla.php';
        fwrite($gestor, "#x\n");
        fwrite($gestor, "\n");
    }
} else {
    fwrite($gestor, "\nNo existen referencias laborales.\n");
}