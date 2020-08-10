<?php
session_start();

if (isset($_POST['guardar'])) {
    // Esto se inserta en la tabla de usuarios
    $rol = filter_input(INPUT_POST, 'rol');
    $nombre1 = arreglar_texto(filter_input(INPUT_POST, 'nombre1'));
    $nombre2 = arreglar_texto(filter_input(INPUT_POST, 'nombre2'));
    $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
    $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
    $email = strtolower(arreglar_texto(filter_input(INPUT_POST, 'email')));
    $clave_texto = filter_input(INPUT_POST, 'clave_texto');
    $observaciones = arreglar_texto(filter_input(INPUT_POST, 'observaciones'));

    // Esto va en la tabla de personal
    $telefono = filter_input(INPUT_POST, 'telefono');
    $direccion = arreglar_texto(filter_input(INPUT_POST, 'direccion'));
    $ingresado_por = $_SESSION['usuario_id'];

    $error = "";
    // Insertar en la tabla de usuarios. 
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
            activo = 'SI',
            creado_por = '$_SESSION[usuario_id]'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        $ultimo_id = $mysqli->insert_id;
    } else {
        $error = "No se pudo insertar en la tabla de usuarios. El servidor dijo: " . htmlspecialchars($mysqli->error);
    }

    // Se insertó correctamente, insertamos en la tabla de personal
    if ($ultimo_id) {
        $query = "INSERT INTO personal            
                SET telefono = '$telefono',
                    direccion = '$direccion',
                    id_usuario = '$ultimo_id'
                ";
        $resultado = $mysqli->query($query);
        if (!$mysqli->error) {
            
        } else {
            $error = "No se pudo insertar en la tabla de personal. El servidor dijo: " . htmlspecialchars($mysqli->error) . "<br />Consulta: " . $query;
        }
    }

    if ($error != '') {
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
            <strong>Se creo el usuario <?php echo $email; ?> con clave <?php echo $clave_texto; ?>. <br />Favor de tomar nota de esa informaci&#243;n.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}

// determinamos el rol de acuerdo al tipo
switch ($tipo) {
    case 'acudiente':
        $rol = 4;
        break;
    case 'docente':
        $rol = 5;
        break;
    case 'asesor educativo':
        $rol = 6;
        break;
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Agregar Nuevo <?php echo ucwords($tipo); ?></h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form method="POST" action="">
        <input type="hidden" name="rol" id="rol" value="<?php echo $rol; ?>" />
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

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
                    <label for="telefono" class="col-sm-3 col-form-label">Tel&#233;fono</label>
                    <div class="col-sm-3">
                        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Tel&#233;fono" required>
                    </div>
                    <label for="email" class="col-sm-1 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                </div>  

                <div class="form-group row">
                    <label for="direccion" class="col-sm-3 col-form-label">Direcci&#243;n de Residencia</label>
                    <div class="col-sm-9">
                        <textarea name="direccion" class="form-control" id="direccion" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                    <div class="col-sm-9">
                        <textarea name="observaciones" class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                </div> 

                <div class="form-group row">
                    <?php
                    // Proponemos una contraseña generada aleatoriamente
                    ?>
                    <label for="clave_texto" class="col-sm-3 col-form-label">Contrase&#241;a</label>
                    <div class="col-sm-3">
                        <input type="text" name="clave_texto" class="form-control" id="clave_texto" placeholder="Contrase&#241;a" value="<?php echo SetRandomPassword(); ?>" required>
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
</div>

