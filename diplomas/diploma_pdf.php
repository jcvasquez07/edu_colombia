<?php
include '../conector.php';
include '../funciones.php';

$id_estudiante = filter_input(INPUT_GET, 'id_estudiante');
$nombre = filter_input(INPUT_GET, 'nombre');
$fecha = arreglar_fecha(date('Y-m-d'), TRUE);


$temp_file = "./pdfdata.txt";
if (!$gestor = fopen($temp_file, "wb")) {
    echo "No se puede abrir el archivo $temp_file";
    exit();
}

include 'pdf/informacion_personal.php';
// Terminamos de escribir al archivo
fclose($gestor);

include 'pdf/convertir.php';
//unlink($temp_file);


