<?php

namespace DesignPatterns\Factory;

/**
 * Interfaz base para todos los personajes del juego
 * Define los métodos que deben implementar todos los personajes
 */
interface Personaje
{
    /**
     * Ejecuta el ataque del personaje
     * @return string Descripción del ataque realizado
     */
    public function atacar(): string;

    /**
     * Obtiene la velocidad del personaje
     * @return int Velocidad del personaje
     */
    public function getVelocidad(): int;

    /**
     * Obtiene el nombre del personaje
     * @return string Nombre del personaje
     */
    public function getNombre(): string;
}
