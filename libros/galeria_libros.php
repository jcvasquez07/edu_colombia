<!-- Titulo de la página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Galería de Libros</h1>
                <hr class="separador" />
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Gallery -->
    <div class="row">
        <?php
        $query = "SELECT * FROM libros WHERE 1 ORDER BY titulo";
        $resultado = $mysqli->query($query);
            while ($row = $resultado->fetch_assoc()) {
            for ($i = 1; $i <= 9; $i++) {
                ?>
                <div class="col-md-3 mx-auto">
                    <figure>
                        <div class="card" style="width: 18rem;">
                            <img src="<?php echo $row['foto_portada']; ?>" class="card-img-top" width="100" alt="portada">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['titulo']; ?></h5>
                                <p class="card-text"><?php echo $row['autor']; ?></p>
                                <a href="<?php echo $row['archivo']; ?>" target="_blank" class="btn btn-primary">Descargar</a>
                            </div>
                        </div>
                    </figure>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>