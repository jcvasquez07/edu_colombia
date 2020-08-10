<?php
if (isset($_POST['guardar'])) {
    $jornada = arreglar_texto(filter_input(INPUT_POST, 'jornada'));

    $error = "";
    $query = "INSERT INTO jornadas SET jornada = '$jornada'";
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo insertar en la tabla jornadas. El servidor dijo: " . htmlspecialchars($mysqli->error);
    }

    // Notificamos
    if ($error != '') {
        // Ocurrió un error, mostramos un mensaje
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ocurri&#243; un error. <?php echo $error; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    } else {
        // Todo ok, mostramos un mensaje
        $msg = 'La informaci&#243;n se agreg&#243; correctamente';
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $msg; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}

if (isset($_POST['actualizar'])) {
    $id = filter_input(INPUT_POST, 'id_jornada');
    $jornada = arreglar_texto(filter_input(INPUT_POST, 'jornada'));
    $query = "UPDATE jornadas SET jornada = '$jornada' WHERE id = '$id'";
    $resultado = $mysqli->query($query);
}

if (isset($_POST['borrar'])) {
    $id = filter_input(INPUT_POST, 'id_jornada');
    $query = "DELETE FROM jornadas WHERE id = '$id'";
    $resultado = $mysqli->query($query);
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Jornadas</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form enctype="multipart/form-data" method="POST" action="">
        <div class="form-row">
            <div class="col-auto">
                <label for="jornada" class="sr-only">Nueva jornada</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="jornada" class="form-control" id="jornada" placeholder="Nueva jornada" required>
            </div>

            <div class="col-auto">
                <button type="submit" name="guardar" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </form>

    <hr />

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Jornada</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT * FROM jornadas WHERE 1 ORDER BY jornada";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['jornada']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar<?php echo $row['id']; ?>">Editar</button>
                    </td>                    
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar<?php echo $row['id']; ?>">Borrar</button>
                    </td>
                </tr>

                    <!-- Modal para editar -->
                <div class="modal fade" id="modalEditar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditarLabel">Editar la Jornada</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <input type="hidden" name="id_jornada" value="<?php echo $row['id']; ?>" />
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="jornada" value="<?php echo $row['jornada']; ?>" />
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        
                <!-- Modal para borrar -->
                <div class="modal" id="modalBorrar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBorrarTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle" style="color: red">¡Advertencia de Borrado!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>&#191;Esta seguro que desea borrar esta jornada: <strong><?php echo $row['jornada']; ?>?</strong><p>
                                <p>Esta operaci&#243;n no se puede deshacer.</p>
                            </div>
                            <div class="modal-footer">

                                <form method="POST" action="">
                                    <input type="hidden" name="id_jornada" value="<?php echo $row['id']; ?>">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancelar</button>
                                    <button type="submit" name="borrar" class="btn btn-danger">Si, Borrar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
