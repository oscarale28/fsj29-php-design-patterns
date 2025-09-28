<?php

namespace DesignPatterns\Decorator\Armas;

use DesignPatterns\Decorator\Personajes\PersonajeDecorator;
use DesignPatterns\Decorator\Personajes\PersonajeJuego;

/**
 * Decorador base para armas
 * Proporciona funcionalidad común para todos los decoradores de armas
 */
abstract class ArmaDecorator extends PersonajeDecorator
{
    protected string $nombreArma;
    protected int $bonusAtaque;
    protected int $bonusDefensa;

    public function __construct(PersonajeJuego $personaje, string $nombreArma, int $bonusAtaque = 0, int $bonusDefensa = 0)
    {
        parent::__construct($personaje);
        $this->nombreArma = $nombreArma;
        $this->bonusAtaque = $bonusAtaque;
        $this->bonusDefensa = $bonusDefensa;
    }

    public function getDescripcion(): string
    {
        return $this->personaje->getDescripcion() . " con " . $this->nombreArma;
    }

    public function getAtaque(): int
    {
        return $this->personaje->getAtaque() + $this->bonusAtaque;
    }

    public function getDefensa(): int
    {
        return $this->personaje->getDefensa() + $this->bonusDefensa;
    }

    /**
     * Obtiene el nombre del arma
     */
    public function getNombreArma(): string
    {
        return $this->nombreArma;
    }
}
