<?php    
include 'contenido/contenido_academico.php';
include 'contenido/contenido_personal.php';

switch ($pagina) {
    case 'dashboard':
        include 'dashboard/dashboard.php';
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
    
    // Menu Configuración
    case 'año_academico':
        include 'configuracion/ano_academico';
        break;
    
    // Cerrar sesión
    case 'salir':
        include 'salir.php';
        break;
}

