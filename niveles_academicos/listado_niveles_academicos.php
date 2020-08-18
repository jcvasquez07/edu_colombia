<?php
if (isset($_POST['borrar'])) {
    $id = filter_input(INPUT_POST, 'id');
    $query = "DELETE FROM niveles_academicos WHERE id = '$id'";
    $resultado = $mysqli->query($query);
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Niveles Acad&#233;micos</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=agregar_nivel_academico" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar Nivel Acad&#233;mico</a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre del Nivel Acad&#233;mico</th>
                <th>Oferta Educativa</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT niveles_academicos.*, ofertas_educativas.nombre_oferta FROM niveles_academicos, ofertas_educativas WHERE niveles_academicos.id_oferta = ofertas_educativas.id ORDER BY nombre_nivel_academico";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td>
                        <a href="main.php?pagina=editar_nivel_academico&id_nivel_academico=<?php echo $row['id']; ?>">
                            <?php echo $row['nombre_nivel_academico']; ?>
                        </a>
                    </td>
                    <td><?php echo $row['nombre_oferta']; ?></td>
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
                                        Se va a borrar el nivel acad&#233;mico <strong><?php echo strtoupper($row['nombre_nivel_academico']); ?></strong>,<br/>
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
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>
</div>














