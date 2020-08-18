<?php
if (isset($_POST['guardar'])) {
    $convenio = arreglar_texto(filter_input(INPUT_POST, 'convenio'));
    $matricula = arreglar_texto(filter_input(INPUT_POST, 'matricula'));
    $pension = arreglar_texto(filter_input(INPUT_POST, 'pension'));
    $id_asesor = arreglar_texto(filter_input(INPUT_POST, 'id_asesor'));

    $error = "";
    $query = "INSERT INTO convenios SET convenio = '$convenio', matricula = '$matricula', pension = '$pension', id_asesor = '$id_asesor'";
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo insertar en la tabla convenios. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
    $id = filter_input(INPUT_POST, 'id_convenio');
    $convenio = arreglar_texto(filter_input(INPUT_POST, 'convenio_modal'));
    $matricula = arreglar_texto(filter_input(INPUT_POST, 'matricula_modal'));
    $pension = arreglar_texto(filter_input(INPUT_POST, 'pension_modal'));
    $id_asesor = arreglar_texto(filter_input(INPUT_POST, 'id_asesor_modal'));

    $query = "UPDATE convenios SET convenio = '$convenio', matricula = '$matricula', pension = '$pension', id_asesor = '$id_asesor' WHERE id = '$id'";
    $resultado = $mysqli->query($query);
}

if (isset($_POST['borrar'])) {
    $id = filter_input(INPUT_POST, 'id_convenio');
    $query = "DELETE FROM convenios WHERE id = '$id'";
    $resultado = $mysqli->query($query);
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Convenios</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form method="POST" action="">
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="convenio" class="col-sm-3 col-form-label">Convenio</label>
                    <div class="col-sm-6">
                        <input type="text" name="convenio" class="form-control" id="convenio" placeholder="Convenio" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="asesor" class="col-sm-3 col-form-label">Asesor</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="id_asesor" name="id_asesor" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT id, CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) AS asesor FROM usuarios WHERE rol = '6' ORDER BY asesor";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['asesor']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="matricula" class="col-sm-3 col-form-label">Costo de Matr&#237;cula</label>
                    <div class="col-sm-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" name="matricula" class="form-control" id="matricula" placeholder="Costo de Matricula" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pension" class="col-sm-3 col-form-label">Costo de Pensi&#243;n</label>
                    <div class="col-sm-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" name="pension" class="form-control" id="pension" placeholder="Costo de Pensi&#243;n" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">.00</div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="guardar" class="btn btn-success"> Agregar </button>
                    </div>
                </div>
            </div> 
        </div>
    </form>


    <hr />

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Convenio</th>
                <th>Asesor</th>
                <th>Costo de Matr&#237;cula</th>
                <th>Costo de Pensi&#243;n</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT convenios.*, CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) AS asesor FROM convenios, usuarios WHERE convenios.id_asesor = usuarios.id ORDER BY convenio";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['convenio']; ?></td>
                    <td><?php echo $row['asesor']; ?></td>
                    <td>$ <?php echo $row['matricula']; ?>.00</td>
                    <td>$ <?php echo $row['pension']; ?>.00</td>
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
                            <h5 class="modal-title" id="modalEditarLabel">Editar el convenio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id_convenio" value="<?php echo $row['id']; ?>" />
                                <div class="form-group row">
                                    <label for="convenio_modal" class="col-sm-3 col-form-label">Convenio</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="convenio_modal" class="form-control" id="convenio_modal" placeholder="Convenio" value="<?php echo $row['convenio']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_asesor_modal" class="col-sm-3 col-form-label">Asesor</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="id_asesor_modal" name="id_asesor_modal" required>
                                            <option value=""> -- Seleccione -- </option>
                                            <?php
                                            $query_asesor = "SELECT id, CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) AS asesor FROM usuarios WHERE rol = '6' ORDER BY asesor";
                                            $resultado_asesor = $mysqli->query($query_asesor);
                                            while ($row_asesor = $resultado_asesor->fetch_assoc()) {
                                                $selected = '';
                                                if ($row_asesor['id'] == $row['id_asesor']) {
                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?php echo $row_asesor['id']; ?>" <?php echo $selected; ?>><?php echo ucfirst($row_asesor['asesor']); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="matricula_modal" class="col-sm-4 col-form-label">Costo de Matr&#237;cula</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="text" name="matricula_modal" class="form-control" id="matricula_modal" placeholder="Matr&#237;cula" value="<?php echo $row['matricula']; ?>" required>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                <div class="form-group row">
                                    <label for="pension_modal" class="col-sm-4 col-form-label"> Costo de Pensi&#243;n</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="text" name="pension_modal" class="form-control" id="pension_modal" placeholder="Pensi&#243;n" value="<?php echo $row['pension']; ?>" required>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">.00</div>
                                            </div>
                                        </div>
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
                            <p>&#191;Esta seguro que desea borrar este convenio: <strong><?php echo $row['convenio']; ?>?</strong><p>
                            <p>Esta operaci&#243;n no se puede deshacer.</p>
                        </div>
                        <div class="modal-footer">

                            <form method="POST" action="">
                                <input type="hidden" name="id_convenio" value="<?php echo $row['id']; ?>">
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
