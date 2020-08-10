<?php
if (isset($_POST['guardar'])) {
    $tipo_tarifa = arreglar_texto(filter_input(INPUT_POST, 'tipo_tarifa'));
    $nombre_tarifa = arreglar_texto(filter_input(INPUT_POST, 'nombre_tarifa'));
    $valor_tarifa = filter_input(INPUT_POST, 'valor_tarifa');
    
    $error = "";
    $query = "INSERT INTO tarifas SET tipo_tarifa = '$tipo_tarifa', nombre_tarifa = '$nombre_tarifa', valor_tarifa = '$valor_tarifa'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        $ultimo_id = $mysqli->insert_id;
    } else {
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
            <strong>Se cre&#243; la nueva tarifa.</strong>
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
                <h1 class="m-0 text-dark">Agregar Tarifa</h1>
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
                    <label for="tipo_tarifa" class="col-sm-3 col-form-label">Tipo de Tarifa</label>
                    <div class="col-sm-6">
                        <input type="text" name="tipo_tarifa" class="form-control" id="tipo_tarifa" placeholder="Tipo de tarifa" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="nombre_tarifa" class="col-sm-3 col-form-label">Nombre de la Tarifa</label>
                    <div class="col-sm-6">
                        <input type="text" name="nombre_tarifa" class="form-control" id="nombre_tarifa" placeholder="Nombre de la tarifa" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="valor_tarifa" class="col-sm-3 col-form-label">Valor de la Tarifa</label>
                    <div class="col-sm-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" name="valor_tarifa" class="form-control" id="valor_tarifa" placeholder="Valor de la tarifa" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success">Agregar</button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>









