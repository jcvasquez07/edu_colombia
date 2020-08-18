<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Asignar Tarea</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
    <div>
        <a href="main.php?pagina=listado_tareas" type="button" class="btn btn-info">Volver al listado de Tareas</a>
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
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="asignar" class="btn btn-success">Asignar</button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
    <hr />
</div>

<div class="container-fluid">
    <?php
    if (isset($_POST['asignar'])) {
        $id_tarea = filter_input(INPUT_POST, 'id_tarea');
        $id_grupo = filter_input(INPUT_POST, 'id_grupo');

        // Buscamos los estudiantes en este grupo
        $query = "SELECT * FROM grupos_estudiante WHERE id_grupo = '$id_grupo'";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_assoc()) {
            // Asignamos la tarea al estudiante solamente si no la tiene ya asignada
            $query_buscar = "SELECT * FROM estudiantes_tareas WHERE id_estudiante = '$row[id_estudiante]' AND id_tarea = '$id_tarea'";
            $resultado_buscar = $mysqli->query($query_buscar);
            if (!$resultado_buscar->num_rows) {
                $query_insertar = "INSERT INTO estudiantes_tareas SET id_estudiante = '$row[id_estudiante]', id_tarea = '$id_tarea'";
                $resultado_insertar = $mysqli->query($query_insertar);
            }
        }

        // Ahora mostramos los resultados
        $query_mostrar = "SELECT 
                            CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) AS estudiante
                        FROM 
                            estudiantes_tareas, usuarios
                        WHERE 
                            estudiantes_tareas.id_estudiante = usuarios.id AND
                            estudiantes_tareas.id_tarea = '$id_tarea'";
        $resultado_mostrar = $mysqli->query($query_mostrar);
        ?>
        <h3>Se asignó la tarea a los siguientes estudiantes</h3>
        <table class="table table-hover table-striped">
            <thead>
            <th>#</th>
            <th>Nombre del Estudiante</th>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row_mostrar = $resultado_mostrar->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row_mostrar['estudiante']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>