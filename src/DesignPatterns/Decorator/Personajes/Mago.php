<?php

namespace DesignPatterns\Decorator\Personajes;

/**
 * Personaje base: Mago
 * Personaje con alto ataque mágico pero baja defensa física
 */
class Mago implements PersonajeJuego
{
    public function getDescripcion(): string
    {
        return "Mago";
    }

    public function getAtaque(): int
    {
        return 20;
    }

    public function getDefensa(): int
    {
        return 8;
    }
}
