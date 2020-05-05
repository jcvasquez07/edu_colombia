<?php

switch ($pagina) {
    case 'dashboard':
        include "dashboard/dashboard.php";
        break;
    case 'salir':
        include 'salir.php';
        break;
    default:
        include "dashboard/dashboard.php";
        break;
}

