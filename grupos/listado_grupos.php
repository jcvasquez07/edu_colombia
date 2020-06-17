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
            <a href="main.php?pagina=agregar_grupo" class="btn btn-success mb-2" role="button" aria-pressed="true">Agregar Materia</a></p>
        </div>
    </div>

    <table class="table table-hover" id="dt_listado">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>      
                <th scope="col">Nombre del Grupo</th>
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
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>