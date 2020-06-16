<?php
if (isset($_POST['guardar'])) {
    $codigo_oferta = arreglar_texto(filter_input(INPUT_POST, 'codigo_oferta')); 
    $nombre_oferta = arreglar_texto(filter_input(INPUT_POST, 'nombre_oferta'));

    $error = "";
    $query = "INSERT INTO ofertas_educativas SET codigo_oferta = '$codigo_oferta', nombre_oferta = '$nombre_oferta', siguiente = '1'";
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo insertar en la tabla de ofertas. El servidor dijo: " . htmlspecialchars($mysqli->error);
    }

    // Notificamos
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
            <strong>Se agreg&#243; la oferta <?php echo $codigo_oferta . " - " . $nombre_oferta; ?>.</strong>
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
                <h1 class="m-0 text-dark">Agregar Oferta Educativa</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
    <div>
        <a href="main.php?pagina=listado_ofertas" type="button" class="btn btn-info">Volver al listado de Ofertas Educativas</a>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form enctype="multipart/form-data" method="POST" action="">
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="codigo_oferta" class="col-sm-3 col-form-label">C&#243;digo (dos letras)</label>
                    <div class="col-sm-1">
                        <input type="text" name="codigo_oferta" class="form-control" id="codigo_oferta" placeholder="" maxlength="2" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="nombre_oferta" class="col-sm-3 col-form-label">Nombre de la Oferta Educativa</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_oferta" class="form-control" id="nombre_oferta" placeholder="Nombre de la Oferta Educativa" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success"> Agregar Oferta Educativa </button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>
