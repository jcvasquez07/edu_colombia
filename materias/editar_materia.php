<?php
if (isset($_POST['guardar'])) {
    // Esto se actualiza en la tabla de usuarios
    $id_materia = filter_input(INPUT_POST, 'id_materia');
    $nombre_materia = arreglar_texto(filter_input(INPUT_POST, 'nombre_materia'));

    $query = "UPDATE materias SET nombre_materia = '$nombre_materia' WHERE id = '$id_materia'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        echo $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">La informaci&#243;n se actualiz&#243; correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        echo $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo actualizar la informaci&#243;n, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    }
}

if (isset($_POST['borrar'])) {
    $id_materia = filter_input(INPUT_POST, 'id_materia');
    $query = "DELETE FROM materias WHERE id = '$id_materia'";
    $resultado = $mysqli->query($query);
    if (!$resultado) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo borrar el registro, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        ?>
        <script>
            window.location.replace("main.php?pagina=listado_materias");
        </script>
        <?php
    }
}

$id_materia = filter_input(INPUT_GET, 'id_materia');
$query = "SELECT * FROM materias WHERE id = '$id_materia'";
$resultado = $mysqli->query($query);
$row = $resultado->fetch_assoc();
$codigo_oferta = substr($row['codigo_materia'], 0, 2);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Editar Materia</h1>
            </div>
        </div>
        <div>
            <a href="main.php?pagina=listado_materias" type="button" class="btn btn-info">Volver al listado de Materias</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-4">
            <form method="POST" action="">
                <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>" />

                <div class="form-group row">
                    <label for="nombre_materia" class="col-sm-3 col-form-label">Nombre de Materia</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_materia" class="form-control" id="nombre_materia" placeholder="Nombre de Materia" value="<?php echo $row['nombre_materia']; ?>" required>
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
                        <p>&#191;Esta seguro que desea borrar la materia <strong><?php echo $row['nombre_materia']; ?></strong><p>
                        <p>Esta acci&#243;n es irreversible.</p>
                    </div>
                    <div class="modal-footer">

                        <form method="POST" action="">
                            <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No borrar</button>
                            <button type="submit" name="borrar" class="btn btn-danger">Si, continuar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>