<?php    
include 'contenido/contenido_academico.php';
include 'contenido/contenido_personal.php';
include 'contenido/contenido_calificacion.php';
include 'contenido/contenido_biblioteca.php';
include 'contenido/contenido_tarifas.php';
include 'contenido/contenido_configuracion.php';

switch ($pagina) {
    case 'dashboard':
        include 'dashboard/dashboard.php';
        break;


    // Manejo de Usuarios
    case 'listado_usuarios':
        $tipo = 'usuario';
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
}



