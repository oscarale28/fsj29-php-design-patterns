<?php

namespace DesignPatterns\Strategy;

/**
 * Interfaz para estrategias de salida de mensajes
 * Define el contrato que deben cumplir todas las estrategias concretas
 */
interface OutputStrategy
{
    /**
     * Procesa y formatea un mensaje según la estrategia específica
     * 
     * @param string $mensaje El mensaje a procesar
     * @return string El mensaje formateado según la estrategia
     */
    public function output(string $mensaje): string;
}
