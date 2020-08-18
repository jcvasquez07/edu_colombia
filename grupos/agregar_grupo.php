<?php
if (isset($_POST['guardar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $nombre_grupo = arreglar_texto(filter_input(INPUT_POST, 'nombre_grupo'));
    $id_anho = filter_input(INPUT_POST, 'id_anho');
    $id_nivel_academico = filter_input(INPUT_POST, 'id_nivel_academico');
    $id_jornada = filter_input(INPUT_POST, 'id_jornada');
    $id_modalidad = filter_input(INPUT_POST, 'id_modalidad');
    $periodo_tiempo = arreglar_texto(filter_input(INPUT_POST, 'periodo_tiempo'));
    $id_oferta_educativa = filter_input(INPUT_POST, 'id_oferta_educativa');
    $id_semestre = filter_input(INPUT_POST, 'id_semestre');
    $id_ubicacion = filter_input(INPUT_POST, 'id_ubicacion');
    $id_convenio = filter_input(INPUT_POST, 'id_convenio');
    $fecha_inicio = arreglar_fecha(filter_input(INPUT_POST, 'fecha_inicio'));
    $fecha_final = arreglar_fecha(filter_input(INPUT_POST, 'fecha_final'));

    $error = "";
    $sql = "SET nombre_grupo = '$nombre_grupo', periodo_tiempo = '$periodo_tiempo', fecha_inicio = '$fecha_inicio', fecha_final = '$fecha_final', id_anho = '$id_anho', id_nivel_academico = '$id_nivel_academico', id_jornada = '$id_jornada', id_modalidad = '$id_modalidad', id_oferta_educativa = '$id_oferta_educativa', id_semestre = '$id_semestre', id_convenio = '$id_convenio', id_ubicacion = '$id_ubicacion'";
    
    if ($id != '') {
        $palabra = 'actualiz&#243;';
        $query = "UPDATE grupos $sql WHERE id = '$id'";
    } else {
        $palabra = 'insert&#243;';
        $query = "INSERT INTO grupos $sql";
    }

    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "El servidor dijo: " . htmlspecialchars($mysqli->error);
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
            <strong>Se <?php echo $palabra; ?> el grupo <?php echo $nombre_grupo; ?>.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}


$titulo = "Agregar Grupo";
$texto_boton = " Agregar Grupo";
if (isset($_GET['id_grupo'])) {
    $titulo = "Editar Grupo";
    $texto_boton = " Actualizar Grupo";
    $id_grupo = filter_input(INPUT_GET, 'id_grupo');
    $query = "SELECT * FROM grupos WHERE id = '$id_grupo'";
    $resultado = $mysqli->query($query);
    $row = $resultado->fetch_assoc();
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Agregar Grupo</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
    <div>
        <a href="main.php?pagina=listado_grupos" type="button" class="btn btn-info">Volver al listado de Grupos</a>
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
                    <label for="nombre_grupo" class="col-sm-3 col-form-label">Nombre del Grupo</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" placeholder="Nombre del Grupo" value="<?php echo $row['nombre_grupo']; ?>" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_anho" class="col-sm-3 col-form-label">A&#241;o</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_anho" name="id_anho" required>
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
                    <label for="id_nivel_academico" class="col-sm-3 col-form-label">Nivel Acad&#233;mico</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_nivel_academico" name="id_nivel_academico" required>
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
                    <label for="id_jornada" class="col-sm-3 col-form-label">Jornada</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_jornada" name="id_jornada" required>
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
                    <label for="id_modalidad" class="col-sm-3 col-form-label">Modalidad</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_modalidad" name="id_modalidad" required>
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
                    <label for="periodo_tiempo" class="col-sm-3 col-form-label">Per&#237;odo de Tiempo</label>
                    <div class="col-sm-9">
                        <input type="text" name="periodo_tiempo" class="form-control" id="periodo_tiempo" placeholder="Per&#237;odo de Tiempo" value="<?php echo $row['periodo_tiempo']; ?>" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_oferta_educativa" class="col-sm-3 col-form-label">Oferta Educativa</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_oferta_educativa" name="id_oferta_educativa" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM ofertas_educativas WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row_oferta = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_oferta['id']; ?>"><?php echo ucfirst($row_oferta['nombre_oferta']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_semestre" class="col-sm-3 col-form-label">Semestre</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_semestre" name="id_semestre" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_semestre = "SELECT * FROM semestres WHERE 1 ORDER BY semestre";
                            $resultado_semestre = $mysqli->query($query_semestre);
                            while ($row_semestre = $resultado_semestre->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_semestre['id']; ?>"><?php echo $row_semestre['semestre']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_ubicacion" class="col-sm-3 col-form-label">Ubicaci&#243;n</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_ubicacion" name="id_ubicacion" required>
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

                <?php
                $f1 = explode("-", $row['fecha_inicio']);
                $fecha_inicial = $f1[2] . "/" . $f1[1] . "/" . $f1[0];
                $f2 = explode("-", $row['fecha_final']);
                $fecha_final = $f2[2] . "/" . $f2[1] . "/" . $f2[0];
                ?>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Fecha de duración</label>
                    <div class="col-sm-3">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control datepicker" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha inicial" value="<?php echo $fecha_inicial; ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-th"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control datepicker" id="fecha_final" name="fecha_final" placeholder="Fecha final" value="<?php echo $fecha_final; ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-th"></i></div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_convenio" class="col-sm-3 col-form-label">Convenio</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_convenio" name="id_convenio" required>
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
                        <button type="submit" name="guardar" class="btn btn-success"><?PHP ECHO $texto_boton; ?></button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        setSelectedIndex(document.getElementById("id_anho"), "<?php echo $row['id_anho']; ?>");
        setSelectedIndex(document.getElementById("id_nivel_academico"), "<?php echo $row['id_nivel_academico']; ?>");
        setSelectedIndex(document.getElementById("id_jornada"), "<?php echo $row['id_jornada']; ?>");
        setSelectedIndex(document.getElementById("id_modalidad"), "<?php echo $row['id_modalidad']; ?>");
        setSelectedIndex(document.getElementById("id_oferta_educativa"), "<?php echo $row['id_oferta_educativa']; ?>");
        setSelectedIndex(document.getElementById("id_semestre"), "<?php echo $row['id_semestre']; ?>");
        setSelectedIndex(document.getElementById("id_ubicacion"), "<?php echo $row['id_ubicacion']; ?>");
        setSelectedIndex(document.getElementById("id_convenio"), "<?php echo $row['id_convenio']; ?>");
    });
</script>