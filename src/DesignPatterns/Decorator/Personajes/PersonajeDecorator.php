<?php

namespace DesignPatterns\Decorator\Personajes;

/**
 * Clase abstracta base para todos los decoradores de personajes
 */
abstract class PersonajeDecorator implements PersonajeJuego
{
    protected PersonajeJuego $personaje;

    public function __construct(PersonajeJuego $personaje)
    {
        $this->personaje = $personaje;
    }

    public function getDescripcion(): string
    {
        return $this->personaje->getDescripcion();
    }

    public function getAtaque(): int
    {
        return $this->personaje->getAtaque();
    }

    public function getDefensa(): int
    {
        return $this->personaje->getDefensa();
    }
}
