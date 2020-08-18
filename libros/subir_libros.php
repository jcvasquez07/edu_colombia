<?php
if (isset($_POST['subir_documentos'])) {
    $titulo = filter_input(INPUT_POST, 'titulo');
    $autor = filter_input(INPUT_POST, 'autor');
    $id_oferta_educativa = filter_input(INPUT_POST, 'id_oferta_educativa');
    $id_nivel_academico = filter_input(INPUT_POST, 'id_nivel_academico');
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');

    // Insertamos los datos
    $query = "INSERT INTO libros SET titulo = '$titulo', autor = '$autor', id_oferta_educativa = '$id_oferta_educativa', id_nivel_academico = '$id_nivel_academico', id_grupo = '$id_grupo'";
    $resultado = $mysqli->query($query);
    $last_id = $mysqli->insert_id;

    // La carpeta de destino es /documentos + id del vehículo
    $folder = "ebooks/";

    // Enviamos los archivos
    $error = '';
    $error_extension = FALSE;
    $error_subir = FALSE;


    $extension = getExtension(stripslashes($_FILES['documento']['name']));
    $archivos_error_extension = array();
    $archivos_error_subir = array();
    if (($extension != "pdf")) {
        $error_extension = TRUE;
        $archivos_error_extension[] = $_FILES['documento']['name'];
    } else {
        $origen = $_FILES["documento"]["tmp_name"];
        $destino = "$folder" . $_FILES["documento"]["name"];
        if (copy($origen, $destino)) {
            // insertamos la ruta al libro en la base de datos
            $query = "UPDATE libros set archivo = '$destino' WHERE id = '$last_id'";
            $resultado = $mysqli->query($query);
            $exito = TRUE;
        } else {
            $error_subir = TRUE;
            $archivos_error_subir[] = $origen;
        }
    }

    if ($error_extension) {
        $error .= '<br />No se reconocen los siguientes archivos (solo se permite PDF)';
        foreach ($archivos_error_extension as $value) {
            $error .= "<br />- " . $value;
        }
    }

    if ($error_subir) {
        $error .= '<br />Los siguientes archivos ocasionaron errores: ';
        foreach ($archivos_error_subir as $value) {
            $error .= "<br />- " . $value;
        }
    }

    if ($error != '') {
        // quitamos el primer <br /> (6 caracteres)
        $error = substr($error, 6);
    }


    $extension = getExtension(stripslashes($_FILES['foto_portada']['name']));
    $archivos_error_extension = array();
    $archivos_error_subir = array();
    if (($extension != "png") && ($extension != "jpg")) {
        $error_extension = TRUE;
        $archivos_error_extension[] = $_FILES['foto_portada']['name'];
    } else {
        $origen = $_FILES["foto_portada"]["tmp_name"];
        $destino = "$folder" . $_FILES["foto_portada"]["name"];
        if (copy($origen, $destino)) {
            // insertamos la ruta a la foto de portada en la base de datos
            $query = "UPDATE libros set foto_portada = '$destino' WHERE id = '$last_id'";
            $resultado = $mysqli->query($query);
            $exito = TRUE;
        } else {
            $error_subir = TRUE;
            $archivos_error_subir[] = $origen;
        }
    }

    if ($error_extension) {
        $error .= '<br />No se reconocen los siguientes archivos (solo se permite PDF)';
        foreach ($archivos_error_extension as $value) {
            $error .= "<br />- " . $value;
        }
    }

    if ($error_subir) {
        $error .= '<br />Los siguientes archivos ocasionaron errores: ';
        foreach ($archivos_error_subir as $value) {
            $error .= "<br />- " . $value;
        }
    }

    if ($error != '') {
        // quitamos el primer <br /> (6 caracteres)
        $error = substr($error, 6);
    }
}
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Subir Libros</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
    <div>
        <a href="main.php?pagina=galeria_libros" type="button" class="btn btn-info">Galer&#237;a de Libros</a>
    </div>
</div>

<div class="container-fluid">
    <div class="container">

        <!-- Mensaje de Error -->
        <?php
        if ($error != '') {
            ?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Error.</h4>
                        <p><?php echo $error; ?></p>
                    </div>
                </div>
            </div>
            <?php
            unset($error);  // limpiamos el mensaje de error
        }

        if ($exito) {
            ?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Exito. </h4>
                        <p>Los libros se subieron correctamente</p>
                    </div>
                </div>
            </div>
            <?php
            unset($exito);  // limpiamos
        }
        ?>

        <style type="text/css">
            #doc_preview{
                border: 1px solid #C0C0C0;
                padding: 10px;
                background: white;
            }
        </style>

        <!-- Formulario -->
        <div class="row">
            <div class="col">
                <!-- Card -->
                <div class="card mb-3">
                    <!-- card header -->
                    <div class="card-header bg-light">
                        <label class="text-danger my-3" style="font-weight:700">ADVERTENCIA! Se sobrescribirá cualquier archivo existente que tenga el mismo nombre que alguno de los archivos que se sube.</label>                   
                    </div>

                    <!-- Card body -->
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data">                           

                            <div class="form-group row">
                                <label for="titulo" class="col-sm-2 col-form-label">Titulo</label>
                                <div class="col-sm-9">
                                    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo del Libro" value="<?php echo $row['titulo']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="autor" class="col-sm-2 col-form-label">Autor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="autor" class="form-control" id="autor" placeholder="Titulo del Libro" value="<?php echo $row['autor']; ?>" required>
                                </div>
                            </div>

                            <!-- La oferta educativa proporciona el id de la oferta y el código de la materia (automático) -->
                            <div class="form-group row">
                                <label for="id_oferta_educativa" class="col-sm-2 col-form-label">Oferta Educativa</label>
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
                                <label for="id_nivel_academico" class="col-sm-2 col-form-label">Nivel Academico</label>
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
                                <label for="id_grupo" class="col-sm-2 col-form-label">Grupo</label>
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
                                <label for="id_grupo" class="col-sm-2 col-form-label">Foto de Portada</label>
                                <div class="col-sm-6"> 
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-outline-secondary btn-file">
                                                <span class="fileinput-new">Seleccionar imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" id="foto_portada" name="foto_portada">
                                            </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_grupo" class="col-sm-2 col-form-label">Archivo PDF</label>
                                <div class="col-sm-6"> 
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-append">
                                            <span class="input-group-text fileinput-exists" data-dismiss="fileinput">
                                                Quitar
                                            </span>

                                            <span class="input-group-text btn-file">
                                                <span class="fileinput-new">Seleccionar archivos</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" id="documento" name="documento" required>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" name='subir_documentos' value="Subir Libros"/>
                        </form>


                    </div>
                    <!-- Card body -->
                </div>
                <!-- Card -->
            </div>
        </div>
    </div>
</div>