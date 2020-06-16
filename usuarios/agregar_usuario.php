<?php
if (isset($_POST['guardar'])) {
    $nombre1 = arreglar_texto(filter_input(INPUT_POST, 'nombre1'));
    $nombre2 = arreglar_texto(filter_input(INPUT_POST, 'nombre2'));
    $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
    $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
    $email = strtolower(arreglar_texto(filter_input(INPUT_POST, 'email')));
    $observaciones = arreglar_texto(filter_input(INPUT_POST, 'observaciones'));
    $rol = filter_input(INPUT_POST, 'rol');
    $activo = filter_input(INPUT_POST, 'activo');

    $clave_texto = SetRandomPassword();
    $clave = password_hash($clave_texto, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios
        SET nombre1 = '$nombre1',
            nombre2 = '$nombre2',
            apellido1 = '$apellido1',
            apellido2 = '$apellido2',
            email = '$email',
            clave = '$clave',
            observaciones = '$observaciones',
            rol = '$rol',
            activo = '$activo',
            creado_por = '$_SESSION[usuario_id]'";
    $resultado = $mysqli->query($query);
    $error = $mysqli->error;
    if (preg_match('/Duplicate entry/i', $error)) {
        $error = 'La direcci&#243;n de correo electr&#243;nico ya se encuentra en uso (probablemente el usuario ya existe en el sistema). Revise el listado de usuarios.';
    }
    $msg_usuario = 'Usuario: ' . $email . "<br />Clave: " . $clave_texto;
    echo $msg = ($resultado) ? '<div class=" my-5 alert alert-success alert-dismissible fade show" role="alert"><strong>EL USUARIO SE AGREGO CORRECTAMENBTE. POR FAVOR TOME NOTA DE LA SIGUIENTE INFORMACION ANTES DE CERRAR ESTE MENSAJE<br />' . $msg_usuario . '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>' : '<div class="my-5 alert alert-danger alert-dismissible fade show" role="alert">Error: el servidor dijo <strong>"' . $error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Agregar Nuevo Usuario</h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-4">
            <form method="POST" action="">                

                <div class="form-group row">
                    <label for="nombre" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre1" class="form-control" id="nombre1" placeholder="Primer Nombre" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="nombre2" class="form-control" id="nombre2" placeholder="Otros Nombres" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-sm-3 col-form-label">Apellidos</label>
                    <div class="col-sm-4">
                        <input type="text" name="apellido1" class="form-control" id="apellido1" placeholder="Primer Apellido" required>
                    </div>
                    <div class="col-sm-5">
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
                        <button type="submit" name="guardar" class="btn btn-success"> Guardar </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>