<?php

require_once __DIR__ . '/vendor/autoload.php';

use DesignPatterns\Strategy\FileOutput;

// Verificar que se recibió un mensaje
if (empty($_GET['mensaje'])) {
    http_response_code(400);
    die('Error: No se proporcionó mensaje para descargar');
}

$mensaje = $_GET['mensaje'];

// Crear la estrategia de archivo y procesar la descarga
$fileOutput = new FileOutput();
$fileOutput->output($mensaje);

// Si llegamos aquí, significa que headers_sent() era true
// Esto no debería pasar en condiciones normales
http_response_code(500);
die('Error: No se pudo iniciar la descarga');
