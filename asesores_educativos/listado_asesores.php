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
                <h1 class="m-0 text-dark">Listado de Asesores Educativos</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-5">

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>      
                <th>Email</th>
                <th>Observaciones</th>
                <th>Activo</th>
                <th>Grupos</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT usuarios.*, roles.rol FROM usuarios, roles WHERE usuarios.rol = roles.id AND roles.id = 6 ORDER BY id";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                $nombre = $row['nombre1'] . " " . $row['nombre2'] . " " . $row['apellido1'] . " " . $row['apellido2'];
                ?>
                <tr>
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td><a href="main.php?pagina=grupos&id_asesor=<?php echo $row['id']; ?>&nombre=<?php echo $nombre; ?>"><?php echo $nombre; ?></a></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['activo']; ?></td>
                    <td><a href="#" class="btn btn-primary text-white">Grupos</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

