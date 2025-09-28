<?php

namespace DesignPatterns\Decorator\Armas;

use Exception;

/**
 * Excepción para manejar armas incompatibles o errores en el sistema de decoradores
 */
class InvalidWeaponException extends Exception
{
    public function __construct(string $message = "Arma incompatible o inválida", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
