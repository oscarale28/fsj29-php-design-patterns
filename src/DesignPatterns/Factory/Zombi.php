<?php

namespace DesignPatterns\Factory;

/**
 * Personaje Zombi - Nivel difícil
 * Implementación concreta del personaje para nivel difícil
 */
class Zombi implements Personaje
{
    private string $nombre;
    private int $velocidad;

    public function __construct()
    {
        $this->nombre = "Zombi";
        $this->velocidad = 3; // Velocidad más lenta pero más resistente
    }

    /**
     * Ataque específico del zombi
     * @return string Descripción del ataque
     */
    public function atacar(): string
    {
        return "{$this->nombre} muerde ferozmente causando daño alto y posible infección";
    }

    /**
     * @return int Velocidad del zombi
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
