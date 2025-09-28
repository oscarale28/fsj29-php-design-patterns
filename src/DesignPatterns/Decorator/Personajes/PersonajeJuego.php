<?php

namespace DesignPatterns\Decorator\Personajes;

/**
 * Interfaz base para personajes del juego que pueden ser decorados
 */
interface PersonajeJuego
{
    /**
     * Obtiene la descripción del personaje
     */
    public function getDescripcion(): string;

    /**
     * Obtiene el valor de ataque del personaje
     */
    public function getAtaque(): int;

    /**
     * Obtiene el valor de defensa del personaje
     */
    public function getDefensa(): int;
}
