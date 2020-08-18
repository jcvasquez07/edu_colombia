<?php

switch ($pagina) {
    case 'grupos':
        include 'asesores_educativos/grupos.php';
        break;
    case 'listado_asesores':
        $tipo = 'asesor educativo';
        include 'asesores_educativos/listado_asesores.php';
        break;
    
    case 'agregar_docente':
        $tipo = 'docente';
        include 'personal/agregar_personal.php';
        break;
    case 'listado_docentes':
        $tipo = 'docente';
        include 'usuarios/listado_usuarios.php';
        break;
    
    case 'agregar_acudiente':
        $tipo = 'acudiente';
        include 'personal/agregar_personal.php';
        break;
    case 'listado_acudientes':
        $tipo = 'acudiente';
        include 'usuarios/listado_usuarios.php';
        break;
    
    case 'editar_personal':
        include 'personal/editar_personal.php';
        break;
}
