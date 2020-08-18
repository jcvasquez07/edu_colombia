<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Tareas</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=agregar_tarea" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar Tarea</a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>      
                <th>Nombre de la Tarea</th>
                <th>Descripci&#243;n</th>
                <th>Fecha de Entrega</th>
                <th>Oferta Educativa</th>
                <th>Nivel Academico</th>
                <th>Grupo</th>
                <th>Asignatura</th>
                <th>Archivos</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT 
                        tareas.id, tareas.nombre_tarea, tareas.descripcion_tarea, tareas.fecha_entrega, 
                        ofertas_educativas.nombre_oferta, niveles_academicos.nombre_nivel_academico, 
                        grupos.nombre_grupo, materias.nombre_materia
                    FROM 
                        `tareas`, ofertas_educativas, niveles_academicos, grupos, materias
                    WHERE 
                        tareas.id_oferta_educativa = ofertas_educativas.id AND
                        tareas.id_nivel_academico = niveles_academicos.id AND
                        tareas.id_grupo = grupos.id AND
                        tareas.id_materia = materias.id";
            $resultado = $mysqli->query($query);
            $j = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ++$j; ?></td>

                    <td><a href="main.php?pagina=editar_tarea&id_tarea=<?php echo $row['id']; ?>"><?php echo $row['nombre_tarea']; ?></a></td>

                    <td><?php echo $row['descripcion_tarea']; ?></td>
                    <td><?php echo $row['fecha_entrega']; ?></td>
                    <td><?php echo $row['nombre_oferta']; ?></td>
                    <td><?php echo $row['nombre_nivel_academico']; ?></td>
                    <td><?php echo $row['nombre_grupo']; ?></td>
                    <td><?php echo $row['nombre_materia']; ?></td>

                    <td class="rowlink-skip">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDocumentos<?php echo $row['id']; ?>">
                            <i class="far fa-file-pdf"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDocumentos<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalDocumentosLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDocumentosLabel">Documentos para esta tarea</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $directorio = "archivos_tarea/" . $row['id'] . "/";
                                        if (is_dir($directorio)) {
                                            $ficheros = scandir($directorio);
                                            if (count($ficheros) >= 3) {
                                                echo '<p>Haga click en el nombre del documento para verlo:</p>';
                                                // $i = 2 porque 0 = '.' (directorio actual) y '1' = '..' (directorio superior)
                                                for ($i = 2; $i < count($ficheros); $i++) {
                                                    $src = $directorio . "/" . $ficheros[$i];
                                                    ?>
                                                    <a href="<?php echo $src; ?>" target="_blank"><?php echo $ficheros[$i]; ?></a><br />
                                                    <?php
                                                }
                                            } else {
                                                echo '<p>No se encontraron archivos para esta tarea</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>