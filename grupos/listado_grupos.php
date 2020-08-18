<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Grupos</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=agregar_grupo" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar Grupo</a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>      
                <th>Nombre del Grupo</th>
                <th>Estudiantes</th>
                <th>Asesores</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT * FROM grupos WHERE 1 ORDER BY nombre_grupo";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td scope="row"><?php echo ++$i; ?></td>

                    <td><a href="main.php?pagina=editar_grupo&id_grupo=<?php echo $row['id']; ?>"><?php echo $row['nombre_grupo']; ?></a></td>

                    <!-- Los estudiantes -->
                    <td class="rowlink-skip">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEstudiantes<?php echo $i; ?>">Estudiantes</button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalEstudiantes<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEstudiantesLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEstudiantesLabel">Estudiantes en el Grupo <?php echo $row['nombre_grupo']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        // Los estudiantes en este grupo
                                        $query_estudiantes = "SELECT CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) AS estudiante FROM usuarios, grupos_estudiante WHERE grupos_estudiante.id_estudiante = usuarios.id AND grupos_estudiante.id_grupo = '$row[id]'";
                                        $resultado_estudiantes = $mysqli->query($query_estudiantes);
                                        $estudiantes = '';
                                        $j = 0;
                                        while ($row_estudiantes = $resultado_estudiantes->fetch_assoc()) {
                                            $estudiantes .= "<br />" . ++$j . " - " . $row_estudiantes['estudiante'];
                                        }
                                        ?>
                                        Los estudiantes incluidos en este grupo son: <?php echo $estudiantes; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td> 

                    <!-- Los asesores educativos -->
                    <td class="rowlink-skip">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAsesores<?php echo $i; ?>">Asesores</button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalAsesores<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalAsesoresLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAsesoresLabel">Asesores en el Grupo <?php echo $row['nombre_grupo']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        // Los asesores en este grupo
                                        $query_asesores = "SELECT CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) AS asesor FROM usuarios, grupos_asesor WHERE grupos_asesor.id_asesor = usuarios.id AND grupos_asesor.id_grupo = '$row[id]'";
                                        $resultado_asesores = $mysqli->query($query_asesores);
                                        $no_asesores = FALSE;
                                        if ($resultado_asesores->num_rows) {
                                            $asesores = '';
                                            $j = 0;
                                            while ($row_asesores = $resultado_asesores->fetch_assoc()) {
                                                $asesores .= "<br />" . ++$j . " - " . $row_asesores['asesor'];
                                            }
                                            echo 'Los asesores de este grupo son: ' . $asesores;
                                        } else {
                                            ?>
                                            No se encontraron asesores asignados a este grupo.
                                            <?php
                                            $no_asesores = TRUE;
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