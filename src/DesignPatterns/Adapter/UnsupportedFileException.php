<?php

namespace DesignPatterns\Adapter;

use Exception;

/**
 * Excepción para archivos no compatibles
 * Se lanza cuando se intenta abrir un archivo que no es compatible con Windows 10
 */
class UnsupportedFileException extends Exception
{
    public function __construct(string $message = "Archivo no compatible", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Obtiene información detallada del error
     */
    public function getErrorInfo(): array
    {
        return [
            'error' => 'UnsupportedFileException',
            'mensaje' => $this->getMessage(),
            'codigo' => $this->getCode(),
            'archivo' => $this->getFile(),
            'linea' => $this->getLine()
        ];
    }
}
