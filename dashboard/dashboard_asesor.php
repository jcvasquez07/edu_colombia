<?php
$id_grupo = 1; // esto se tomará del login
$query = "SELECT roles.rol, COUNT(usuarios.rol) AS cantidad FROM usuarios, roles WHERE usuarios.rol = roles.id GROUP BY roles.rol";
$resultado = $mysqli->query($query);
$rol = array();
while ($row = $resultado->fetch_assoc()) {
    $rol[preg_replace('/ /', '_', $row['rol'])] = $row['cantidad'];
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard Asesor Educativo</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid">

    <div class="row">    
        <!-- Estudiantes -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT * FROM estudiantes WHERE id_coordinador = '$_SESSION[usuario_id]'";
                        $resultado = $mysqli->query($query);
                        $cantidad_estudiantes = $resultado->num_rows;
                        echo ($cantidad_estudiantes) ? $cantidad_estudiantes : '0';
                        ?>
                    </h3>
                    <p>Estudiantes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">M&#225;s informaci&#243;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./Estudiantes -->

        <!-- Acudientes -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT id_acudiente FROM estudiantes WHERE id_grupo = '$id_grupo'";
                        $resultado = $mysqli->query($query);
                        $cantidad_acudientes = $resultado->num_rows;
                        echo ($cantidad_acudientes) ? $cantidad_acudientes : '0';
                        ?>
                    </h3>
                    <p>Acudientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">M&#225;s informaci&#243;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./Acudientes -->

        <!-- Coordinadores -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT
                                    grupos_asesor.id AS ga, materias.id AS materia, docentes_materias.id_docente as docente
                                FROM grupos_asesor, materias, docentes_materias
                                WHERE
                                docentes_materias.id_materia = materias.id AND
                                materias.id_grupo = grupos_asesor.id_grupo AND
                                grupos_asesor.id_grupo = '$id_grupo'";
                        $resultado = $mysqli->query($query);
                        $cantidad_asesores = $resultado->num_rows;
                        echo ($cantidad_asesores) ? $cantidad_asesores : '0';
                        ?>
                    </h3>
                    <p>Docentes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">M&#225;s informaci&#243;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./Coordinadores -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT COUNT(id) AS cantidad FROM docentes_materias WHERE id_docente = '$_SESSION[usuario_id]'";
                        $resultado = $mysqli->query($query);
                        $row = $resultado->fetch_assoc();
                        echo ($row['cantidad']) ? $row['cantidad'] : '0';
                        ?>
                    </h3>
                    <p>Materias</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">M&#225;s informaci&#243;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

    </div>
    <!-- /.row -->
