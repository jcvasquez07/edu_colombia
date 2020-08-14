<?php
if (isset($_POST['quitar'])) {
    $id_docente = filter_input(INPUT_POST, 'id_docente');
    $id_materia = filter_input(INPUT_POST, 'id_materia');
    $query = "DELETE FROM docentes_materias WHERE id_docente = '$id_docente' AND id_materia = '$id_materia'";
    $resultado = $mysqli->query($query);
}

$id_materia = filter_input(INPUT_GET, 'id_materia');
$query_materia = "SELECT nombre_materia FROM materias WHERE id = '$id_materia'";
$resultado_materia = $mysqli->query($query_materia);
$row_materia = $resultado_materia->fetch_assoc();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Docentes para la Materia <?php echo $row_materia['nombre_materia']; ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form class="form-inline" action="" method="POST">
        <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>">
        <select class="custom-select col-md-3 mb-4 mr-sm-4" id="id_docente" name="id_docente">
            <option selected>-- Seleccionar Docente --</option>
            <?php
            $query_docente = "SELECT id, CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) as nombre FROM usuarios WHERE rol = '5' ORDER BY nombre";
            $resultado_docente = $mysqli->query($query_docente);
            while ($row_docente = $resultado_docente->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_docente['id']; ?>"><?php echo $row_docente['nombre']; ?></option>
                <?php
            }
            ?>
        </select>
        <button type="submit" name="agregar_docente" class="btn btn-primary mb-4">Agregar Docente en esta Materia</button>
    </form>

    <?php
    if (isset($_POST['agregar_docente'])) {
        $id_docente = filter_input(INPUT_POST, 'id_docente');
        $id_materia = filter_input(INPUT_POST, 'id_materia');
        $query = "SELECT id FROM docentes_materias WHERE id_docente = '$id_docente' AND id_materia = '$id_materia'";
        $resultado = $mysqli->query($query);
        if (!$resultado->num_rows) {
            // Insertaqmos solo si no existe previamente
            $query = "INSERT INTO docentes_materias SET id_docente = '$id_docente', id_materia = '$id_materia'";
            $resultado = $mysqli->query($query);
        }
    }
    ?>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>     
                <th>Nombre</th>
                <td></td>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT 
                        usuarios.id, CONCAT_WS(' ', usuarios.nombre1, usuarios.nombre2, usuarios.apellido1, usuarios.apellido2) as nombre 
                    FROM 
                        usuarios, docentes_materias
                    WHERE
                        docentes_materias.id_docente = usuarios.id AND
                        docentes_materias.id_materia = '$id_materia'";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['nombre']; ?></td>

                        <td class="rowlink-skip">
                             <!--Button trigger modal--> 
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar<?php echo $row['id']; ?>">Quitar</button>
                             <!--Modal--> 
                            <div class="modal fade" id="modalBorrar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBorrarLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalBorrarLabel">Quitar docente</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Se va a quitar el docente <strong><?php echo strtoupper($row['nombre']); ?></strong> de la materia <?php echo $row_materia['nombre_materia']; ?>.<br />
                                            Si desea puede agregarlo nuevamente m&#225;s adelante.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id_docente" value="<?php echo $row['id']; ?>" />
                                                <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>" />
                                                <button type="submit" name="quitar" class="btn btn-danger">Quitar</button>
                                            </form>

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
