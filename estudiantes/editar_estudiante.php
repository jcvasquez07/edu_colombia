<!--
Este archivo complementa /usuarios/editar_usuario.php
Se incluye si estamos editando un estudiante
-->

<?php
// Necesitamos recuperar los datos de la tabla estudiantes.
// El valor de $id_usuario viene de 'usuarios/editar_usuario.php'
$query_estudiante = "SELECT * FROM estudiantes WHERE id_usuario = '$id_usuario'";
$resultado_estudiante = $mysqli->query($query_estudiante);
$row_estudiante = $resultado_estudiante->fetch_assoc();
?>

<div class="form-group row">
    <label for="lugar_nacimiento" class="col-sm-3 col-form-label">Lugar de Nacimiento</label>
    <div class="col-sm-9">
        <input type="text" name="lugar_nacimiento" class="form-control" id="lugar_nacimiento" placeholder="Lugar de Nacimiento" value="<?php echo $row_estudiante['lugar_nacimiento'] ?>">
    </div>
</div>  

<!-- Selector de Fechas -->
<div class="form-group row">
<?php
// Necesitamos la fecha en formato dd/mm/aaaa
$partes = explode("-", $row_estudiante['fecha_nacimiento']);
$fecha_nacimiento = str_pad($partes[2], 2, "0", STR_PAD_LEFT) . "/" . str_pad($partes[1], 2, "0", STR_PAD_LEFT) . "/" .  $partes[0];
?>
    <label for="fecha_nacimiento" class="col-sm-3 col-form-label">Fecha de Nacimiento</label>
    <div class="col-sm-3">
        <div class="input-group date">
            <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-autoclose="true" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalInstrucciones">
        Ayuda con el calendario
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalInstrucciones" tabindex="-1" role="dialog" aria-labelledby="modalInstruccionesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInstruccionesLabel">Como usar el Calendario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <ul>
                            <li>El selector de fechas se abre haciendo click sobre el campo de texto.</li>
                            <img src="dist/img/ayuda_calendario1.jpg" />
                            <li>Para cambiar de año mas rapidamente, hacer click en el numero del año</li>
                            <img src="dist/img/ayuda_calendario2.jpg" />
                            <li>Usar las flechas de direccion para cambiar de año o mes</li>
                            <img src="dist/img/ayuda_calendario3.jpg" />
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok, entendido</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="telefono" class="col-sm-3 col-form-label">Tel&#233;fono</label>
    <div class="col-sm-3">
        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Tel&#233;fono" value="<?php echo $row_estudiante['telefono'] ?>" required>
    </div>
</div>  

<div class="form-group row">
    <label for="direccion" class="col-sm-3 col-form-label">Direcci&#243;n de Residencia</label>
    <div class="col-sm-9">
        <textarea name="direccion" class="form-control" id="direccion" rows="3"><?php echo $row_estudiante['direccion'] ?></textarea>
    </div>
</div>     

<div class="form-group row">
    <label for="pais" class="col-sm-3 col-form-label">Pa&#237;s de Residencia</label>
    <div class="col-sm-9">
        <input type="text" name="pais" class="form-control" id="pais" placeholder="Pa&#237;s de Residencia" value="<?php echo $row_estudiante['pais'] ?>" required>
    </div>
</div>                         

<div class="form-group row">
    <label for="numero_identificacion" class="col-sm-3 col-form-label">N&#250;mero de Identificaci&#243;n</label>
    <div class="col-sm-9">
        <input type="text" name="numero_identificacion" class="form-control" id="numero_identificacion" placeholder="N&#250;mero de Identificaci&#243;n" value="<?php echo $row_estudiante['numero_identificacion'] ?>" required>
    </div>
</div>   

<div class="form-group row">
    <label for="tipo_identificacion" class="col-sm-3 col-form-label">Tipo de Identificaci&#243;n</label>
    <div class="col-sm-4">    
        <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required>
            <?php
            $query_tipoID = "SELECT * FROM tipos_identificaciones WHERE 1";
            $resultado_tipoID = $mysqli->query($query_tipoID);
            while ($row_tipoID = $resultado_tipoID->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_tipoID['id']; ?>" ><?php echo ucfirst($row_tipoID['tipo_identificacion']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="lugar_expedido" class="col-sm-3 col-form-label">Lugar de Expedici&#243;n del Documento</label>
    <div class="col-sm-9">
        <input type="text" name="lugar_expedido" class="form-control" id="lugar_expedido" placeholder="Lugar de Expedici&#243;n del Documento" value="<?php echo $row_estudiante['lugar_expedido']; ?>" required>
    </div>
</div>

<div class="form-group row">
    <label for="acudiente" class="col-sm-3 col-form-label">Acudiente</label>
    <div class="col-sm-3">    
        <select class="form-control" id="acudiente" name="acudiente">
            <?php
            $query_acudiente = "SELECT * FROM acudientes WHERE 1";
            $resultado_acudiente = $mysqli->query($query_acudiente);
            while ($row_acudiente = $resultado_acudiente->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_acudiente['id']; ?>"><?php echo ucfirst($row_acudiente['nombre_acudiente']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <label for="coordinador" class="col-sm-2 offset-1 col-form-label">Coordinador</label>
    <div class="col-sm-3">    
        <select class="form-control" id="coordinador" name="coordinador">
            <?php
            $query_coordinador = "SELECT * FROM coordinadores WHERE 1";
            $resultado_coordinador = $mysqli->query($query_coordinador);
            while ($row_coordinador = $resultado_coordinador->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_coordinador['id']; ?>"><?php echo ucfirst($row_coordinador['nombre_coordinador']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="programa_academico" class="col-sm-3 col-form-label">Programa Acad&#233;mico</label>
    <div class="col-sm-3">    
        <select class="form-control" id="programa_academico" name="programa_academico">
            <?php
            $query_programa_academico = "SELECT * FROM programas_academicos WHERE 1";
            $resultado_programa_academico = $mysqli->query($query_programa_academico);
            while ($row_programa_academico = $resultado_programa_academico->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_programa_academico['id']; ?>"><?php echo ucfirst($row_programa_academico['nombre_programa']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <label for="oferta_educativa" class="col-sm-2 offset-1 col-form-label">Oferta Educativa</label>
    <div class="col-sm-3">    
        <select class="form-control" id="oferta_educativa" name="oferta_educativa">
            <?php
            $query_oferta_educativa = "SELECT * FROM ofertas_educativas WHERE 1";
            $resultado_oferta_educativa = $mysqli->query($query_oferta_educativa);
            while ($row_oferta_educativa = $resultado_oferta_educativa->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_oferta_educativa['id']; ?>"><?php echo ucfirst($row_oferta_educativa['nombre_oferta']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>                

<div class="form-group row">                    
    <label for="grupo" class="col-sm-3 col-form-label">Grupo</label>
    <div class="col-sm-3">    
        <select class="form-control" id="grupo" name="grupo">
            <?php
            $query_grupo = "SELECT * FROM grupos WHERE 1";
            $resultado_grupo = $mysqli->query($query_grupo);
            while ($row_grupo = $resultado_grupo->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_grupo['id']; ?>"><?php echo ucfirst($row_grupo['nombre_grupo']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="materia_complementaria" class="col-sm-3 col-form-label">Materia Complementaria</label>
    <div class="col-sm-9">
        <input type="text" name="materia_complementaria" class="form-control" id="materia_complementaria" placeholder="Materia Complementaria" value="<?php echo $row_estudiante['materia_complementaria'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label for="genero" class="col-sm-3 col-form-label">G&#233;nero</label>
    <div class="col-sm-3">    
        <select class="form-control" id="genero" name="genero" required>
            <option value="M"> Masculino </option>
            <option value="F"> Femenino </option>
        </select>
    </div>

    <label for="grupo_sanguineo" class="col-sm-2 offset-1 col-form-label">Grupo Sangu&#237;neo</label>
    <div class="col-sm-3">    
        <select class="form-control" id="grupo_sanguineo" name="grupo_sanguineo" required>
            <option value="ap"> A+ </option>
            <option value="an"> A- </option>
            <option value="bp"> B+ </option>
            <option value="bn"> B- </option>
            <option value="op"> O+ </option>
            <option value="on"> O- </option>
            <option value="abp"> AB+ </option>
            <option value="abn"> AB- </option>
        </select>
    </div>
</div>   

<div class="form-group row">
    <label for="eps" class="col-sm-3 col-form-label">EPS</label>
    <div class="col-sm-3">
        <input type="text" name="eps" class="form-control" id="eps" placeholder="EPS" value="<?php echo $row_estudiante['eps']; ?>">
    </div>
    <label for="simat" class="col-sm-2 col-form-label">C&#243;digo SIMAT</label>
    <div class="col-sm-4">
        <input type="text" name="simat" class="form-control" id="simat" placeholder="C&#243;digo SIMAT" value="<?php echo $row_estudiante['simat']; ?>">
    </div>
</div> 

<div class="form-group row">
    <label for="estado" class="col-sm-3 col-form-label">Estado</label>
    <div class="col-sm-3">    
        <select class="form-control" id="estado" name="estado" required>
            <option value="matriculado"> Matriculado </option>
            <option value="retirado"> Retirado </option>
            <option value="reprobado"> Reprobado </option>
            <option value="promovido"> Promovido </option>
            <option value="graduado"> Graduado y Certificado </option>
        </select>
    </div>
</div> 

<!-- Hacemos que en los SELECT aparezca preseleccionada la opción que ya existe en la base de datos -->
<script>
    $(window).on("load", function () {
        setSelectedIndex(document.getElementById("tipo_identificacion"), "<?php echo $row_estudiante['id_tipo_identificacion']; ?>");
        setSelectedIndex(document.getElementById("acudiente"), "<?php echo $row_estudiante['id_acudiente']; ?>");
        setSelectedIndex(document.getElementById("coordinador"), "<?php echo $row_estudiante['id_coordinador']; ?>");
        setSelectedIndex(document.getElementById("programa_academico"), "<?php echo $row_estudiante['id_programa_academico']; ?>");
        setSelectedIndex(document.getElementById("oferta_educativa"), "<?php echo $row_estudiante['id_oferta_educativa']; ?>");
        setSelectedIndex(document.getElementById("grupo"), "<?php echo $row_estudiante['id_grupo']; ?>");
        setSelectedIndex(document.getElementById("genero"), "<?php echo $row_estudiante['genero']; ?>");
        setSelectedIndex(document.getElementById("grupo_sanguineo"), "<?php echo $row_estudiante['grupo_sanguineo']; ?>");
        setSelectedIndex(document.getElementById("estado"), "<?php echo $row_estudiante['estado']; ?>");
    });
</script>