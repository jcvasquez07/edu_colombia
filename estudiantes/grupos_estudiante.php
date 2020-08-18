<?php
if (isset($_POST['quitar'])) {
    $id_estudiante = filter_input(INPUT_POST, 'id_estudiante');
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');
    $query = "DELETE FROM grupos_estudiante WHERE id_estudiante = '$id_estudiante' AND id_grupo = '$id_grupo'";
    $resultado = $mysqli->query($query);
}
$id_estudiante = filter_input(INPUT_GET, 'id_estudiante');
$nombre = filter_input(INPUT_GET, 'nombre');
?>

<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $nombre; ?></h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
    <div>
        <a href="main.php?pagina=listado_estudiantes" type="button" class="btn btn-info">Volver al listado de Estudiantes</a>
    </div>
</div>

<!-- Formulario -->
<div class="container-fluid">
    <h3>Asignar Grupo</h3>
    <form enctype="multipart/form-data" method="POST" action="">
        <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante; ?>" />
        <div class="row">
            <!-- Primera columna, el formulario -->
            <div class="col-md-6 mx-4">

                <div class="form-group row">
                    <label for="id_grupo" class="col-sm-3 col-form-label">Grupo</label>
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
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success">Actualizar</button>
                    </div>
                </div> 

            </div>
        </div>
    </form>
</div> 

<div class="container-fluid p-5">
    <?php
    if (isset($_POST['guardar'])) {
        $id_estudiante = filter_input(INPUT_POST, 'id_estudiante');
        $id_grupo = filter_input(INPUT_POST, 'id_grupo');

        $query = "SELECT id FROM grupos_estudiante WHERE id_estudiante = '$id_estudiante' AND id_grupo = '$id_grupo'";
        $resultado = $mysqli->query($query);
        if ($resultado->num_rows < 1) {
            $query = "INSERT INTO grupos_estudiante SET id_estudiante = '$id_estudiante', id_grupo = '$id_grupo'";
            $resultado = $mysqli->query($query);
        }
    }
    ?>
    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Grupo</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT grupos_estudiante.*, grupos.nombre_grupo FROM grupos_estudiante, grupos WHERE grupos_estudiante.id_grupo = grupos.id ORDER BY nombre_grupo";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td><?php echo $row['nombre_grupo']; ?></td>
                    <td class="rowlink-skip">
                        <!--Button trigger modal--> 
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar<?php echo $row['id']; ?>">Quitar</button>
                        <!--Modal--> 
                        <div class="modal fade" id="modalBorrar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBorrarLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalBorrarLabel">Quitar grupo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Se va a quitar el grupo <strong><?php echo strtoupper($row['nombre_grupo']); ?>.<br />
                                        Si desea puede agregarlo nuevamente m&#225;s adelante.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_estudiante" value="<?php echo $row['id_estudiante']; ?>" />
                                            <input type="hidden" name="id_grupo" value="<?php echo $row['id_grupo']; ?>" />
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
