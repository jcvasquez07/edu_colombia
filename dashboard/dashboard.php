<?php

switch($_SESSION['rol']) {
    case '1':
        include 'dashboard_administrador.php';
        break;
    case '2':
    case '3':
        include 'dashboard_pendiente.php';
        break;
    case '5':
        include 'dashboard_docente.php';
        break;
    case '6':
        include 'dashboard_asesor.php';
        break;
    case '8':
        include 'dashboard_estudiante.php';
        break;
    default:
        include 'dashboard_pendiente.php';
        break;
}
