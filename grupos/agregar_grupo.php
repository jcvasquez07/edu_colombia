<?php
if (isset($_POST['guardar'])) {
    $codigo_materia = filter_input(INPUT_POST, 'codigo_materia');  // Ej: FC-0013
    $nombre_materia = arreglar_texto(filter_input(INPUT_POST, 'nombre_materia'));

    // Procesamos el código 
    $piezas = explode("-", $codigo_materia);
    $codigo_oferta = $piezas[0];    // código de dos letras
    $siguiente = ltrim($piezas[1], "0") + 1;    // removemos ceros a la izquierda, sumar uno
    $codigo_materia = str_replace("-", "", $codigo_materia);    // quitamos el guión

    $error = "";
    $query = "INSERT INTO materias SET codigo_materia = '$codigo_materia', nombre_materia = '$nombre_materia'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        $query1 = "UPDATE ofertas_educativas SET siguiente = '$siguiente' WHERE codigo_oferta = '$codigo_oferta'";
        $resultado1 = $mysqli->query($query1);
        if ($mysqli->error) {
            $error = "No se pudo actualizar la tabla de ofertas educativas. El servidor dijo: " . htmlspecialchars($mysqli->error);
        }
    } else {
        $error = "No se pudo insertar en la tabla de materias. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
            <strong>Se agreg&#243; la materia <?php echo $codigo_materia . " - " . $nombre_materia; ?>.</strong>
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
    <div>
        <a href="main.php?pagina=listado_materias" type="button" class="btn btn-info">Volver al listado de Materias</a>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form enctype="multipart/form-data" method="POST" action="">
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="codigo_materia" class="col-sm-3 col-form-label">Oferta Educativa</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="codigo_materia" name="codigo_materia" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM ofertas_educativas WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                // Armamos el código
                                $codigo = $row['codigo_oferta'] . "-" . str_pad($row['siguiente'], 4, "0", STR_PAD_LEFT);
                                ?>
                                <option value="<?php echo $codigo; ?>"><?php echo ucfirst($row['nombre_oferta']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nombre_materia" class="col-sm-3 col-form-label">Nombre de Materia</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_materia" class="form-control" id="nombre_materia" placeholder="Nombre de Materia" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success"> Agregar Materia </button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>
