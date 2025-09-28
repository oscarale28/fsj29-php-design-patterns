<?php

namespace DesignPatterns\Decorator\Armas;

use DesignPatterns\Decorator\Personajes\PersonajeJuego;

/**
 * Decorador concreto: Arco
 * Aumenta moderadamente el ataque con enfoque en precisión
 */
class ArcoDecorator extends ArmaDecorator
{
    public function __construct(PersonajeJuego $personaje)
    {
        parent::__construct($personaje, "Arco", 6, 1);
    }

    public function getDescripcion(): string
    {
        return parent::getDescripcion() . " (+6 ATK, +1 DEF)";
    }
}
