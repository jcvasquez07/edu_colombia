<?php
if (isset($_POST['guardar'])) {
    // Esto se actualiza en la tabla de usuarios
    $id_oferta = filter_input(INPUT_POST, 'id_oferta');
    $nombre_oferta = arreglar_texto(filter_input(INPUT_POST, 'nombre_oferta'));
    $codigo_oferta = arreglar_texto(filter_input(INPUT_POST, 'codigo_oferta'));

    $query = "UPDATE ofertas_educativas SET nombre_oferta = '$nombre_oferta', codigo_oferta = '$codigo_oferta' WHERE id = '$id_oferta'";
    $resultado = $mysqli->query($query);
    if (!$mysqli->error) {
        echo $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">La informaci&#243;n se actualiz&#243; correctamente.<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        echo $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo actualizar la informaci&#243;n, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    }
}

if (isset($_POST['borrar'])) {
    $id_oferta = filter_input(INPUT_POST, 'id_oferta');
    $query = "DELETE FROM ofertas_educativas WHERE id = '$id_oferta'";
    $resultado = $mysqli->query($query);
    if (!$resultado) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo borrar el registro, el servidor dijo <strong>"' . $mysqli->error . '"<strong><button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        ?>
        <script>
            window.location.replace("main.php?pagina=listado_ofertas");
        </script>
        <?php
    }
}

$id_oferta = filter_input(INPUT_GET, 'id_oferta');
$query = "SELECT * FROM ofertas_educativas WHERE id = '$id_oferta'";
$resultado = $mysqli->query($query);
$row = $resultado->fetch_assoc();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Editar Oferta Educativa</h1>
            </div>
        </div>
        <div>
            <a href="main.php?pagina=listado_ofertas" type="button" class="btn btn-info">Volver al listado de Ofertas Educativas</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-4">
            <form method="POST" action="">
                <input type="hidden" name="id_oferta" value="<?php echo $id_oferta; ?>" />
                

                <div class="form-group row">
                    <label for="codigo_oferta" class="col-sm-3 col-form-label">C&#243;digo (dos letras)</label>
                    <div class="col-sm-1">
                        <input type="text" name="codigo_oferta" class="form-control" id="codigo_oferta" placeholder="" maxlength="2" value="<?php echo $row['codigo_oferta']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nombre_oferta" class="col-sm-3 col-form-label">Nombre de la Oferta Educativa</label>
                    <div class="col-sm-9">
                        <input type="text" name="nombre_oferta" class="form-control" id="nombre_oferta" placeholder="Nombre de la Oferta Educativa" value="<?php echo $row['nombre_oferta']; ?>" required>
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
                        <p>&#191;Esta seguro que desea borrar la oferta educativa <strong><?php echo $row['nombre_oferta']; ?></strong><p>
                        <p>Esta acci&#243;n es irreversible.</p>
                    </div>
                    <div class="modal-footer">

                        <form method="POST" action="">
                            <input type="hidden" name="id_oferta" value="<?php echo $id_oferta; ?>" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No borrar</button>
                            <button type="submit" name="borrar" class="btn btn-danger">Si, continuar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>