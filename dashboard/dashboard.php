<?php
$rol = filter_input(INPUT_GET, 'r');;
switch($rol) {
    case 'acudiente':
        include 'dashboard_pendiente.php';
        break;
    case 'administrador':
        include 'dashboard_administrador.php';
        break;
    case 'administrativo':
    case 'secretaria':
        include 'dashboard_pendiente.php';
        break;
    case 'asistente':
        include 'dashboard_pendiente.php';
        break;
    case 'coordinador':
        include 'dashboard_pendiente.php';
        break;
    case 'docente':
        include 'dashboard_pendiente.php';
        break;
    case 'esudiante':
        include 'dashboard_pendiente.php';
        break;
    default:
        include 'dashboard_pendiente.php';
        break;
}
