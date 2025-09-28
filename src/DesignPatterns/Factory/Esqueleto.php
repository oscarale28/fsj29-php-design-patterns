<?php

namespace DesignPatterns\Factory;

/**
 * Personaje Esqueleto - Nivel fácil
 * Implementación concreta del personaje para nivel fácil
 */
class Esqueleto implements Personaje
{
    private string $nombre;
    private int $velocidad;

    public function __construct()
    {
        $this->nombre = "Esqueleto";
        $this->velocidad = 5; // Velocidad moderada para nivel fácil
    }

    /**
     * Ataque específico del esqueleto
     * @return string Descripción del ataque
     */
    public function atacar(): string
    {
        return "{$this->nombre} ataca con sus huesos afilados causando daño moderado";
    }

    /**
     * @return int Velocidad del esqueleto
     */
    public function getVelocidad(): int
    {
        return $this->velocidad;
    }

    /**
     * @return string Nombre del personaje
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }
}
