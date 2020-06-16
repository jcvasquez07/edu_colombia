<?php

if (isset($_POST['guardar'])) {
    // Esto se inserta en la tabla de usuarios
    $nombre1 = arreglar_texto(filter_input(INPUT_POST, 'nombre1'));
    $nombre2 = arreglar_texto(filter_input(INPUT_POST, 'nombre2'));
    $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
    $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
    $email = strtolower(arreglar_texto(filter_input(INPUT_POST, 'email')));
    $clave_texto = filter_input(INPUT_POST, 'clave_texto');
    $activo = filter_input(INPUT_POST, 'activo');
    $observaciones = arreglar_texto(filter_input(INPUT_POST, 'observaciones'));

    // Esto se inserta en la tabla de estudiantes
    $lugar_nacimiento = arreglar_texto(filter_input(INPUT_POST, 'lugar_nacimiento'));
    $fecha_nacimiento = arreglar_fecha(filter_input(INPUT_POST, 'fecha_nacimiento'));
    $telefono = filter_input(INPUT_POST, 'telefono');
    $direccion = arreglar_texto(filter_input(INPUT_POST, 'direccion'));
    $pais = arreglar_texto(filter_input(INPUT_POST, 'pais'));
    $numero_identificacion = arreglar_texto(filter_input(INPUT_POST, 'numero_identificacion'));
    $lugar_expedido = arreglar_texto(filter_input(INPUT_POST, 'lugar_expedido'));
    $materia_complementaria = arreglar_texto(filter_input(INPUT_POST, 'materia_complementaria'));
    $genero = filter_input(INPUT_POST, 'genero');
    $grupo_sanguineo = filter_input(INPUT_POST, 'grupo_sanguineo');
    $eps = arreglar_texto(filter_input(INPUT_POST, 'eps'));
    $simat = arreglar_texto(filter_input(INPUT_POST, 'simat'));
    $estado = filter_input(INPUT_POST, 'estado');
    $ingresado_por = $_SESSION['usuario_id'];
    $id_tipo_identificacion = filter_input(INPUT_POST, 'tipo_identificacion');
    $id_acudiente = filter_input(INPUT_POST, 'acudiente');
    $id_coordinador = filter_input(INPUT_POST, 'coordinador');
    $id_programa_academico = filter_input(INPUT_POST, 'programa_academico');
    $id_oferta_educativa = filter_input(INPUT_POST, 'oferta_educativa');
    $id_grupo = filter_input(INPUT_POST, 'grupo');

    $error = "";
    // Insertar en la tabla de usuarios. El rol será 8 (estudiante)
    $clave = password_hash($clave_texto, PASSWORD_DEFAULT);
    $query = "INSERT INTO usuarios
        SET nombre1 = '$nombre1',
            nombre2 = '$nombre2',
            apellido1 = '$apellido1',
            apellido2 = '$apellido2',
            email = '$email',
            clave = '$clave',
            observaciones = '$observaciones',
            rol = '8',
            activo = '$activo',
            creado_por = '$_SESSION[usuario_id]'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        $ultimo_id = $mysqli->insert_id;
    } else {
        $error = "No se pudo insertar en la tabla de usuarios. El servidor dijo: " . htmlspecialchars($mysqli->error);
    }

    // Se insertó correctamente, insertamos en la tabla de estudiantes
    if ($ultimo_id) {
        $query = "INSERT INTO estudiantes            
            SET lugar_nacimiento = '$lugar_nacimiento',
                fecha_nacimiento = '$fecha_nacimiento',
                telefono = '$telefono',
                direccion = '$direccion',
                pais = '$pais',
                numero_identificacion = '$numero_identificacion',
                lugar_expedido = '$lugar_expedido',
                materia_complementaria = '$materia_complementaria',
                genero = '$genero',
                grupo_sanguineo = '$grupo_sanguineo',
                eps = '$eps',
                simat = '$simat',
                estado = '$estado',
                id_tipo_identificacion = '$id_tipo_identificacion',
                id_acudiente = '$id_acudiente',
                id_coordinador = '$id_coordinador',
                id_programa_academico = '$id_programa_academico',
                id_oferta_educativa = '$id_oferta_educativa',
                id_grupo = '$id_grupo',
                id_usuario = '$ultimo_id'
                ";
        $resultado = $mysqli->query($query);
        if (!$mysqli->error) {
            // Se insertó correctamente el estudiante, procesamos la foto
            // Primero creamos el directorio
            $tipo_usuario = "estudiantes";
            include 'crear_directorio.php';

            // Ahora colocamos la foto
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                // Comprobamos la extension del archivo
                $extension = getExtension(stripslashes($_FILES['foto']['name']));
                if (($extension != "jpg") && ($extension != "jpeg")) {
                    echo "<div class='alert alert-danger' role='alert'>No se reconoce el tipo de archivo (" . strtoupper($extension) . "). Los tipos permitidos son JPG y JPEG.</div>";
                } else {
                    // Comprobamos que el archivo no sea mayor a 1MB
                    $size = filesize($_FILES['foto']['tmp_name']);
                    if ($size > MAX_SIZE * 1024) {
                        echo "<div class='alert alert-danger' role='alert'>El archivo es demasiado grande (" . human_filesize($size) . "). El tama&#241;o m&#225;ximo es 1MB.</div>";
                    } else {
                        // El archivo siempre se llamara "foto_personal"
                        $archivo = $ultimo_id . "/foto_personal." . $extension;
                        if (copy($_FILES['foto']['tmp_name'], $archivo)) {

                            echo "<div class='alert alert-success' role='alert'>El archivo se copi&#243; correctamente</div>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>No se pudo copiar el archivo.</div>";
                        }
                    }
                }
            } else {
                if ($_FILES['foto']['error'] != UPLOAD_ERR_OK) {
                    echo "<div class='alert alert-danger' role='alert'>Ocurri&#243; un error al tratar de subir el archivo. El servidor dijo: " . file_upload_error_message($_FILES['foto']['error']) . ".</div>";
                }
            }
        } else {
            $error = "No se pudo insertar en la tabla de estudiantes. El servidor dijo: " . htmlspecialchars($mysqli->error);
        }
    }




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
                <h1 class="m-0 text-dark">Agregar Nuevo Estudiante</h1>
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
                    <label for="nombre" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre1" class="form-control" id="nombre1" placeholder="Primer Nombre" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="nombre2" class="form-control" id="nombre2" placeholder="Otros Nombres" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-sm-3 col-form-label">Apellidos</label>
                    <div class="col-sm-4">
                        <input type="text" name="apellido1" class="form-control" id="apellido1" placeholder="Primer Apellido" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="apellido2" class="form-control" id="apellido2" placeholder="Segundo Apellido (colocar UA si no tiene)">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lugar_nacimiento" class="col-sm-3 col-form-label">Lugar de Nacimiento</label>
                    <div class="col-sm-9">
                        <input type="text" name="lugar_nacimiento" class="form-control" id="lugar_nacimiento" placeholder="Lugar de Nacimiento">
                    </div>
                </div>  

                <!-- Selector de Fechas -->
                <div class="form-group row">
                    <label for="fecha_nacimiento" class="col-sm-3 col-form-label">Fecha de Nacimiento</label>
                    <div class="col-sm-3">
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-autoclose="true" name="fecha_nacimiento">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalInstrucciones">
                        Ayuda con el calendario
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalInstrucciones" tabindex="-1" role="dialog" aria-labelledby="modalInstruccionesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalInstruccionesLabel">Como usar el Calendario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <ul>
                                            <li>El selector de fechas se abre haciendo click sobre el campo de texto.</li>
                                            <img src="dist/img/ayuda_calendario1.jpg" />
                                            <li>Para cambiar de año mas rapidamente, hacer click en el numero del año</li>
                                            <img src="dist/img/ayuda_calendario2.jpg" />
                                            <li>Usar las flechas de direccion para cambiar de año o mes</li>
                                            <img src="dist/img/ayuda_calendario3.jpg" />
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok, entendido</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefono" class="col-sm-3 col-form-label">Tel&#233;fono</label>
                    <div class="col-sm-3">
                        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Tel&#233;fono" required>
                    </div>
                    <label for="email" class="col-sm-1 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                </div>  

                <div class="form-group row">
                    <label for="direccion" class="col-sm-3 col-form-label">Direcci&#243;n de Residencia</label>
                    <div class="col-sm-9">
                        <textarea name="direccion" class="form-control" id="direccion" rows="3"></textarea>
                    </div>
                </div>     

                <div class="form-group row">
                    <label for="pais" class="col-sm-3 col-form-label">Pa&#237;s de Residencia</label>
                    <div class="col-sm-9">
                        <input type="text" name="pais" class="form-control" id="pais" placeholder="Pa&#237;s de Residencia" value="Colombia" required>
                    </div>
                </div>                         

                <div class="form-group row">
                    <label for="numero_identificacion" class="col-sm-3 col-form-label">N&#250;mero de Identificaci&#243;n</label>
                    <div class="col-sm-9">
                        <input type="text" name="numero_identificacion" class="form-control" id="numero_identificacion" placeholder="N&#250;mero de Identificaci&#243;n"n required>
                    </div>
                </div>   

                <div class="form-group row">
                    <label for="tipo_identificacion" class="col-sm-3 col-form-label">Tipo de Identificaci&#243;n</label>
                    <div class="col-sm-4">    
                        <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM tipos_identificaciones WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['tipo_identificacion']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lugar_expedido" class="col-sm-3 col-form-label">Lugar de Expedici&#243;n del Documento</label>
                    <div class="col-sm-9">
                        <input type="text" name="lugar_expedido" class="form-control" id="lugar_expedido" placeholder="Lugar de Expedici&#243;n del Documento" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="acudiente" class="col-sm-3 col-form-label">Acudiente</label>
                    <div class="col-sm-5">    
                        <select class="form-control" id="acudiente" name="acudiente">
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT id, CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) as nombre_acudiente FROM usuarios WHERE rol = '4' AND activo = 'SI'";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_acudiente']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">

                    <label for="coordinador" class="col-sm-3 col-form-label">Coordinador</label>
                    <div class="col-sm-5">    
                        <select class="form-control" id="coordinador" name="coordinador">
                            <option value=""> -- Seleccione -- </option>                            
                            <?php
                            $query = "SELECT id, CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) as nombre_coordinador FROM usuarios WHERE rol = '6' AND activo = 'SI'";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_coordinador']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="programa_academico" class="col-sm-3 col-form-label">Programa Acad&#233;mico</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="programa_academico" name="programa_academico">
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM programas_academicos WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['nombre_programa']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <label for="oferta_educativa" class="col-sm-2 offset-1 col-form-label">Oferta Educativa</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="oferta_educativa" name="oferta_educativa">
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
                    <label for="grupo" class="col-sm-3 col-form-label">Grupo</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="grupo" name="grupo">
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM grupos WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['nombre_grupo']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="materia_complementaria" class="col-sm-3 col-form-label">Materia Complementaria</label>
                    <div class="col-sm-9">
                        <input type="text" name="materia_complementaria" class="form-control" id="materia_complementaria" placeholder="Materia Complementaria" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="genero" class="col-sm-3 col-form-label">G&#233;nero</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="genero" name="genero" required>
                            <option value=""> -- Seleccione -- </option>
                            <option value="M"> Masculino </option>
                            <option value="F"> Femenino </option>
                            ?>
                        </select>
                    </div>

                    <label for="grupo_sanguineo" class="col-sm-2 offset-1 col-form-label">Grupo Sangu&#237;neo</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="grupo_sanguineo" name="grupo_sanguineo" required>
                            <option value=""> -- Seleccione -- </option>
                            <option value="ap"> A+ </option>
                            <option value="an"> A- </option>
                            <option value="bp"> B+ </option>
                            <option value="bn"> B- </option>
                            <option value="op"> O+ </option>
                            <option value="on"> O- </option>
                            <option value="abp"> AB+ </option>
                            <option value="abn"> AB- </option>
                            ?>
                        </select>
                    </div>
                </div>   

                <div class="form-group row">
                    <label for="eps" class="col-sm-3 col-form-label">EPS</label>
                    <div class="col-sm-3">
                        <input type="text" name="eps" class="form-control" id="eps" placeholder="EPS">
                    </div>
                    <label for="simat" class="col-sm-2 col-form-label">C&#243;digo SIMAT</label>
                    <div class="col-sm-4">
                        <input type="text" name="simat" class="form-control" id="simat" placeholder="C&#243;digo SIMAT">
                    </div>
                </div> 

                <div class="form-group row">
                    <?php
                    // Proponemos una contraseña generada aleatoriamente
                    ?>
                    <label for="clave_texto" class="col-sm-3 col-form-label">Contrase&#241;a</label>
                    <div class="col-sm-3">
                        <input type="text" name="clave_texto" class="form-control" id="clave_texto" placeholder="Contrase&#241;a" value="<?php echo SetRandomPassword(); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="matriculado"> Matriculado </option>
                            <option value="retirado"> Retirado </option>
                            <option value="reprobado"> Reprobado </option>
                            <option value="promovido"> Promovido </option>
                            <option value="graduado"> Graduado y Certificado </option>
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">    
                        <select class="form-control" id="activo" name="activo" required>
                            <option value="SI" selected> Activo </option>
                            <option value="NO"> Inactivo </option>
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                    <div class="col-sm-9">
                        <textarea name="observaciones" class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="guardar" class="btn btn-success"> Agregar Estudiante </button>
                    </div>
                </div>
            </div>  

            <div class="col-md-4 mx-2">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new img-thumbnail" style="width: 320px; height: 180px; background-image: url('./dist/img/no_foto.png')">
                    </div>
                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 320px; max-height: 240px;"></div>
                    <div>
                        <span class="btn btn-outline-secondary btn-file">
                            <span class="fileinput-new">Seleccionar archivo</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="foto"></span>
                        <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Quitar</a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

