<?php

switch ($pagina) {
    case 'agregar_tarifa':
        include 'tarifas/agregar_tarifa.php';
        break;
    case 'asignar_tarifa_a_estudiante':
        include 'tarifas/asignar_a_estudiante.php';
        break;
    case 'asignar_tarifa_a_grupo':
        include 'tarifas/asignar_a_grupo.php';
        break;
}



