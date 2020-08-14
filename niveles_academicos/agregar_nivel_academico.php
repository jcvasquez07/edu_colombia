<?php
if (isset($_POST['guardar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $nombre_nivel_academico = arreglar_texto(filter_input(INPUT_POST, 'nombre_nivel_academico'));
    $id_oferta = filter_input(INPUT_POST, 'id_oferta');

    $error = "";
    $sql = "SET nombre_nivel_academico = '$nombre_nivel_academico', id_oferta = '$id_oferta'";
    if ($id != '') {
        $operacion = 'actualizar';
        $query = "UPDATE niveles_academicos $sql WHERE id = '$id'";
    } else {
        $operacion = 'insertar';
        $query = "INSERT INTO niveles_academicos $sql";
    }
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo $operacion el registro en la tabla de niveles academicos. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
            <strong>Se <?php echo ($operacion == 'insertar') ? 'agreg&#243;' : 'actualiz&#243;'; ?> el nivel acad&#233;mico <?php echo $nombre_nivel_academico; ?>.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}

$titulo = "Agregar Nivel Acad&#233;mico";
$texto_boton = " Agregar Nivel Acad&#233;mico";
if (isset($_GET['id_nivel_academico'])) {
    $id_nivel_academico = filter_input(INPUT_GET, 'id_nivel_academico');
    $titulo = "Editar Nivel Acad&#233;mico";
    $texto_boton = " Actualizar Nivel Acad&#233;mico";
    $query = "SELECT * FROM niveles_academicos WHERE id = '$id_nivel_academico'";
    $resultado = $mysqli->query($query);
    $row = $resultado->fetch_assoc();
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $titulo; ?></h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
    <div>
        <a href="main.php?pagina=listado_niveles_academicos" type="button" class="btn btn-info">Volver al Listado de Niveles Acad&#233;micos</a>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form enctype="multipart/form-data" method="POST" action="">        
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="nombre_nivel_academico" class="col-sm-3 col-form-label">Nombre del Nivel Acad&#233;mico</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_nivel_academico" class="form-control" id="nombre_nivel_academico" placeholder="Nombre del Nivel Acad&#233;mico" value="<?php echo $row['nombre_nivel_academico']; ?>" required>
                    </div>
                </div>                 

                <div class="form-group row">
                    <label for="id_oferta" class="col-sm-3 col-form-label">Oferta Educativa</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_oferta" name="id_oferta" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_oferta = "SELECT * FROM ofertas_educativas WHERE 1";
                            $resultado_oferta = $mysqli->query($query_oferta);
                            while ($row_oferta = $resultado_oferta->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_oferta['id']; ?>"><?php echo ucfirst($row_oferta['nombre_oferta']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success"><?php echo $texto_boton; ?></button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        setSelectedIndex(document.getElementById("id_oferta"), "<?php echo $row['id_oferta']; ?>");
    });
</script>
