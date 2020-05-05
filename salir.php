<?php
// Cierra la sesión del usuario. Elimina todas las variables de sesion
// reenvía a index.html y cancela cualquier otro procesamiento
session_start();
session_unset();
session_destroy();
header("location:index.html");
die();

