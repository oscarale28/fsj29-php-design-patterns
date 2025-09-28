<?php

namespace DesignPatterns\Factory;

use Exception;

/**
 * Excepción para niveles de dificultad no válidos
 */
class InvalidLevelException extends Exception
{
    public function __construct(string $nivel)
    {
        parent::__construct("Nivel de dificultad no válido: '{$nivel}'. Los niveles válidos son: 'fácil', 'difícil'");
    }
}
