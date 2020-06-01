<?php
// La estructura de directorios será
// ./arcdhivos/tipo_usuario/id_usuario
// Ejemplo: ./archivos/estudiante/1/

$ruta = "./archivos/" . $tipo_usuario . "/" . $ultimo_id;
// Si el directorio no existe, lo creamos
if (!is_dir($ruta)) {
    // tratamos de crear el directorio solamente si no existe
    if (!mkdir($ruta, 0777, TRUE)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: No se pudo crear el directorio ' . $ruta . ' (¿probablemente un problema de permisos? Debe ser 0777)<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button></div>';
    }
}
