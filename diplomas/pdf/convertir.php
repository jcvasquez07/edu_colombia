<?php

session_start();
// don't want any warnings turning up in the pdf code 
// if the server is set to 'anal' mode.
// error_reporting(7);
error_reporting(E_ALL);
set_time_limit(1800);

include '../ezpdf/Cezpdf.php';

// define a clas extension to allow the use of a callback 
// to get the table of contents, and to put the dots in the toc
class Creport extends Cezpdf {

    var $reportContents = array();

    function Creport($p, $o, $t, $op) {
        parent::__construct($p, $o, $t, $op);
    }

    function rf($info) {
        // this callback records all of the table of contents entries, 
        // it also places a destination marker there
        // so that it can be linked too
        $tmp = $info['p'];
        $lvl = $tmp[0];
        $lbl = rawurldecode(substr($tmp, 1));
        $num = $this->ezWhatPageNumber($this->ezGetCurrentPageNumber());
        $this->reportContents[] = array($lbl, $num, $lvl);
        $this->addDestination('toc' . (count($this->reportContents) - 1), 'FitH', $info['y'] + $info['height']);
    }

    function dots($info) {
        // draw a dotted line over to the right and put on a page number
        $tmp = $info['p'];
        $lvl = $tmp[0];
        $lbl = substr($tmp, 1);
        $xpos = 520;

        switch ($lvl) {
            case '1':
                $size = 16;
                $thick = 1;
                break;
            case '2':
                $size = 12;
                $thick = 0.5;
                break;
        }

        $this->saveState();
        $this->setLineStyle($thick, 'round', '', array(0, 10));
        $this->line($xpos, $info['y'], $info['x'] + 5, $info['y']);
        $this->restoreState();
        $this->addText($xpos + 5, $info['y'], $size, $lbl);
    }

}

$pdf = new Creport('letter', 'portrait', 'none', null);

$pdf->ezSetMargins(50, 70, 50, 50);

// put a line top and bottom on all the pages
$all = $pdf->openObject();
$pdf->saveState();
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->line(20, 40, 578, 40);
$pdf->line(20, 822, 578, 822);

// Las fuentes que usaremos
$mainFont = 'fonts/Helvetica.afm';
$codeFont = 'fonts/Courier.afm';
$pdf->selectFont($mainFont);

// El pie de pagina
$y_pie_pagina = 30;
$font_pie_pagina = 6;
$pdf->addText(50, $y_pie_pagina, $font_pie_pagina, getcwd());
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all, 'all');

// ---------------------------------------------------------
// Logo arriba, izquierda
$x_logo = 50;
$y_logo = $pdf->y - 100;
$pdf->addJpegFromFile($logo, $x_logo, $y_logo, 100, 0);

// Este encabezado debe moverse como una unidad
// Titulo
$x_titulo = 170;
$y_titulo = $pdf->y - 15;
$pdf->addText($x_titulo, $y_titulo, 20, $titulo);

// Titulo1
$x_titulo1 = $x_titulo + 170;
$y_titulo1 = $y_titulo - 25;
$pdf->addText($x_titulo1, $y_titulo1, 20, $titulo1);

// Titulo2
$x_titulo2 = $x_titulo + 70;
$y_titulo2 = $y_titulo - 45;
$pdf->addText($x_titulo2, $y_titulo2, 12, $titulo2);

//-----------------------------------------------------------
// Contenido del documento
$data = file($temp_file);

//$pdf->ezNewPage();
// $pdf->ezStartPageNumbers(500, 28, 10, '', '', 1);
// las variables $y_pie_pagina y $font_pie_pagina se definen en la sección 'Pie de Página' más arriba
$pdf->ezStartPageNumbers(500, $y_pie_pagina, $font_pie_pagina, '', '', 1);

$size = 10;
$height = $pdf->getFontHeight($size);
$textOptions = array('justification' => 'full');
$collecting = 0;
$code = '';

foreach ($data as $line) {
    // go through each line, showing it as required, if it is surrounded by '<>' then
    // assume that it is a title
    $line = chop($line);
    if (strlen($line) && $line[0] == '#') {
        // comment, or new page request
        switch ($line) {
            case '#NP':
                $pdf->ezNewPage();
                break;
            case '#C':
                $pdf->selectFont($codeFont);
                $textOptions = array('justification' => 'left', 'left' => 20, 'right' => 20);
                $size = 10;
                break;
            case '#c':
                $pdf->selectFont($mainFont);
                $textOptions = array('justification' => 'full');
                $size = 12;
                break;
            case '#X':
                $collecting = 1;
                break;
            case '#x':
                $pdf->saveState();
                eval($code);
                $pdf->restoreState();
                $pdf->selectFont($mainFont);
                $code = '';
                $collecting = 0;
                break;
        }
    } else if ($collecting) {
        $code .= $line;
    } else if (((strlen($line) > 1 && $line[1] == '<') ) && $line[strlen($line) - 1] == '>') {
        // then this is a title
        switch ($line[0]) {
            case '1':
                $tmp = substr($line, 2, strlen($line) - 3);
                $tmp2 = $tmp . '<C:rf:1' . rawurlencode($tmp) . '>';
                $pdf->ezText($tmp2, 26, array('justification' => 'centre'));
                break;
            default:
                $tmp = substr($line, 2, strlen($line) - 3);
                // add a grey bar, highlighting the change
                $tmp2 = $tmp . '<C:rf:2' . rawurlencode($tmp) . '>';
                $pdf->transaction('start');
                $ok = 0;
                while (!$ok) {
                    $thisPageNum = $pdf->ezPageCount;
                    $pdf->saveState();
                    // esta línea es el color de fondo de los titulos
                    // original: $pdf->setColor(0.9, 0.9, 0.9);
                    $pdf->setColor(1.0, 1.0, 1.0);
                    $pdf->filledRectangle($pdf->ez['leftMargin'], $pdf->y - $pdf->getFontHeight(18) + $pdf->getFontDecender(18), $pdf->ez['pageWidth'] - $pdf->ez['leftMargin'] - $pdf->ez['rightMargin'], $pdf->getFontHeight(18));
                    $pdf->restoreState();
                    $pdf->ezText($tmp2, 18, array('justification' => 'left'));
                    if ($pdf->ezPageCount == $thisPageNum) {
                        $pdf->transaction('commit');
                        $ok = 1;
                    } else {
                        // then we have moved onto a new page, bad bad, as the background colour will be on the old one
                        $pdf->transaction('rewind');
                        $pdf->ezNewPage();
                    }
                }
                break;
        }
    } else {
        // then this is just text
        // the ezpdf function will take care of all of the wrapping etc.
        $pdf->ezText($line, $size, $textOptions);
    }
}

$pdf->ezStopPageNumbers(1, 1);
$pdf->ezStream();
