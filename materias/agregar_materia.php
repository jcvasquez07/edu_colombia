<?php
if (isset($_POST['guardar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $nombre_materia = arreglar_texto(filter_input(INPUT_POST, 'nombre_materia'));
    $id_oferta_educativa = filter_input(INPUT_POST, 'id_oferta_educativa');
    $id_nivel_academico = filter_input(INPUT_POST, 'id_nivel_academico');
    $aprobacion_promedio = filter_input(INPUT_POST, 'aprobacion_promedio');
    $promedio_final = filter_input(INPUT_POST, 'promedio_final');
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');

    $error = "";
    $sql = "SET nombre_materia = '$nombre_materia', aprobacion_promedio = '$aprobacion_promedio', promedio_final = '$promedio_final', id_oferta_educativa = '$id_oferta_educativa', id_grupo = '$id_grupo', id_nivel_academico = '$id_nivel_academico'";
    if ($id != '') {
        $operacion = 'actualizar';
        $query = "UPDATE materias $sql WHERE id = '$id'";
    } else {
        $operacion = 'insertar';

        // Obtenemos el código 
        $query_codigo = "SELECT codigo, siguiente FROM ofertas_educativas WHERE id = '$id_oferta_educativa'";
        $resultado_codigo = $mysqli->query($query_codigo);
        $row_codigo = $resultado_codigo->fetch_assoc();
        $codigo = $row_codigo['codigo'] . str_pad($row_codigo['siguiente'], 4, "0", STR_PAD_LEFT);
        $siguiente = $row_codigo['siguiente'] + 1;

        $query = "INSERT INTO materias codigo_materia = '$codigo_materia', $sql";
        // Actualizamos el numero siguiente de la oferta educativa
        $query1 = "UPDATE ofertas_educativas SET siguiente = '$siguiente' WHERE id = '$id_oferta_educativa'";
        $resultado1 = $mysqli->query($query1);
        if ($mysqli->error) {
            $error = "No se pudo actualizar la tabla de ofertas educativas. El servidor dijo: " . htmlspecialchars($mysqli->error);
        }
    }
    echo $query;
    $resultado = $mysqli->query($query);
    if ($mysqli->error) {
        $error = "No se pudo $operacion el registro en la tabla de materias. El servidor dijo: " . htmlspecialchars($mysqli->error);
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
            <strong>Se agreg&#243; la materia <?php echo $codigo_materia . " - " . $nombre_materia; ?>.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}

$titulo = "Agregar Asignatura";
$texto_boton = " Agregar Asignatura";
if (isset($_GET['id_materia'])) {
    $titulo = "Editar Asignatura";
    $texto_boton = " Actualizar Asignatura";
    $id_materia = filter_input(INPUT_GET, 'id_materia');
    $query = "SELECT 
                materias.* 
            FROM 
                materias 
            WHERE 
                id = '$id_materia'";
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
        <a href="main.php?pagina=listado_materias" type="button" class="btn btn-info">Volver al listado de Asignaturas</a>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <form enctype="multipart/form-data" method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <?php
                if ($row['id'] != '') {
                    ?>
                    <div class="form-group row">
                        <label for="codigo_materia" class="col-sm-3 col-form-label">C&#243;digo de la Asignatura</label>
                        <div class="col-sm-2">
                            <input type="text" name="codigo_materia" class="form-control" id="codigo_materia" value="<?php echo $row['codigo_materia']; ?>" disabled>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group row">
                    <label for="nombre_materia" class="col-sm-3 col-form-label">Nombre de la Asignatura</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_materia" class="form-control" id="nombre_materia" placeholder="Nombre de Materia" value="<?php echo $row['nombre_materia']; ?>" required>
                    </div>
                </div>

                <!-- La oferta educativa proporciona el id de la oferta y el código de la materia (automático) -->
                <div class="form-group row">
                    <label for="id_oferta_educativa" class="col-sm-3 col-form-label">Oferta Educativa</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_oferta_educativa" name="id_oferta_educativa" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_ofertas = "SELECT id, nombre_oferta FROM ofertas_educativas WHERE 1 ORDER BY nombre_oferta";
                            $resultado_ofertas = $mysqli->query($query_ofertas);
                            while ($row_ofertas = $resultado_ofertas->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_ofertas['id']; ?>"><?php echo ucfirst($row_ofertas['nombre_oferta']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="id_nivel_academico" class="col-sm-3 col-form-label">Nivel Academico</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_nivel_academico" name="id_nivel_academico" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_niveles_academicos = "SELECT id, nombre_nivel_academico FROM niveles_academicos WHERE 1 ORDER BY nombre_nivel_academico";
                            $resultado_niveles_academicos = $mysqli->query($query_niveles_academicos);
                            while ($row_niveles_academicos = $resultado_niveles_academicos->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_niveles_academicos['id']; ?>"><?php echo ucfirst($row_niveles_academicos['nombre_nivel_academico']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="aprobacion_promedio" class="col-sm-3 col-form-label">Aprobaci&#243;n Promedio</label>
                    <div class="col-sm-3">
                        <input type="text" name="aprobacion_promedio" class="form-control" id="aprobacion_promedio" placeholder="Aprobaci&#243;n Promedio" value="<?php echo $row['aprobacion_promedio']; ?>" required>
                    </div>

                    <label for="promedio_final" class="col-sm-2 col-form-label">Promedio Final</label>
                    <div class="col-sm-3">
                        <input type="text" name="promedio_final" class="form-control" id="promedio_final" placeholder="Promedio Final" value="<?php echo $row['promedio_final']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_grupo" class="col-sm-3 col-form-label">Grupo</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_grupo" name="id_grupo" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_grupos = "SELECT * FROM grupos WHERE 1";
                            $resultado_grupos = $mysqli->query($query_grupos);
                            while ($row_grupos = $resultado_grupos->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_grupos['id']; ?>"><?php echo ucfirst($row_grupos['nombre_grupo']); ?></option>
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
        setSelectedIndex(document.getElementById("id_oferta_educativa"), "<?php echo $row['id_oferta_educativa']; ?>");
        setSelectedIndex(document.getElementById("id_nivel_academico"), "<?php echo $row['id_nivel_academico']; ?>");
        setSelectedIndex(document.getElementById("id_grupo"), "<?php echo $row['id_grupo']; ?>");
    });
</script>
