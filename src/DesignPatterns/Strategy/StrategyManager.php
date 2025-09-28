<?php

namespace DesignPatterns\Strategy;

/**
 * Gestor de estrategias que permite cambiar dinámicamente entre diferentes
 * estrategias de salida y proporciona una estrategia por defecto
 */
class StrategyManager
{
    private MensajeContext $context;
    private array $strategies;
    private OutputStrategy $defaultStrategy;

    /**
     * Constructor que inicializa el gestor con las estrategias disponibles
     */
    public function __construct()
    {
        // Inicializar estrategias disponibles
        $this->strategies = [
            'console' => new ConsoleOutput(),
            'json' => new JsonOutput(),
            'file' => new FileOutput()
        ];

        // Establecer estrategia por defecto
        $this->defaultStrategy = $this->strategies['console'];
        $this->context = new MensajeContext($this->defaultStrategy);
    }

    /**
     * Cambia la estrategia activa por nombre
     * 
     * @param string $strategyName Nombre de la estrategia ('console', 'json', 'file')
     * @return bool True si el cambio fue exitoso, false si la estrategia no existe
     */
    public function setStrategy(string $strategyName): bool
    {
        if (isset($this->strategies[$strategyName])) {
            $this->context->setStrategy($this->strategies[$strategyName]);
            return true;
        }

        // Si la estrategia no existe, usar la por defecto
        $this->context->setStrategy($this->defaultStrategy);
        return false;
    }

    /**
     * Procesa un mensaje con la estrategia actual
     * 
     * @param string $mensaje El mensaje a procesar
     * @return string El mensaje procesado
     */
    public function procesarMensaje(string $mensaje): string
    {
        return $this->context->procesarMensaje($mensaje);
    }

    /**
     * Obtiene la lista de estrategias disponibles
     * 
     * @return array Lista de nombres de estrategias disponibles
     */
    public function getEstrategiasDisponibles(): array
    {
        return array_keys($this->strategies);
    }

    /**
     * Obtiene el nombre de la estrategia actual
     * 
     * @return string Nombre de la estrategia actual
     */
    public function getEstrategiaActual(): string
    {
        $currentStrategy = $this->context->getStrategy();

        foreach ($this->strategies as $nombre => $estrategia) {
            if ($estrategia === $currentStrategy) {
                return $nombre;
            }
        }

        return 'unknown';
    }
}
