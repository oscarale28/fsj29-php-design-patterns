<?php

namespace DesignPatterns\Adapter;

/**
 * Clase para archivos de Windows 7
 * Representa archivos creados en versiones anteriores del sistema
 */
class Windows7File
{
    private string $nombre;
    private string $extension;
    private string $version = 'Windows 7';

    public function __construct(string $nombre, string $extension)
    {
        $this->nombre = $nombre;
        $this->extension = $extension;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Método específico de Windows 7 para abrir archivos
     */
    public function abrirEnWindows7(): string
    {
        return "Abriendo archivo {$this->nombre}.{$this->extension} en {$this->version}";
    }

    /**
     * Obtiene información del archivo en formato Windows 7
     */
    public function getInfo(): array
    {
        return [
            'nombre' => $this->nombre,
            'extension' => $this->extension,
            'version' => $this->version,
            'archivo_completo' => $this->nombre . '.' . $this->extension
        ];
    }
}
