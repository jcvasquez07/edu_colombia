<?php

switch ($pagina) {
    case 'agregar_estudiante':
        include 'estudiantes/agregar_estudiante.php';
        break;
    case 'listado_estudiantes':
        $tipo = 'estudiante';
        include 'usuarios/listado_usuarios.php';
        break;
    
    case 'agregar_materia':
        include 'materias/agregar_materia.php';
        break;
    case 'listado_materias':
        include 'materias/listado_materias.php';
        break;
    case 'editar_materia':
        include 'materias/editar_materia.php';
        break;
    
    case 'agregar_grupo':
        include 'grupos/agregar_grupo.php';
        break;
    case 'listado_grupos':
        include 'grupos/listado_grupos.php';
        break;
    case 'editar_grupo':
        include 'grupos/editar_grupo.php';
        break;
    
    case 'agregar_oferta':
        include 'ofertas_educativas/agregar_oferta.php';
        break;
    case 'listado_ofertas':
        include 'ofertas_educativas/listado_ofertas.php';
        break;
    case 'editar_oferta':
        include 'ofertas_educativas/editar_oferta.php';
        break;
}

