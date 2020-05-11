<?php
if (isset($_POST['guardar'])) {
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $nombre = arreglar_texto(filter_input(INPUT_POST, 'nombre'));
    $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
    $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
    $email = strtolower(arreglar_texto(filter_input(INPUT_POST, 'email')));
    $observaciones = arreglar_texto(filter_input(INPUT_POST, 'observaciones'));
    $rol = filter_input(INPUT_POST, 'rol');
    $activo = filter_input(INPUT_POST, 'activo');

    $query = "UPDATE usuarios
        SET nombre = '$nombre',
            apellido1 = '$apellido1',
            apellido2 = '$apellido2',
            email = '$email',
            observaciones = '$observaciones',
            rol = '$rol',
            activo = '$activo'
        WHERE id = '$id_usuario'";
    $resultado = $mysqli->query($query);
    echo $msg = ($resultado) ? '<div class="alert alert-success alert-dismissible fade show" role="alert">La informaci&#243;n se actualiz&#243; correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>' : ('<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo actualizar la informaci&#243;n, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>');
}

if (isset($_POST['borrar'])) {
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $query = "DELETE FROM usuarios WHERE id = '$id_usuario'";
    $resultado = $mysqli->query($query);
    if (!$resultado) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo borrar el usuario, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        ?>
        <script>
            window.location.replace("index.php?pagina=listado_usuarios&header=false");
        </script>
        <?php
    }
}

if (isset($_POST['resetearClave'])) {
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $nueva_clave1 = filter_input(INPUT_POST, 'nueva_clave1');
    $nueva_clave2 = filter_input(INPUT_POST, 'nueva_clave2');
    if ($nueva_clave1 != $nueva_clave2) {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Las claves ingresadas no coinciden. No se ha cambiado la clave.</strong>
        </div>
        <?php
    } else {
        $nueva_clave = password_hash($nueva_clave1, PASSWORD_DEFAULT);
        $query_clave = "UPDATE usuarios SET clave = '$nueva_clave' WHERE id = '$id_usuario'";
        $resultado_clave = $mysqli->query($query_clave);
        if (!$resultado_clave) {
            ?>
            <div class="alert alert-danger" role="alert">
                <strong>Ocurri&#243; un error al actualizar la clave. El servidor dijo: "<?php echo $mysqli->error; ?>"</strong>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-success" role="alert">
                <strong>La clave se cambi&#243; correctamente.</strong>
            </div>
            <?php
        }
    }
}

$id_usuario = filter_input(INPUT_GET, 'id_usuario');
$query = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
$resultado = $mysqli->query($query);
$row = $resultado->fetch_assoc();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Usuarios</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form method="POST" action="">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />

        <div class="form-group row">
            <label for="nombre" class="col-sm-3 col-form-label">Nombres</label>
            <div class="col-sm-9">
                <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="apellido1" class="col-sm-3 col-form-label">Primer Apellido</label>
            <div class="col-sm-9">
                <input type="text" name="apellido1" class="form-control" id="apellido1" value="<?php echo $row['apellido1']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="apellido2" class="col-sm-3 col-form-label">Segundo Apellido</label>
            <div class="col-sm-9">
                <input type="text" name="apellido2" class="form-control" id="apellido2" value="<?php echo $row['apellido2']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
            <div class="col-sm-9">
                <textarea name="observaciones" class="form-control" id="observaciones" rows="3"><?php echo $row['observaciones']; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="rol" class="col-sm-3 col-form-label">Rol</label>
            <div class="col-sm-3">  
                <select class="form-control" id="roles" name="rol">
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

        <?php
        $checkedSi = 'checked';
        $checkedNo = '';
        if ($row['activo'] == 'NO') {
            $checkedSi = '';
            $checkedNo = 'checked';
        }
        ?>
        <div class="form-group row">
            <label for="activo1" class="col-sm-3 col-form-label">Activo</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="activo" id="activo1" value="SI" <?php echo $checkedSi; ?>>
                <label class="form-check-label" for="activo1">SI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="activo" id="activo2" value="NO" <?php echo $checkedNo; ?>>
                <label class="form-check-label" for="activo2">NO</label>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-5 offset-3">
                <button type="submit" name="guardar" class="btn btn-success" >
                    <span class="btn-label">
                        <i class="fas fa-save"></i>
                    </span>&nbsp; Guardar
                </button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#modalResetClave">
                    <span class="btn-label">
                        <i class="fas fa-key"></i>
                    </span>&nbsp; Resetear Clave
                </button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalBorrar">
                    <span class="btn-label">
                        <i class="fas fa-trash"></i>
                    </span>&nbsp; Borrar
                </button>
            </div>
        </div>
    </form>

    <script>
        $(window).on("load", function () {
            setSelectedIndex(document.getElementById("roles"), "<?php echo $row_rol['id']; ?>");
        }
    </script>
</div>

<!-- Modal para Confirmar el Borrado -->
<div class="modal" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="modalBorrarTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle" style="color: red">¡Advertencia de Borrado!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Esta seguro que desea borrar al usuario <strong><?php echo $row['nombre'] . " " . $row['apellido1'] . " " . $row['apellido2']; ?>?</strong><p>
                <p>Esta acci&#243;n es irreversible.</p>
            </div>
            <div class="modal-footer">

                <form method="POST" action="">
                    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No borrar</button>
                    <button type="submit" name="borrar" class="btn btn-danger">Si, continuar</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal para Cambiar Clave -->
<div class="modal" id="modalResetClave" tabindex="-1" role="dialog" aria-labelledby="modalResetClaveTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetClaveTitle">Resetear Clave del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                <form method="POST" action="">
                    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
                    <?php
                    $clave = SetRandomPassword();
                    ?>
                    <div class="form-group row">
                        <label for="nuevaClave1" class="col-sm-3 col-form-label">Nueva Clave</label>
                        <div class="col-sm-6">
                            <input type="text" name="nueva_clave1" class="form-control" id="nuevaClave1" value="<?php echo $clave; ?>">
                        </div>                                               
                    </div>

                    <div class="form-group row">
                        <label for="nuevaClave2" class="col-sm-3 col-form-label">Confirmar</label>
                        <div class="col-sm-6">
                            <input type="text" name="nueva_clave2" class="form-control" id="nuevaClave2"  value="<?php echo $clave; ?>">
                        </div>
                    </div>


                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="resetearClave" class="btn btn-success">Cambiar Clave</button>
                </form>
            </div>
            <div class="modal-footer">                
            </div>
        </div>
    </div>
</div>