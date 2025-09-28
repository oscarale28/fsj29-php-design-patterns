<?php

namespace DesignPatterns\Decorator\Armas;

use DesignPatterns\Decorator\Personajes\PersonajeJuego;

/**
 * Decorador concreto: Escudo
 * Aumenta significativamente la defensa con un pequeño bonus de ataque
 */
class EscudoDecorator extends ArmaDecorator
{
    public function __construct(PersonajeJuego $personaje)
    {
        parent::__construct($personaje, "Escudo", 2, 7);
    }

    public function getDescripcion(): string
    {
        return parent::getDescripcion() . " (+2 ATK, +7 DEF)";
    }
}
