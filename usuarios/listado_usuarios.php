<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listado de Usuarios</h1>
                <p class="text-muted">[Click en la fila para editar / borrar]</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <a href="main.php?pagina=agregar_usuario" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar nuevo usuario</a></p>
        </div>
    </div>

    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>      
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Observaciones</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT usuarios.*, roles.rol FROM usuarios, roles WHERE usuarios.rol = roles.id ORDER BY id";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                $nombre = $row['nombre1'] . " " . $row['nombre2'] . " " . $row['apellido1'] . " " . $row['apellido2'];
                ?>
                <tr>
                    <th scope="row"><?php echo ++$i; ?></th>
                    <td><a href="main.php?pagina=editar_usuario&id_usuario=<?php echo $row['id']; ?>"><?php echo $nombre; ?></a></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['rol']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>