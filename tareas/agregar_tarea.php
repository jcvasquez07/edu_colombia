<?php
if (isset($_POST['guardar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $nombre_tarea = arreglar_texto(filter_input(INPUT_POST, 'nombre_tarea'));
    $descripcion_tarea = arreglar_texto(filter_input(INPUT_POST, 'descripcion_tarea'));
    $fecha_entrega = arreglar_fecha(filter_input(INPUT_POST, 'fecha_entrega'));
    $id_oferta_educativa = filter_input(INPUT_POST, 'id_oferta_educativa');
    $id_nivel_academico = filter_input(INPUT_POST, 'id_nivel_academico');
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');
    $id_materia = filter_input(INPUT_POST, 'id_materia');

    $error = "";
    $sql = "SET nombre_tarea = '$nombre_tarea', descripcion_tarea = '$descripcion_tarea', fecha_entrega = '$fecha_entrega', id_nivel_academico = '$id_nivel_academico', id_grupo = '$id_grupo', id_materia = '$id_materia', id_oferta_educativa = '$id_oferta_educativa'";

    if ($id != '') {
        $palabra = 'actualiz&#243;';
        $query = "UPDATE tareas $sql WHERE id = '$id'";
    } else {
        $palabra = 'insert&#243;';
        $query = "INSERT INTO tareas $sql";
    }

    if (!$resultado = $mysqli->query($query)) {
        $error .= "El servidor dijo: " . htmlspecialchars($mysqli->error) . "<br />";
    } else {
        $last_id = $mysqli->insert_id;
        $id_tarea = ($id != '') ? $id : $last_id;
    }

    // Ahora subimos el archivo
    // La carpeta de destino es /archivos_tareas + id de la tarea
    $directorio = "archivos_tarea/" . $id_tarea . "/";
    if (!is_dir($directorio)) {
        if (!mkdir($directorio, 0777, TRUE)) {
            $error .= 'No se pudo crear el directorio de destino. ';
        }
    }

    $extension = getExtension(stripslashes($_FILES['documento']['name']));
    if ($extension != 'pdf' && $extension != 'PDF') {
        $error = 'No se reconoce el tipo de archivo. Solo se admiten archivos PDF. ';
    } else {
        $origen = $_FILES["documento"]["tmp_name"];
        $destino = $directorio . $_FILES["documento"]["name"];
        if (!copy($origen, $destino)) {
            $error .= 'No se pudo subir el archivo. ';
        }
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
            <strong>Se <?php echo $palabra; ?> la tarea <?php echo $nombre_tarea; ?>.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}

if(isset($_POST['quitar'])) {
    $archivo = filter_input(INPUT_POST, 'archivo');
    unlink($archivo);
    
}

$titulo = "Agregar Tarea";
$texto_boton = " Agregar Tarea";
if (isset($_GET['id_tarea'])) {
    $titulo = "Editar Tarea";
    $texto_boton = " Actualizar Tarea";
    $id_tarea = filter_input(INPUT_GET, 'id_tarea');
    $query = "SELECT * FROM tareas WHERE id = '$id_tarea'";
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
        <a href="main.php?pagina=listado_tareas" type="button" class="btn btn-info">Volver al listado de Tareas</a>
        <?php
        if ($id_tarea) {
            ?>
            <a href="main.php?pagina=agregar_tarea" type="button" class="btn btn-info">Agregar Nueva Tarea</a>
            <?php
        }
        ?>
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
                    <label for="nombre_tarea" class="col-sm-3 col-form-label">Nombre de la Tarea</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_tarea" class="form-control" id="nombre_tarea" placeholder="Nombre del Tarea" value="<?php echo $row['nombre_tarea']; ?>" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="descripcion_tarea" class="col-sm-3 col-form-label">Descrpci&#243;n</label>
                    <div class="col-sm-9">
                        <textarea name="descripcion_tarea" class="form-control" id="descripcion_tarea" placeholder="Descrpci&#243;n de la Tarea" required><?php echo $row['descripcion_tarea']; ?></textarea>
                    </div>
                </div> 

                <?php
                if ($pagina == 'editar_tarea') {
                    $f1 = explode("-", $row['fecha_entrega']);
                    $fecha_inicial = $f1[2] . "/" . $f1[1] . "/" . $f1[0];
                }
                ?>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Fecha de Entrega</label>
                    <div class="col-sm-3">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control datepicker" id="fecha_entrega" name="fecha_entrega" placeholder="Fecha inicial" value="<?php echo $fecha_inicial; ?>" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-th"></i></div>
                            </div>
                        </div>
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
                    <label for="id_grupo" class="col-sm-3 col-form-label">Grupo</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_grupo" name="id_grupo" required>
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
                    <label for="id_materia" class="col-sm-3 col-form-label">Asignatura</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_materia" name="id_materia" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_materia = "SELECT * FROM materias WHERE 1 order by nombre_materia";
                            $resultado_materia = $mysqli->query($query_materia);
                            while ($row_materia = $resultado_materia->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_materia['id']; ?>"><?php echo ucfirst($row_materia['nombre_materia']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="archivos" class="col-sm-3 col-form-label">Archivos existentes</label>
                    <div class="col-sm-9 my-2"> 
                        <?php
                        if ($id_tarea) {
                            $directorio = "archivos_tarea/" . $id_tarea . "/";
                            $ficheros = scandir($directorio);
                            // $i = 2 porque 0 = '.' (directorio actual) y '1' = '..' (directorio superior)
                            for ($i = 2; $i < count($ficheros); $i++) {
                                $src = $directorio . "/" . $ficheros[$i];
                                echo $ficheros[$i];
                                ?>
                                &nbsp;&nbsp;
                                <a href="<?php echo $src; ?>" class="btn btn-primary btn-sm my-1" target="_blank">Ver</a> &nbsp;&nbsp;
                                <!--Button trigger modal--> 
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBorrar<?php echo $row['id']; ?>">Quitar</button>
                                <br />

                                <!--Modal--> 
                                <div class="modal fade" id="modalBorrar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBorrarLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalBorrarLabel">Quitar documento</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Se va a quitar el documento <strong><?php echo $ficheros[$i]; ?>.<br />
                                                    Esta acci&#243;n no puede deshacerse.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <form action="" method="POST">
                                                    <input type="text" name="archivo" value="<?php echo $directorio = "archivos_tarea/" . $id_tarea . "/" . $ficheros[$i]; ?>" />
                                                    <button type="submit" name="quitar" class="btn btn-danger">Quitar</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="id_convenio" class="col-sm-3 col-form-label">File input</label>
                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-append">
                                <span class="input-group-text fileinput-exists" data-dismiss="fileinput">Quitar</span>
                                <span class="input-group-text btn-file">
                                    <span class="fileinput-new">Seleccionar archivo</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="file" id="documento" name="documento">
                                </span>
                            </span>
                        </div>
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
        setSelectedIndex(document.getElementById("id_oferta_educativa"), "<?php echo $row['id_oferta_educativa']; ?>");
        setSelectedIndex(document.getElementById("id_nivel_academico"), "<?php echo $row['id_nivel_academico']; ?>");
        setSelectedIndex(document.getElementById("id_grupo"), "<?php echo $row['id_grupo']; ?>");
        setSelectedIndex(document.getElementById("id_materia"), "<?php echo $row['id_materia']; ?>");
    });
</script>