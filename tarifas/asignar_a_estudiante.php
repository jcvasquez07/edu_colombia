<?php
if (isset($_POST['asignar_tarifa'])) {
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $id_tarifa = filter_input(INPUT_POST, 'id_tarifa');

    $error = '';
    $query = "UPDATE estudiantes SET id_tarifa = '$id_tarifa' WHERE id_usuario = '$id_usuario'";
    $resultado = $mysqli->query($query);

    if ($mysqli->error) {
        $error = "No se pudo insertar en la tabla de tarifas. El servidor dijo: " . htmlspecialchars($mysqli->error);
    }

    // Notificamos
    if ($error != '') {
        // Ocurrió un error, mostramos un mensaje
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Ocurri&#243; un error. <?php echo $error; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    } else {
        // Todo ok, mostramos un mensaje
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>La tarifa se asign&#243; correctamente.</strong>
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
                <h1 class="m-0 text-dark">Asignar Tarifa a Estudiante</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">

    <h4>Buscar Estudiante</h4>
    <form enctype="multipart/form-data" method="POST" action="">
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="nombre1" class="col-sm-3 col-form-label">Nombre(s)</label>
                    <div class="col-sm-3">
                        <input type="text" name="nombre1" class="form-control" id="nombre1" placeholder="Primer nombre">
                    </div>

                    <div class="col-sm-3">
                        <input type="text" name="nombre2" class="form-control" id="nombre2" placeholder="Segundo nombre">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-sm-3 col-form-label">Apellido(s)</label>
                    <div class="col-sm-3">
                        <input type="text" name="apellido1" class="form-control" id="apellido1" placeholder="Primer apellido">
                    </div>

                    <div class="col-sm-3">
                        <input type="text" name="apellido2" class="form-control" id="apellido2" placeholder="Segundo apellido">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="identificacion" class="col-sm-3 col-form-label">Identificaci&#243;n</label>
                    <div class="col-sm-6">
                        <input type="text" name="identificacion" class="form-control" id="identificacion" placeholder="Identificaci&#243;n">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="buscar" class="btn btn-success">Buscar</button>
                    </div>
                </div> 
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['buscar'])) {
        $nombre1 = arreglar_texto(filter_input(INPUT_POST, 'nombre1'));
        $nombre2 = arreglar_texto(filter_input(INPUT_POST, 'nombre2'));
        $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
        $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
        $identificacion = filter_input(INPUT_POST, 'identificacion');

        if (!$nombre1 && !$nombre2 && !$apellido1 && !$apellido2 && !$identificacion) {
            $error = 'No pueden dejarse todos los campos vacíos';
        } elseif (!$apellido1 && !$apellido2 && !$identificacion) {
            $error = 'Se requiere por lo menos un apellido o un numero de identificacion';
        }


        if ($error != '') {
            // Ocurrió un error, mostramos un mensaje
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ocurri&#243; un error.&nbsp;<?php echo $error; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        } else {
            $where = '';
            if ($nombre1 != '') {
                $where .= "nombre1 LIKE '%$nombre1%' AND ";
            }
            if ($nombre2 != '') {
                $where .= "nombre2 LIKE '%$nombre2%' AND ";
            }
            if ($apellido1 != '') {
                $where .= "apellido1 LIKE '%$apellido1%' AND ";
            }
            if ($apellido2 != '') {
                $where .= "apellido2 LIKE '%$apellido2%' AND ";
            }
            if ($identificacion != '') {
                $where .= "numero_identificacion LIKE '%$identificacion%'";
            }

            //Podría haber un 'AND' al final
            $where = trim($where);
            if (substr($where, -3) == 'AND') {
                $where = substr($where, 0, -3);
            }

            $query = "SELECT
                    usuarios.id,
                    CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) AS estudiante, 
                    estudiantes.numero_identificacion
                FROM 
                    estudiantes, usuarios 
                WHERE 
                    $where AND
                    estudiantes.id_usuario = usuarios.id 
                ORDER BY 
                    estudiante";
            $resultado = $mysqli->query($query);
            if ($resultado->num_rows) {
                ?>
                <table class="table table-hover" id="dt_listado">
                    <thead>
                        <tr>
                            <th>Nombre del Estudiante</th>
                            <th>N&#250;mero de Identificaci&#243;n</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['estudiante']; ?></td>
                                <td><?php echo $row['numero_identificacion']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAsignarTarifa<?php echo $row['id']; ?>">Asignar Tarifa</button>
                                </td>
                            </tr>

                            <!-- Modal para Asignar tarifa -->
                        <div class="modal fade" id="modalAsignarTarifa<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalAsignarTarifaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAsignarTarifaLabel">Asignar Tarifa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="" method="POST">
                                            <div class="form-group row">
                                                <label for="id_usuario" class="col-sm-3 col-form-label">ID</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="id_usuario" id="id_usuario" readonly class="form-control-plaintext" value="<?php echo $row['id']; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="estudiante" class="col-sm-3 col-form-label">Estudiante</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="estudiante" id="estudiante" readonly class="form-control-plaintext" value="<?php echo $row['estudiante']; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="identificacion" class="col-sm-3 col-form-label">Identificaci&#243;n</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="identificacion" id="identificacion" readonly class="form-control-plaintext" value="<?php echo $row['numero_identificacion']; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tarifa" class="col-sm-3 col-form-label">Tarifa</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="id_tarifa" required>                                                    
                                                        <option value="">-- Seleccione la tarifa --</option>
                                                        <?php
                                                        $query_tarifas = "SELECT * FROM tarifas WHERE 1 ORDER BY nombre_tarifa";
                                                        $resultado_tarifas = $mysqli->query($query_tarifas);
                                                        while ($row_tarifas = $resultado_tarifas->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $row_tarifas['id']; ?>"><?php echo $row_tarifas['nombre_tarifa']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" name="asignar_tarifa" class="btn btn-primary">Asignar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                <?php
            } else {
                ?>
                <p><strong>No se encontraron resultados</strong></p>
                <?php
            }
        }
    }
    ?>

</div>














































