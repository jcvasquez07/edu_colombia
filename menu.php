<?php
$rol = 'administrador';
switch($rol) {
    case 'acudiente':
        include 'menu_lateral/menu_acudiente.php';
        break;
    case 'administrador':
        include 'menu_lateral/menu_administrador.php';
        break;
    case 'administrativo':
    case 'secretaria':
        include 'menu_lateral/menu_administrativo.php';
        break;
    case 'asistente':
        include 'menu_lateral/menu_asistente.php';
        break;
    case 'coordinador':
        include 'menu_lateral/menu_coordinador.php';
        break;
    case 'docente':
        include 'menu_lateral/menu_docente.php';
        break;
    case 'esudiante':
        include 'menu_lateral/menu_estudiante.php';
        break;
    default:
        include 'menu_lateral/menu_pendiente.php';
        break;
}

