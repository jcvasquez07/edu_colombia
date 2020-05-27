<?php
if (isset($_POST['guardar'])) {
    // Aqui van las variables que se recogen del formulario
//    $nombre = arreglar_texto(filter_input(INPUT_POST, 'nombre'));
//    $apellido1 = arreglar_texto(filter_input(INPUT_POST, 'apellido1'));
//    $apellido2 = arreglar_texto(filter_input(INPUT_POST, 'apellido2'));
//    $email = strtolower(arreglar_texto(filter_input(INPUT_POST, 'email')));
//    $observaciones = arreglar_texto(filter_input(INPUT_POST, 'observaciones'));
//    $rol = filter_input(INPUT_POST, 'rol');
//    $genero = filter_input(INPUT_POST, 'genero');

    // Consulta para insertar datos
//    $query = "INSERT INTO $tabla
//        SET nombre = '$nombre',
//            apellido1 = '$apellido1',
//            apellido2 = '$apellido2',
//            email = '$email',
//            clave = '$clave',
//            observaciones = '$observaciones',
//            rol = '$rol',
//            genero = '$genero'";
//    $resultado = $mysqli->query($query);

    // Comprobamos el resultado de la operación anterior
    if ($error = $mysqli->error) {
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
            <strong>La informaci&#243;n se agreg&#243; correctamente.</strong>
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
            </div>
        </div>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <div class="row">
        <!-- Primera columna, el formulario -->
        <div class="col-md-6 mx-4">
            <form method="POST" action="">

                <div class="form-group row">
                    <label for="nombre" class="col-sm-3 col-form-label">Nombres</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre1" class="form-control" id="nombre" placeholder="Primer Nombre" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="nombre2" class="form-control" id="nombre" placeholder="Otros Nombres" required>
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

                <div class="form-group row">
                    <label for="fecha_nacimiento" class="col-sm-3 col-form-label">Fecha de Nacimiento</label>
                    <div class="bfh-datepicker col-md-3" data-format="d-m-y" data-icon="" data-name="fecha_nacimiento" data-id="fecha_nacimiento"></div>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
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
                    <div class="col-sm-3">    
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
                    <div class="col-sm-3">    
                        <select class="form-control" id="acudiente" name="acudiente">
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM acudientes WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['nombre_acudiente']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <label for="coordinador" class="col-sm-2 offset-1 col-form-label">Coordinador</label>
                    <div class="col-sm-3">    
                        <select class="form-control" id="coordinador" name="coordinador">
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query = "SELECT * FROM coordinadores WHERE 1";
                            $resultado = $mysqli->query($query);
                            while ($row = $resultado->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['nombre_coordinador']); ?></option>
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
                    <label for="nombre_usuario" class="col-sm-3 col-form-label">Nombre de Usuario</label>
                    <div class="col-sm-3">
                        <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario" placeholder="Nombre de Usuario" required>
                    </div>
                    <label for="nombre_usuario" class="col-sm-2 col-form-label">Contrase&#241;a</label>
                    <div class="col-sm-4">
                        <input type="text" name="clave" class="form-control" id="clave" placeholder="Contrase&#241;a" required>
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
                </div> 

                <div class="form-group row">
                    <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                    <div class="col-sm-9">
                        <textarea name="observaciones" class="form-control" id="observaciones" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="guardar" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fas fa-save"></i>
                            </span>Agregar Estudiante
                        </button>
                    </div>
                </div>
            </form>
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
                        <input type="file" name="..."></span>
                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Quitar</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
