<?php

namespace DesignPatterns\Strategy;

/**
 * Contexto que utiliza diferentes estrategias de salida para mensajes
 * Permite cambiar dinámicamente la forma en que se procesan los mensajes
 */
class MensajeContext
{
    private OutputStrategy $strategy;

    /**
     * Constructor que inicializa el contexto con una estrategia
     * 
     * @param OutputStrategy $strategy La estrategia inicial a usar
     */
    public function __construct(OutputStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Cambia la estrategia de salida dinámicamente
     * 
     * @param OutputStrategy $strategy La nueva estrategia a usar
     */
    public function setStrategy(OutputStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * Obtiene la estrategia actual
     * 
     * @return OutputStrategy La estrategia actualmente en uso
     */
    public function getStrategy(): OutputStrategy
    {
        return $this->strategy;
    }

    /**
     * Procesa un mensaje usando la estrategia actual
     * 
     * @param string $mensaje El mensaje a procesar
     * @return string El mensaje procesado según la estrategia actual
     */
    public function procesarMensaje(string $mensaje): string
    {
        return $this->strategy->output($mensaje);
    }
}
