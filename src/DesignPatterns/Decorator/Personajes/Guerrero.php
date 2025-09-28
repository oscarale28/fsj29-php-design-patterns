<?php

namespace DesignPatterns\Decorator\Personajes;

/**
 * Personaje base: Guerrero
 * Personaje equilibrado con buenas estadísticas de ataque y defensa
 */
class Guerrero implements PersonajeJuego
{
    public function getDescripcion(): string
    {
        return "Guerrero";
    }

    public function getAtaque(): int
    {
        return 15;
    }

    public function getDefensa(): int
    {
        return 12;
    }
}
