<?php

switch($_SESSION['rol']) {
    case '1':
        include 'dashboard_administrador.php';
        break;
    case '2':
    case '3':
        include 'dashboard_pendiente.php';
        break;
    case '4':
        include 'dashboard_pendiente.php';
        break;
    case '5':
        include 'dashboard_pendiente.php';
        break;
    case '6':
        include 'dashboard_pendiente.php';
        break;
    case '7':
        include 'dashboard_pendiente.php';
        break;
    default:
    case '8':
        include 'dashboard_pendiente.php';
        break;
        include 'dashboard_pendiente.php';
        break;
}
