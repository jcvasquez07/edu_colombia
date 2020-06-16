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

    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">C&#243;digo</th>      
                <th scope="col">Nombre</th>
                <th scope="col">Nivel Acad&#233;mico</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            <?php
            $query = "SELECT * FROM materias WHERE 1 ORDER BY codigo_materia";
            $resultado = $mysqli->query($query);
            $i = 0;
            while ($row = $resultado->fetch_assoc()) {
                $codigo_oferta = substr($row['codigo_materia'], 0, 2);
                $query1 = "SELECT nombre_oferta FROM ofertas_educativas WHERE codigo_oferta = '$codigo_oferta'";
                $resultado1 = $mysqli->query($query1);
                $row1 = $resultado1->fetch_assoc();
                ?>
                <tr>
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td><?php echo $row['codigo_materia']; ?></td>
                    <td><a href="main.php?pagina=editar_materia&id_materia=<?php echo $row['id']; ?>"><?php echo $row['nombre_materia']; ?></a></td>
                    <td><?php echo $row1['nombre_oferta']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>