<?php

namespace DesignPatterns\Strategy;

/**
 * Estrategia concreta para mostrar mensajes en formato de consola
 * Formatea el mensaje como texto plano con timestamp
 */
class ConsoleOutput implements OutputStrategy
{
    /**
     * Formatea el mensaje para salida de consola
     * 
     * @param string $mensaje El mensaje a formatear
     * @return string El mensaje formateado para consola
     */
    public function output(string $mensaje): string
    {
        $timestamp = date('Y-m-d H:i:s');
        return "[{$timestamp}] CONSOLE: {$mensaje}";
    }
}
