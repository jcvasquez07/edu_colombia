<?php

// El ancho de las columnas de la tabla
$ancho_tabla = 500;
$ancho_col1 = 200;

fwrite($gestor, '$pdf->ezTable($data,
	array(\'clave\'=>\'\', \'valor\'=>\'\'),
	\'\',
	array(\'showLines\'=>4, \'showHeadings\'=>0, \'shaded\'=>0, \'width\'=>' . $ancho_tabla . ', \'cols\'=>array(\'clave\'=>array(\'width\'=>' . $ancho_col1 . ')))
	);');
fwrite($gestor, "\n");