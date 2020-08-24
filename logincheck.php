<?php
// Cuando se usan sesiones, esto es lo primero que debe aparecer
session_start();

// Este archivo contiene la conexión a la base de datos
include 'conector.php';

// Obtenemos los datos que vienen del formulario y los limpiamos (sanitize)
// Las variables $email y $clave corresponden a los nombres de campos del formulario
$email = filter_input(INPUT_POST, 'email');
$clave = filter_input(INPUT_POST, 'clave');

// Clave para administrador: 'pass1
// Si queremos verla, quitar el comentario de la siguiente línea y comentar a partir
// de la línea 18 hasta el final. Luego ir al formulario de login y enviarlo
//echo "CLave del administrador: " . password_hash('pass1', PASSWORD_DEFAULT) . "<BR />";

// La consulta: buscamos en la tabla de usuarios una fila donde coincida el
// email de la base de datos con lo que se mandó
$query = "SELECT * FROM usuarios  WHERE email = '$email'";

// Ejecutamos la consulta. La variable $resultado contiene una matriz con una (o varias) filas
// En general puedes pensar que $resultado es el equivalente a una tabla
$resultado = $mysqli->query($query);

// Para que funcione, debe haber devuelto una sola fila (no permitimos emails repetidos)
if ($resultado->num_rows == 1) {
    // Si $resultado es el equivalente a una tabla, $fila sería una fila de esa tabla
    // y en este caso, solo habrá una fila
    $fila = $resultado->fetch_assoc();
    
    // Comparamos las claves. Para eso NO desciframos la clave de la base de datos
    // sino ciframos la que se mando. Ambas deben ser iguales. A eso se le llama
    // cifrado unidireccional.
    if (password_verify($clave, $fila['clave'])) {
        // Clave correcta, ¿está activo el usuario?
        // Comprobamos el valor de la columna llamada 'activo' para la fila que encontramos
        if ($fila['activo'] == 'SI') {
            // Ok, si está activo, entonces recuperamos valores que vamos a necesitar
            $_SESSION['logged'] = TRUE;            
            $_SESSION['usuario_id'] = $fila['id'];
            $_SESSION['nombre_usuario_logeado'] = $fila['nombre1'] . " " . $fila['nombre1']  . " " . $fila['apellido1'] . " " . $fila['apellido2'];
            $_SESSION['nombre_corto__usuario_logeado'] = $fila['nombre1'] . " " . $fila['apellido1'];
            // Los roles están en la tabla 'roles': 1 - administrador hasta 8 - estudiante
            $_SESSION['rol'] = $fila['rol'];
            
            //Y ahora nos vamos de aqui hacia main.php
            header("location:main.php");
            
            //Cancelamos cualquier procesamiento pendiente
            die();
        } else {
            // La cuenta fue desactivada, volvemos a login.php
            $_SESSION['login_error'] = 'Su cuenta se encuentra suspendida.';
            header("location:login.php");
        }
    } else {
        // Error: el usuario existe pero no es la clave correcta, volvemos a login.php
        $_SESSION['login_error'] = 'Clave o email incorrecto';
        header("location:login.php");
    }
} else {
    // a) el email aparece varias veces o b) no aparece en la tabla
    // En cualquier caso, es un error y volvemos a login.php
    $_SESSION['login_error'] = 'Email o clave incorrecta.';
    header("location:login.php");
}
