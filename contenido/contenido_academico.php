<?php

switch ($pagina) {
    case 'agregar_estudiante':
        include 'estudiantes/agregar_estudiante.php';
        break;
    case 'grupos_estudiante':
        include 'estudiantes/grupos_estudiante.php';
        break;
    case 'listado_estudiantes':
        $tipo = 'estudiante';
        include 'estudiantes/listado_estudiantes.php';
        break;
    case 'diploma':
        include 'diplomas/diploma_pdf.php';
        break;

    case 'agregar_materia':
    case 'editar_materia':
        include 'materias/agregar_materia.php';
        break;
    case 'listado_materias':
        include 'materias/listado_materias.php';
        break;
    case 'docentes_materia':
        include 'materias/docentes_materia.php';
        break;

    case 'agregar_grupo':
    case 'editar_grupo':
        include 'grupos/agregar_grupo.php';
        break;
    case 'listado_grupos':
        include 'grupos/listado_grupos.php';
        break;

    case 'agregar_tarea':
    case 'editar_tarea':
        include 'tareas/agregar_tarea.php';
        break;
    case 'listado_tareas':
        include 'tareas/listado_tareas.php';
        break;

    case 'agregar_oferta':
    case 'editar_oferta':
        include 'ofertas_educativas/agregar_oferta.php';
        break;
    case 'listado_ofertas':
        include 'ofertas_educativas/listado_ofertas.php';
        break;

    case 'listado_niveles_academicos':
        include 'niveles_academicos/listado_niveles_academicos.php';
        break;
    case 'agregar_nivel_academico':
    case 'editar_nivel_academico':
        include 'niveles_academicos/agregar_nivel_academico.php';
        break;
}
