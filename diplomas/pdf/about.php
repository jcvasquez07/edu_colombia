<?php

fwrite($gestor, "2< Acerca de mí >");

if ($row_perfil['acerca_de'] != '') {
        fwrite($gestor, "\n\n");

    fwrite($gestor, "#X\n");
    fwrite($gestor, '$pdf->ezText(\'' . arreglar_texto_pdf($row_perfil['acerca_de']) . '\', 10, array(\'justification\'=>\'full\'));');

    fwrite($gestor, "\n");
    fwrite($gestor, "#x\n");
    fwrite($gestor, "\n");
} 