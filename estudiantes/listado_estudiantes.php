<?php
switch ($tipo) {
    case 'estudiante':
        $pagina_agregar = "agregar_estudiante";
        $pagina_editar = "editar_usuario";
        break;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Estudiantes</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-5">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=agregar_estudiante" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar Nuevo Estudiante</a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>      
                <th>Email</th>
                <th>Observaciones</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT usuarios.*, roles.rol FROM usuarios, roles WHERE usuarios.rol = roles.id AND roles.id = 8 ORDER BY id";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                $nombre = $row['nombre1'] . " " . $row['nombre2'] . " " . $row['apellido1'] . " " . $row['apellido2'];
                ?>
                <tr>
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td><a href="main.php?pagina=editar_usuario&id_usuario=<?php echo $row['id']; ?>"><?php echo $nombre; ?></a></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td class="rowlink-skip">

                        <a href="main.php?pagina=grupos_estudiante&id_estudiante=<?php echo $row['id']; ?>&nombre=<?php echo $nombre; ?>" class="btn btn-primary text-white">Grupos</a>
                        <a href="diplomas/diploma_pdf.php?id_estudiante=<?php echo $row['id']; ?>&nombre=<?php echo $nombre; ?>" class="btn btn-danger" target="_blank">
                            <!--<a href="plantilla_pdf.pdf" class="btn btn-info" target="_blank">-->
                            <span class="text-white">
                                <i class="fas fa-file-pdf"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

