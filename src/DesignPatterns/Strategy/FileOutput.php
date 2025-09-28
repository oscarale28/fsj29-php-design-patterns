<?php

namespace DesignPatterns\Strategy;

/**
 * Estrategia concreta para descargar mensajes como archivo TXT
 * Genera una descarga automática del mensaje en formato de archivo de texto
 */
class FileOutput implements OutputStrategy
{
    /**
     * Genera una descarga automática del mensaje como archivo TXT
     * 
     * @param string $mensaje El mensaje a descargar
     * @return string Información sobre la descarga generada
     */
    public function output(string $mensaje): string
    {
        $timestamp = date('Y-m-d_H-i-s');
        $filename = "mensaje_{$timestamp}.txt";

        $content = $mensaje;

        // Configurar headers para descarga automática
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($content));
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

            // Enviar el contenido del archivo
            echo $content;
            exit;
        }

        return "Descarga iniciada: {$filename} (" . strlen($content) . " bytes)";
    }
}
