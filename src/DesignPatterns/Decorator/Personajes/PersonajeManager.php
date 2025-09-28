<?php

namespace DesignPatterns\Decorator\Personajes;

use DesignPatterns\Decorator\Armas\EspadaDecorator;
use DesignPatterns\Decorator\Armas\ArcoDecorator;
use DesignPatterns\Decorator\Armas\EscudoDecorator;
use DesignPatterns\Decorator\Armas\InvalidWeaponException;



/**
 * Clase utilitaria para gestionar el sistema de decoradores
 * Permite agregar múltiples armas y validar compatibilidad
 */
class PersonajeManager
{
    private array $armasDisponibles = [
        'espada' => EspadaDecorator::class,
        'arco' => ArcoDecorator::class,
        'escudo' => EscudoDecorator::class
    ];

    /**
     * Agrega un arma al personaje
     */
    public function agregarArma(PersonajeJuego $personaje, string $tipoArma): PersonajeJuego
    {
        $tipoArma = strtolower($tipoArma);

        if (!isset($this->armasDisponibles[$tipoArma])) {
            throw new InvalidWeaponException("El arma '$tipoArma' no está disponible. Armas disponibles: " . implode(', ', array_keys($this->armasDisponibles)));
        }

        $claseArma = $this->armasDisponibles[$tipoArma];
        return new $claseArma($personaje);
    }

    /**
     * Agrega múltiples armas al personaje
     */
    public function agregarMultiplesArmas(PersonajeJuego $personaje, array $armas): PersonajeJuego
    {
        $personajeDecorado = $personaje;

        foreach ($armas as $arma) {
            $personajeDecorado = $this->agregarArma($personajeDecorado, $arma);
        }

        return $personajeDecorado;
    }

    /**
     * Obtiene información completa del personaje
     */
    public function obtenerInformacionCompleta(PersonajeJuego $personaje): array
    {
        return [
            'descripcion' => $personaje->getDescripcion(),
            'ataque' => $personaje->getAtaque(),
            'defensa' => $personaje->getDefensa(),
            'poder_total' => $personaje->getAtaque() + $personaje->getDefensa()
        ];
    }

    /**
     * Obtiene la lista de armas disponibles
     */
    public function getArmasDisponibles(): array
    {
        return array_keys($this->armasDisponibles);
    }

    /**
     * Valida si un arma es compatible (en este caso, todas las armas son compatibles)
     * Esta función puede extenderse para agregar lógica de compatibilidad más compleja
     */
    public function esArmaCompatible(PersonajeJuego $personaje, string $tipoArma): bool
    {
        // Por ahora, todas las armas son compatibles con todos los personajes
        // Esta lógica puede extenderse para agregar restricciones específicas
        return isset($this->armasDisponibles[strtolower($tipoArma)]);
    }
}
