<?php

namespace DesignPatterns\Adapter;

/**
 * Interfaz para archivos compatibles con Windows 10
 * Define los métodos que debe implementar cualquier archivo compatible
 */
interface CompatibleFile
{
    /**
     * Abre el archivo en Windows 10
     */
    public function open(): string;

    /**
     * Obtiene la versión del archivo
     */
    public function getVersion(): string;

    /**
     * Obtiene el nombre del archivo
     */
    public function getName(): string;

    /**
     * Obtiene el tipo de archivo
     */
    public function getType(): string;

    /**
     * Verifica si el archivo es compatible con Windows 10
     */
    public function isCompatible(): bool;
}
