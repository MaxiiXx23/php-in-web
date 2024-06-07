<?php

use Dompdf\Dompdf;

require_once 'vendor/autoload.php';

// Inicializando um BUFFER e guardando-o
ob_start();
require "content-pdf.php";
// Capturar o BUFFER, adicionando na variável e limpando seu armazenamento.
$html = ob_get_clean();

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
