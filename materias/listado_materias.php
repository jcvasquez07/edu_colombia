<?php
if (isset($_POST['borrar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $query = "DELETE FROM materias WHERE id = '$id'";
    $resultado = $mysqli->query($query);
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Materias</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=agregar_materia" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar Materia</a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>C&#243;digo</th>      
                <th>Nombre</th>
                <th>Nivel Acad&#233;mico</th>
                <th>Oferta Educativa</th>
                <th>Aprobaci&#243;n Promedio</th>
                <th>Promedio Final</th>
                <th>Grupo</th>
                <th>Docente</th>
                <?php
                $haystack = array("1");
                if (in_array($_SESSION['rol'], $haystack)) {
                    ?>
                    <th></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT 
                        materias.* , ofertas_educativas.nombre_oferta, grupos.nombre_grupo, niveles_academicos.nombre_nivel_academico
                    FROM 
                        materias, ofertas_educativas, grupos, niveles_academicos
                    WHERE 
                        materias.id_oferta_educativa = ofertas_educativas.id AND
                        materias.id_grupo = grupos.id AND 
                        materias.id_nivel_academico = niveles_academicos.id
                    ORDER BY nombre_materia";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                $codigo_oferta = substr($row['codigo_materia'], 0, 2);
                $query1 = "SELECT nombre_oferta FROM ofertas_educativas WHERE codigo_oferta = '$codigo_oferta'";
                $resultado1 = $mysqli->query($query1);
                $row1 = $resultado1->fetch_assoc();
                ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['codigo_materia']; ?></td>
                    <td>
                        <?php
                        $haystack = array("1");
                        if (in_array($_SESSION['rol'], $haystack)) {
                            echo $row['nombre_materia'];
                        } else {
                            ?>
                            <a href="main.php?pagina=editar_materia&id_materia=<?php echo $row['id']; ?>">
                                <?php echo $row['nombre_materia']; ?>
                            </a>
                            <?php
                        }
                        ?>
                    </td>
                    <td><?php echo $row['nombre_nivel_academico']; ?></td>
                    <td><?php echo $row['nombre_oferta']; ?></td>
                    <td><?php echo $row['aprobacion_promedio']; ?></td>
                    <td><?php echo $row['promedio_final']; ?></td>
                    <td><?php echo $row['nombre_grupo']; ?></td>

                    <td><a href="main.php?pagina=docentes_materia&id_materia=<?php echo $row['id']; ?>" class=" text-white btn btn-primary">Ver Docentes</a></td>

                    <?php
                    $haystack = array("1");
                    if (in_array($_SESSION['rol'], $haystack)) {
                        ?>
                        <td class="rowlink-skip">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar<?php echo $row['id']; ?>">Borrar</button>
                            <!-- Modal -->
                            <div class="modal fade" id="modalBorrar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBorrarLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalBorrarLabel">Advertencia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Se va a borrar la materia <strong><?php echo strtoupper($row['nombre_materia']); ?></strong>,<br/>
                                            Esta acci&#243;n no puede deshacerse.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                                <button type="submit" name="borrar" class="btn btn-danger">Borrar</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td> 
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
