<?php

function scaleimage($location, $maxw = NULL, $maxh = NULL) {
    $img = @getimagesize($location);
    if ($img) {
        $w = $img[0];
        $h = $img[1];

        $dim = array('w', 'h');
        foreach ($dim AS $val) {
            $max = "max{$val}";
            if (${$val} > ${$max} && ${$max}) {
                $alt = ($val == 'w') ? 'h' : 'w';
                $ratio = ${$alt} / ${$val};
                ${$val} = ${$max};
                ${$alt} = ${$val} * $ratio;
            }
        }
        return array((int) $w, (int) $h);
    }
}

function remover_horas($val) {
    if (preg_match('/HOR/i', $val)) {
        return $val;
    }
    return $val . ' HORAS';
}

function dias_habiles($fecha_inicial) {
    $fecha1 = date_create($fecha_inicial);
    $fecha2 = date_create(date('Y-m-d'));
    $intervalo = date_diff($fecha1, $fecha2);
    $dias_totales = $intervalo->format('%a');

    // Dias feriados oficiales
    // Semana Santa 2020: 04/09 y 04/10
    // Semana Santa 2021: 03/25 y 03/26
    // Semana Santa 2022: 04/14 y 04/15
    // Semana Santa 2023: 04/06 y 04/07
    $dias_feriados = array(
        '01-01', // Año nuevo
        '04-09', // Jueves Santo 2019
        '04-10', // Viernes Santo 2019
        '05-01', // Día del trabajo
        '06-30', // Día del Ejército
        '08-15', // Día de la Virgen de la Asunción
        '09-15', // Día de la Independencia
        '10-20', // Aniversario de la Revoklución de Octubre
        '11-01', // Día de los muertos
        '12-24', // Nochebuena
        '12-25', // Navidad
        '12-31'     // Noche vieja
    );

    // Dejamos fuera sabados y domingos
    $finde = array(0, 6); // 0: domingo, 6:sabado

    $restar = 0;
    for ($i = 1; $i <= $dias_totales; $i++) {
        date_add($fecha1, date_interval_create_from_date_string('1 days'));
        $dia_activo = date_format($fecha1, 'Y-m-d');
        $dia_semana = date_format($fecha1, 'w');
        $dia_finde = date_format($fecha1, 'D');
        $fecha = date_format($fecha1, 'm-d');
        if (in_array($dia_semana, $finde) OR in_array($fecha, $dias_feriados)) {
            // sabado o, domingo o día feriado quitamos un día
            $restar++;
        }
    }
    return str_pad($dias_totales - $restar, 2, "0", STR_PAD_LEFT);
}

function calcular_edad($fecha) {
// Calcula la edad en base a una fecha obtenida de la base de datos
// La fecha debe estar en formato AAAA-MM-DD
    $piezas = explode("-", $fecha);
    $edad = (int)date('Y') - (int)$piezas[0];
    if ((int)date('m') < (int)$piezas[1]) {
        $edad--;
    }
    if (date('m') == $piezas[1]) {
        if ((int)date('d') < (int)$piezas[2]) {
            $edad--;
        }
    }
    return $edad;
}

function arreglar_fecha($fecha, bool $leible = FALSE) {
    // Convierte fechas de tipo DATETIME (A-M-D h:m.s) a formato D-M-A h:m:s y vice versa
    // Si leible = TRUE, la fecha resultante es algo asi como 08 de Enero de 2013
    // (Esto ultimo solo es util cuando se lee de la base de datos)
    $fecha = str_replace("/", "-", $fecha);
    $piezas = explode(" ", $fecha);
    $partes = explode("-", $piezas[0]);
    if (!$leible) {
        $fecha_arreglada = $partes[2] . "-" . str_pad($partes[1], 2, "0", STR_PAD_LEFT) . "-" . str_pad($partes[0], 2, "0", STR_PAD_LEFT);
        if (isset($piezas[1])) {
            $fecha_arreglada .= " " . $piezas[1];
        }
    } else {
        // Este es el formato "leible" (Ej: 01 de abril de 2013)
        // La entrada debe venir directamente de la base de datos (AAAA-MM-DD)
        $mes = num2mes($partes[1]);
        $fecha_arreglada = $partes[2] . " de " . $mes . " de " . $partes[0];
    }
    return $fecha_arreglada;
}

function arreglar_texto($cadena, $todo = TRUE) {
// Arregla una cadena de texto para su almacenamiento en la base de datos
// De forma predeterminada, se convierte todo a mayusculas
// para almacenarlo en la base de datos
    if ($todo) {
        $patron = array(
            '/á/' => '&#193;', '/Á/' => '&#193;',
            '/é/' => '&#201;', '/É/' => '&#201;',
            '/í/' => '&#205;', '/Í/' => '&#205;',
            '/ó/' => '&#211;', '/Ó/' => '&#211;',
            '/ú/' => '&#218;', '/Ú/' => '&#218;',
            '/ñ/' => '&#209;', '/Ñ/' => '&#209;'
        );
        $texto = strtoupper(trim($cadena));
        $texto = preg_replace(array_keys($patron), array_values($patron), $texto);
        $texto = strtoupper(trim($texto));
    } else {
    // Para mantener el formato de frases en las noticias
        $patron = array(
            '/á/' => '&#225;', '/Á/' => '&#193;',
            '/é/' => '&#233;', '/É/' => '&#201;',
            '/í/' => '&#237;', '/Í/' => '&#205;',
            '/ó/' => '&#243;', '/Ó/' => '&#211;',
            '/ú/' => '&#250;', '/Ú/' => '&#218;',
            '/ñ/' => '&#241;', '/Ñ/' => '&#209;'
        );
        $texto = trim($cadena);
        $texto = preg_replace(array_keys($patron), array_values($patron), $texto);
        $texto = trim($texto);
    }
    return $texto;
}

function mostrar_lb($texto) {
    return preg_replace('/<BR \/>/i', '\n', $texto);
}

function arreglar_texto_pdf($texto) {
// Esto arregla el texto para mostrarse en el archivo PDF
    $patron = array(
        '/&#225;/' => 'á', '/&#193;/' => 'A',
        '/&#233;/' => 'é', '/&#201;/' => 'E',
        '/&#237;/' => 'í', '/&#205;/' => 'I',
        '/&#243;/' => 'ó', '/&#211;/' => 'O',
        '/&#250;/' => 'ú', '/&#218;/' => 'U',
        '/&#241;/' => 'ñ', '/&#209;/' => 'Ñ',
        '/&#151;/' => '-'
    );
    $texto = preg_replace(array_keys($patron), array_values($patron), $texto);
    $texto = preg_replace("/<br ?\/?>/i", "  ", $texto);
// 	return utf8_decode($texto);
    return ($texto);
}

function folder($codigo) {
    $partes = explode("-", $codigo);
    return "./archivos/" . $partes[0] . "/" . $codigo;
}

function getExtension($str) {
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return strtolower($ext);
}

function human_filesize($bytes, $decimals = 2) {
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'El archivo subido excede la directiva upload_max_filesize en php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'El archivo subido excede la directiva MAX_FILE_SIZE que fue especificada en el formulario HTML';
        case UPLOAD_ERR_PARTIAL:
            return 'El archivo subido fue sólo parcialmente cargado';
        case UPLOAD_ERR_NO_FILE:
            return 'No se envi&#243; ning&#250;n archivo';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Falta la carpeta temporal';
        case UPLOAD_ERR_CANT_WRITE:
            return 'No se pudo escribir el archivo en el disco';
        case UPLOAD_ERR_EXTENSION:
            return 'Una extensión de PHP detuvo la carga de archivos. No puede determinarse cual extensión causó la parada de la subida de archivos; el examen de la lista de extensiones cargadas con phpinfo() puede ayudar';
        default:
            return 'Error desconocido';
    }
}

function SetRandomPassword() {
// genera una clave aleatoria de 8 caracteres
    $pass = '';
    $chars = array(
        "1", "2", "3", "4", "5", "6", "7", "8", "9", "0",
        "a", "A", "b", "B", "c", "C", "d", "D", "e", "E",
        "f", "F", "g", "G", "h", "H", "i", "I", "j", "J",
        "k", "K", "l", "L", "m", "M", "n", "N", "o", "O",
        "p", "P", "q", "Q", "r", "R", "s", "S", "t", "T",
        "u", "U", "v", "V", "w", "W", "x", "X", "y", "Y",
        "z", "Z", "?", "*", "@", "!", "$", ")", "(", "%");

    $count = count($chars) - 1;

    srand((double) microtime() * 1000000);

    for ($i = 0; $i < 8; $i++) {
        $pass .= $chars[rand(0, $count)];
    }
    return($pass);
}

function arreglar_moneda($val) {
// Removemos todo después del punto
    $pos = strpos($val, ".");
    if ($pos !== false) {
        $val = substr($val, 0, ($pos - strlen($val)));
    }
// Removemos otros simbolos
    $simbolos = array('Q', 'q', ',');
    foreach ($simbolos as $sim) {
        $pos = strpos($val, $sim);
        if ($pos !== false) {
            $val = str_replace($sim, "", $val);
        }
    }
    return trim($val);
}

function num2mes($var) {
    switch ($var) {
        case '01':
            $mes = 'Enero';
            break;
        case '02':
            $mes = 'Febrero';
            break;
        case '03':
            $mes = 'Marzo';
            break;
        case '04':
            $mes = 'Abril';
            break;
        case '05':
            $mes = 'Mayo';
            break;
        case '06':
            $mes = 'Junio';
            break;
        case '07':
            $mes = 'Julio';
            break;
        case '08':
            $mes = 'Agosto';
            break;
        case '09':
            $mes = 'Septiembre';
            break;
        case '10':
            $mes = 'Octubre';
            break;
        case '11':
            $mes = 'Noviembre';
            break;
        case '12':
            $mes = 'Diciembre';
            break;
    }
    return $mes;
}
