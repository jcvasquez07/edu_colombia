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
    case 'coordinador':
        $msg_titulo = "Listado de Coordinadores";
        $msg_agregar = "Agregar Nuevo Coordinador";
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

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=<?php echo $pagina_agregar; ?>" class="btn btn-success mb-2" role="button" aria-pressed="true"><?php echo $msg_agregar; ?></a></p>
        </div>
    </div>

    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>      
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Observaciones</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $condicion = "usuarios.rol = roles.id";
            switch ($tipo) {
                case  'estudiante':
                    $condicion .= " AND roles.id = 8";
                    break;
                case  'acudiente':
                    $condicion .= " AND roles.id = 4";
                    break;
                case  'docente':
                    $condicion .= " AND roles.id = 5";
                    break;
                case  'coordinador':
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
                    <td><?php echo $row['rol']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>