<?php
switch ($tipo) {
    case 'estudiante':
        $msg_titulo = "Listado de Estudiantes";
        $msg_agregar = "Agregar Nuevo Estudiante";
        $pagina_agregar = "agregar_estudiante";
        $pagina_editar = "editar_usuario";
        break;
    case 'acudiente':
        $msg_titulo = "Listado de Acudientes";
        $msg_agregar = "Agregar Nuevo Acudiente";
        $pagina_agregar = "agregar_acudiente";
        $pagina_editar = "editar_personal";
        break;
    case 'docente':
        $msg_titulo = "Listado de Docentes";
        $msg_agregar = "Agregar Nuevo Docente";
        $pagina_agregar = "agregar_docente";
        $pagina_editar = "editar_personal";
        break;
    case 'asesor educativo':
        $msg_titulo = "Listado de Asesores Educativos";
        $msg_agregar = "Agregar Nuevo Asesor Educativo";
        $pagina_agregar = "agregar_coordinador";
        $pagina_editar = "editar_personal";
        break;
    default:
        $msg_titulo = "Listado de Usuarios";
        $msg_agregar = "Agregar nuevo usuario";
        $pagina_agregar = "agregar_usuario";
        $pagina_editar = "editar_usuario";
        break;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $msg_titulo; ?></h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-5">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=<?php echo $pagina_agregar; ?>" class="btn btn-success mb-2" role="button" aria-pressed="true"><?php echo $msg_agregar; ?></a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>      
                <th>Email</th>
                <th>Observaciones</th>
                <th>
                    <?php
                    echo ($pagina == 'listado_estudiantes') ? '' : 'Rol';
                    ?>
                </th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $condicion = "usuarios.rol = roles.id";
            switch ($tipo) {
                case 'estudiante':
                    $condicion .= " AND roles.id = 8";
                    break;
                case 'acudiente':
                    $condicion .= " AND roles.id = 4";
                    break;
                case 'docente':
                    $condicion .= " AND roles.id = 5";
                    break;
                case 'asesor educativo':
                    $condicion .= " AND roles.id = 6";
                    break;
            }
            $query = "SELECT usuarios.*, roles.rol FROM usuarios, roles WHERE $condicion ORDER BY id";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                $nombre = $row['nombre1'] . " " . $row['nombre2'] . " " . $row['apellido1'] . " " . $row['apellido2'];
                ?>
                <tr>
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td><a href="main.php?pagina=<?php echo $pagina_editar; ?>&id_usuario=<?php echo $row['id']; ?>"><?php echo $nombre; ?></a></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td class="rowlink-skip">
                        <?php
                        if ($pagina == 'listado_estudiantes') {
                            ?>
                            <!--<a href="diplomas/diploma_pdf.php" target="_blank">-->
                            <a href="plantilla_pdf.pdf" target="_blank">
                                <span class="text-danger">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                            </a>
                            <?php
                        } else {
                            echo $row['rol'];
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

