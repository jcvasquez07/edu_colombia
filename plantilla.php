<?php
if (isset($_POST['guardar'])) {
    // Aqui van las variables que se recogen del formulario
    $nombre = arreglar_texto(filter_input(INPUT_POST, 'nombre'));
    $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
    $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
    $email = strtolower(arreglar_texto(filter_input(INPUT_POST, 'email')));
    $observaciones = arreglar_texto(filter_input(INPUT_POST, 'observaciones'));
    $rol = filter_input(INPUT_POST, 'rol');
    $activo = filter_input(INPUT_POST, 'activo');

    // Consulta para insertar datos
    $query = "INSERT INTO $tabla
        SET nombre = '$nombre',
            apellido1 = '$apellido1',
            apellido2 = '$apellido2',
            email = '$email',
            clave = '$clave',
            observaciones = '$observaciones',
            rol = '$rol',
            activo = '$activo'";
    $resultado = $mysqli->query($query);

    // Comprobamos el resultado de la operación anterior
    if ($error = $mysqli->error) {
        // Ocurrió un error, mostramos un mensaje
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Ocurri&#243; un error. El servidor dijo <?php echo $error; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    } else {
        // Todo ok, mostramos un mensaje
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>La informaci&#243;n se agreg&#243; correctamente.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Agregar Nuevo Usuario</h1>
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <div class="row">
        <!-- Ajustar el ancho de las columnas (1-12) -->
        <div class="col-md-6">
            <form method="POST" action="">

                <div class="form-group row">
                    <label for="nombre" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre(s)" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-sm-3 col-form-label">Primer Apellido</label>
                    <div class="col-sm-9">
                        <input type="text" name="apellido1" class="form-control" id="apellido1" placeholder="Primer Apellido" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido2" class="col-sm-3 col-form-label">Segundo Apellido</label>
                    <div class="col-sm-9">
                        <input type="text" name="apellido2" class="form-control" id="apellido2" placeholder="Segundo Apellido (colocar UA si no tiene)">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                    <div class="col-sm-9">
                        <textarea name="observaciones" class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rol" class="col-sm-3 col-form-label">Nivel de Acceso</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="roles" name="rol" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_rol = "SELECT * FROM roles WHERE 1";
                            $resultado_rol = $mysqli->query($query_rol);
                            while ($row_rol = $resultado_rol->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_rol['id']; ?>"><?php echo ucfirst($row_rol['rol']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="activo1" class="col-sm-3 col-form-label">Activo</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="activo" id="activo1" value="SI" checked>
                        <label class="form-check-label" for="activo1">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="activo" id="activo2" value="NO">
                        <label class="form-check-label" for="activo2">NO</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="guardar" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fas fa-save"></i>
                            </span>Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Para una sola columna, borrar este bloque -->
        <div class="col-md-6">
            <form method="POST" action="">

                <div class="form-group row">
                    <label for="nombre" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre(s)" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-sm-3 col-form-label">Primer Apellido</label>
                    <div class="col-sm-9">
                        <input type="text" name="apellido1" class="form-control" id="apellido1" placeholder="Primer Apellido" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido2" class="col-sm-3 col-form-label">Segundo Apellido</label>
                    <div class="col-sm-9">
                        <input type="text" name="apellido2" class="form-control" id="apellido2" placeholder="Segundo Apellido (colocar UA si no tiene)">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                    <div class="col-sm-9">
                        <textarea name="observaciones" class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rol" class="col-sm-3 col-form-label">Nivel de Acceso</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="roles" name="rol" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_rol = "SELECT * FROM roles WHERE 1";
                            $resultado_rol = $mysqli->query($query_rol);
                            while ($row_rol = $resultado_rol->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_rol['id']; ?>"><?php echo ucfirst($row_rol['rol']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="activo1" class="col-sm-3 col-form-label">Activo</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="activo" id="activo1" value="SI" checked>
                        <label class="form-check-label" for="activo1">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="activo" id="activo2" value="NO">
                        <label class="form-check-label" for="activo2">NO</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="guardar" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fas fa-save"></i>
                            </span>Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
