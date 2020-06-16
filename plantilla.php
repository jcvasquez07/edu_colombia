<?php
if (isset($_POST['guardar'])) {
    $error = "";
    $query = '';
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        $ultimo_id = $mysqli->insert_id;
    } else {
        $error = "No se pudo insertar en la tabla xxxxx. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
            <strong>Se creo el usuario <?php echo $email; ?> con clave <?php echo $clave_texto; ?>. <br />Favor de tomar nota de esa informaci&#243;n.</strong>
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
                <h1 class="m-0 text-dark">Agregar Materia</h1>
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
                    <label for="oferta_educativa" class="col-sm-3 col-form-label">Oferta Educativa</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="oferta_educativa" name="oferta_educativa" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM ofertas_educativas WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['nombre_oferta']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="materia" class="col-sm-3 col-form-label">Nombre de Materia</label>
                    <div class="col-sm-9">
                        <input type="text" name="materia" class="form-control" id="materia" placeholder="Nombre de Materia" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fas fa-save"></i>
                            </span>Agregar
                        </button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>
