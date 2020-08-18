<?php
if (isset($_POST['guardar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $codigo_oferta = strtoupper(filter_input(INPUT_POST, 'codigo_oferta'));
    $nombre_oferta = arreglar_texto(filter_input(INPUT_POST, 'nombre_oferta'));
    $anho = filter_input(INPUT_POST, 'anho');
    $nivel_academico = filter_input(INPUT_POST, 'nivel_academico');
    $oferta = arreglar_texto(filter_input(INPUT_POST, 'oferta'));
    $jornada = filter_input(INPUT_POST, 'jornada');
    $modalidad = filter_input(INPUT_POST, 'modalidad');
    $ubicacion = filter_input(INPUT_POST, 'ubicacion');
    $grupo = filter_input(INPUT_POST, 'grupo');
    $convenio = filter_input(INPUT_POST, 'convenio');

    $error = "";
    $sql = "SET nombre_oferta = '$nombre_oferta', anho = '$anho', nivel_academico = '$nivel_academico', oferta = '$oferta', jornada = '$jornada', modalidad = '$modalidad', ubicacion = '$ubicacion', grupo = '$grupo', convenio = '$convenio'";

    if ($id != '') {
        // Estamos actualizando
        $query = "UPDATE ofertas_educativas $sql WHERE id = '$id'";
        $palabra = 'actualiz&#243;';
    } else {
        // Estamos agregando
        $query = "INSERT INTO ofertas_educativas codigo_oferta = '$codigo_oferta', $sql, siguiente = '1'";
        $palabra = 'agreg&#243;';
    }

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
            <strong>Se <?php echo $palabra; ?> la oferta <?php echo $codigo_oferta . " - " . $nombre_oferta; ?>.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}

$titulo = "Agregar Oferta Educativa";
$texto_boton = " Agregar Oferta Educativa";
if (isset($_GET['id_oferta'])) {
    $titulo = "Editar Oferta Educativa";
    $texto_boton = " Actualizar Oferta Educativa";
    $id_oferta = filter_input(INPUT_GET, 'id_oferta');
    $query = "SELECT * FROM ofertas_educativas WHERE id = '$id_oferta'";
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
        <a href="main.php?pagina=listado_ofertas" type="button" class="btn btn-info">Volver al listado de Ofertas Educativas</a>
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
                    <label for="codigo_oferta" class="col-sm-3 col-form-label">C&#243;digo (dos letras)</label>
                    <div class="col-sm-1">
                        <input type="text" name="codigo_oferta" class="form-control" id="codigo_oferta" placeholder="" value="<?php echo $row['codigo_oferta']; ?>" maxlength="2" disabled required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="nombre_oferta" class="col-sm-3 col-form-label">Nombre</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_oferta" class="form-control" id="nombre_oferta" placeholder="Nombre de la Oferta Educativa" value="<?php echo $row['nombre_oferta']; ?>" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="anho" class="col-sm-3 col-form-label">A&#241;o</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="anho" name="anho" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_anho = "SELECT * FROM anho_academico WHERE 1";
                            $resultado_anho = $mysqli->query($query_anho);
                            while ($row_anho = $resultado_anho->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_anho['id']; ?>"><?php echo ucfirst($row_anho['anho']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nivel_academico" class="col-sm-3 col-form-label">Nivel Acad&#233;mico</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="nivel_academico" name="nivel_academico" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_nivel_academico = "SELECT * FROM niveles_academicos WHERE 1";
                            $resultado_nivel_academico = $mysqli->query($query_nivel_academico);
                            while ($row_nivel_academico = $resultado_nivel_academico->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_nivel_academico['id']; ?>"><?php echo ucfirst($row_nivel_academico['nombre_nivel_academico']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="oferta" class="col-sm-3 col-form-label">Oferta</label>
                    <div class="col-sm-9">
                        <input type="text" name="oferta" class="form-control" id="oferta" placeholder="Oferta" value="<?php echo $row['oferta']; ?>" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="jornada" class="col-sm-3 col-form-label">Jornada</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="jornada" name="jornada" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_jornada = "SELECT * FROM jornadas WHERE 1";
                            $resultado_jornada = $mysqli->query($query_jornada);
                            while ($row_jornada = $resultado_jornada->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_jornada['id']; ?>"><?php echo ucfirst($row_jornada['jornada']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="modalidad" class="col-sm-3 col-form-label">Modalidad</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="modalidad" name="modalidad" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_modalidad = "SELECT * FROM modalidades WHERE 1";
                            $resultado_modalidad = $mysqli->query($query_modalidad);
                            while ($row_modalidad = $resultado_modalidad->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_modalidad['id']; ?>"><?php echo ucfirst($row_modalidad['modalidad']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ubicacion" class="col-sm-3 col-form-label">Ubicaci&#243;n</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="ubicacion" name="ubicacion" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_ubicacion = "SELECT * FROM ubicaciones WHERE 1";
                            $resultado_ubicacion = $mysqli->query($query_ubicacion);
                            while ($row_ubicacion = $resultado_ubicacion->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_ubicacion['id']; ?>"><?php echo ucfirst($row_ubicacion['ubicacion']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="grupo" class="col-sm-3 col-form-label">Grupo</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="grupo" name="grupo" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_grupo = "SELECT * FROM grupos WHERE 1 ORDER BY nombre_grupo";
                            $resultado_grupo = $mysqli->query($query_grupo);
                            while ($row_grupo = $resultado_grupo->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_grupo['id']; ?>"><?php echo ucfirst($row_grupo['nombre_grupo']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="convenio" class="col-sm-3 col-form-label">Convenio</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="convenio" name="convenio" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_convenio = "SELECT * FROM convenios WHERE 1 ORDER BY convenio";
                            $resultado_convenio = $mysqli->query($query_convenio);
                            while ($row_convenio = $resultado_convenio->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_convenio['id']; ?>"><?php echo ucfirst($row_convenio['convenio']); ?></option>
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
        setSelectedIndex(document.getElementById("anho"), "<?php echo $row['anho']; ?>");
        setSelectedIndex(document.getElementById("nivel_academico"), "<?php echo $row['nivel_academico']; ?>");
        setSelectedIndex(document.getElementById("jornada"), "<?php echo $row['jornada']; ?>");
        setSelectedIndex(document.getElementById("modalidad"), "<?php echo $row['modalidad']; ?>");
        setSelectedIndex(document.getElementById("ubicacion"), "<?php echo $row['ubicacion']; ?>");
        setSelectedIndex(document.getElementById("grupo"), "<?php echo $row['grupo']; ?>");
        setSelectedIndex(document.getElementById("convenio"), "<?php echo $row['convenio']; ?>");
    });
</script>