<?php
if (isset($_POST['guardar'])) {
    // Esto se actualiza en la tabla de usuarios
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');
    $nombre_grupo = arreglar_texto(filter_input(INPUT_POST, 'nombre_grupo'));

    $query = "UPDATE grupos SET nombre_grupo = '$nombre_grupo' WHERE id = '$id_grupo'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        echo $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">La informaci&#243;n se actualiz&#243; correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        echo $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo actualizar la informaci&#243;n, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    }
}

if (isset($_POST['borrar'])) {
    $id_grupo = filter_input(INPUT_POST, 'id_grupo');
    $query = "DELETE FROM grupos WHERE id = '$id_grupo'";
    $resultado = $mysqli->query($query);
    if (!$resultado) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo borrar el registro, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        ?>
        <script>
            window.location.replace("main.php?pagina=listado_grupos");
        </script>
        <?php
    }
}

$id_grupo = filter_input(INPUT_GET, 'id_grupo');
$query = "SELECT * FROM grupos WHERE id = '$id_grupo'";
$resultado = $mysqli->query($query);
$row = $resultado->fetch_assoc();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Editar Materia</h1>
            </div>
        </div>
        <div>
            <a href="main.php?pagina=listado_grupos" type="button" class="btn btn-info">Volver al listado de Grupos</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-4">
            <form method="POST" action="">
                <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>" />

                <div class="form-group row">
                    <label for="nombre_grupo" class="col-sm-3 col-form-label">Nombre del Grupo</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" placeholder="Nombre del Grupo" value="<?php echo $row['nombre_grupo']; ?>" required>
                    </div>
                </div> 

                <div class="form-group row">
                    <div class="col-sm-10 offset-3">
                        <button type="submit" name="guardar" class="btn btn-success"> Guardar Cambios </button>
                    </div>
                </div> 

                <div class="form-group row">
                    <?php
                    // El botón de borrado solo le aparecerá a los administradores
                    if ($_SESSION['rol'] == 1) {
                        ?>
                        <div class="col-sm-5 offset-3">
                            <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalBorrar"> Borrar </button>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>

        <!-- Modal para Confirmar el Borrado -->
        <div class="modal" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="modalBorrarTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle" style="color: red">¡Advertencia de Borrado!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>&#191;Esta seguro que desea borrar el grupo <strong><?php echo $row['nombre_grupo']; ?></strong><p>
                        <p>Esta acci&#243;n es irreversible.</p>
                    </div>
                    <div class="modal-footer">

                        <form method="POST" action="">
                            <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No borrar</button>
                            <button type="submit" name="borrar" class="btn btn-danger">Si, continuar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>