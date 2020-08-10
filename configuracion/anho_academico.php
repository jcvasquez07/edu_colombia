<?php
if (isset($_POST['guardar'])) {
    $año = filter_input(INPUT_POST, 'año');
    
    $error = "";
    $query = "INSERT INTO anho_academico SET anho = '$año'";
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo insertar en la tabla anho_academico. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">A&#241;o Acad&#233;mico</h1>
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
                    <label for="año" class="col-sm-3 col-form-label">A&#241;o acad&#233;mico</label>
                    <div class="col-sm-3">
                        <input type="text" name="año" class="form-control" id="año" placeholder="A&#241;o acad&#233;mico" required>
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


