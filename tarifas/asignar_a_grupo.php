<?php
if (isset($_POST['asignar'])) {
    $id_tarifa = filter_input(INPUT_POST, 'id_tarifa');
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');

    $error = '';
    $query = "UPDATE grupos SET id_tarifa = '$id_tarifa' WHERE id = '$id_grupo'";
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo actualizarf la tabla de grupos. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
            <strong>La informaci&#243;n se actualiz&#243; correctamente.</strong>
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
                <h1 class="m-0 text-dark">Asignar Tarifa a Grupo</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form enctype="multipart/form-data" method="POST" action="">
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="id_grupo" class="col-sm-3 col-form-label">Grupo</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="id_grupo" required>                                                    
                            <option value="">-- Seleccione el grupo --</option>
                            <?php
                            $query_grupos = "SELECT * FROM grupos WHERE 1 ORDER BY nombre_grupo";
                            $resultado_grupos = $mysqli->query($query_grupos);
                            while ($row_grupos = $resultado_grupos->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_grupos['id']; ?>"><?php echo $row_grupos['nombre_grupo']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_tarifa" class="col-sm-3 col-form-label">Nombre de la Tarifa</label>
                    <div class="col-sm-6">
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

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="asignar" class="btn btn-success">Asignar</button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>













