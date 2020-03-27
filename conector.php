<?php

if (preg_match("/conector.php/i", $_SERVER['PHP_SELF'])) {
    Header("Location: index.html");
    die();
}

// Parametros de conexion, adaptar a cada usuario
define('BD', 'jcprfvau_colombia');
define('USER', 'jcprfvau_colombia');
define('PASS', 'Pxq6;GSTE@sf');

$mysqli = new mysqli('localhost', USER, PASS, BD);
if ($mysqli->connect_error) {
    die('Error de Conexi&#243;n (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
