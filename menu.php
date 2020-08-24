<?php
switch($_SESSION['rol']) {
    case '1':
        // administrador
        include 'menu_lateral/menu_administrador.php';
        break;
    case '2':
    case '3':
        // administrativo y secretaria
        include 'menu_lateral/menu_administrativo.php';
        break;
    case '4':
        // acudiente
        include 'menu_lateral/menu_acudiente.php';
        break;
    case '5':
        // docente
        include 'menu_lateral/menu_docente.php';
        break;
    case '6':
        // coordinador
        include 'menu_lateral/menu_asesor.php';
        break;
    case '7':
        // asistente
        include 'menu_lateral/menu_asistente.php';
        break;
    case '8':
        // estudiante
        include 'menu_lateral/menu_estudiante.php';
        break;
    default:
        include 'menu_lateral/menu_pendiente.php';
        break;
}

