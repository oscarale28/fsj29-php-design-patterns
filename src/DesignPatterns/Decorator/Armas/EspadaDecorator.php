<?php

namespace DesignPatterns\Decorator\Armas;

use DesignPatterns\Decorator\Personajes\PersonajeJuego;

/**
 * Decorador concreto: Espada
 * Aumenta significativamente el ataque y proporciona algo de defensa
 */
class EspadaDecorator extends ArmaDecorator
{
    public function __construct(PersonajeJuego $personaje)
    {
        parent::__construct($personaje, "Espada", 8, 3);
    }

    public function getDescripcion(): string
    {
        return parent::getDescripcion() . " (+8 ATK, +3 DEF)";
    }
}
