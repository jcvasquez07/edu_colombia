<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Calificar Tarea</h1>
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

        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="id_tarea" class="col-sm-3 col-form-label">Tarea</label>
                    <div class="col-sm-6">    
                        <select class="form-control" id="id_tarea" name="id_tarea" required>
                            <option value=""> -- Seleccione -- </option>
                            <?php
                            $query_tarea = "SELECT * FROM tareas WHERE 1 ORDER BY nombre_tarea";
                            $resultado_tarea = $mysqli->query($query_tarea);
                            while ($row_tarea = $resultado_tarea->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_tarea['id']; ?>"><?php echo ucfirst($row_tarea['nombre_tarea']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 

                <!--
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
                -->

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="calificar" class="btn btn-success">Calificar</button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
    <hr />
</div>

<div class="container-fluid">
    <?php
    if (isset($_POST['calificar'])) {
        $id_tarea = filter_input(INPUT_POST, 'id_tarea');
//        $id_oferta_educativa = filter_input(INPUT_POST, 'id_oferta_educativa');
//        $id_nivel_academico = filter_input(INPUT_POST, 'id_nivel_academico');
//        $id_grupo = filter_input(INPUT_POST, 'id_grupo');
//        $id_materia = filter_input(INPUT_POST, 'id_materia');
        $query_mostrar = "SELECT 
                            estudiantes_tareas.*, grupos.nombre_grupo,                            
                            CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) AS estudiante
                        FROM
                            estudiantes_tareas, usuarios, tareas, grupos
                        WHERE
                            estudiantes_tareas.id_estudiante = usuarios.id AND
                            estudiantes_tareas.id_tarea = tareas.id AND
                            tareas.id_grupo = grupos.id AND
                            estudiantes_tareas.id_tarea = '1'";
        $resultado_mostrar = $mysqli->query($query_mostrar);
        ?>
        <h3>Estudiantes que tienen esta tarea asignada</h3>
        <form>
            <table class="table table-hover table-striped">
                <thead>
                <th>#</th>
                <th>Nombre del Estudiante</th>
                <th>Grupo</th>
                <th>Archivo</th>
                <th>Calificaci&#243;n</th>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row_mostrar = $resultado_mostrar->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $row_mostrar['estudiante']; ?></td>
                            <td><?php echo $row_mostrar['nombre_grupo']; ?></td>
                            <td></td>
                            <td><input class="form-control form-control-sm col-md-2" type="text" placeholder=""></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
        <?php
    }
    ?>
</div>