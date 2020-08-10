<?php

include '../conector.php';
include '../funciones.php';

$logo = '../dist/imagenes/logo.jpg';
$titulo = 'Corporación Instituto Pedagógico Ocupacional';
$titulo1 = 'INPO';
$titulo2 = 'Educación para el Trabajo y el Desarrollo Humano';

$temp_file = "./pdfdata.txt";
if (!$gestor = fopen($temp_file, "wb")) {
    echo "No se puede abrir el archivo $temp_file";
    exit();
}

// Terminamos de escribir al archivo
fclose($gestor);

include './pdf/convertir.php';
unlink($temp_file);


