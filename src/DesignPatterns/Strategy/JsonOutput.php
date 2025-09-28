<?php

namespace DesignPatterns\Strategy;

/**
 * Estrategia concreta para formatear mensajes como JSON
 * Convierte el mensaje en un objeto JSON válido con metadatos
 */
class JsonOutput implements OutputStrategy
{
    /**
     * Formatea el mensaje como JSON válido
     * 
     * @param string $mensaje El mensaje a formatear
     * @return string El mensaje formateado como JSON
     */
    public function output(string $mensaje): string
    {
        $data = [
            'timestamp' => date('c'), // ISO 8601 format
            'type' => 'json_output',
            'message' => $mensaje,
            'length' => strlen($mensaje)
        ];

        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
