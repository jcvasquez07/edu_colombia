<?php

switch ($pagina) {
    case 'dashboard':
        include "dashboard/dashboard.php";
        break;
    
    // Manejo de Usuarios
    case 'listado_usuarios':
        include 'usuarios/listado_usuarios.php';
        break;
    case 'agregar_usuario':
        include 'usuarios/agregar_usuario.php';
        break;
    case 'editar_usuario':
        include 'usuarios/editar_usuario.php';
        break;
    
    // Cerrar sesión
    case 'salir':
        include 'salir.php';
        break;
    
    // No se especificó página
    default:
        include "dashboard/dashboard.php";
        break;
}

