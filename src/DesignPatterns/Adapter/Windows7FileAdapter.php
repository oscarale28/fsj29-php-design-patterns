<?php

namespace DesignPatterns\Adapter;

/**
 * Adaptador que hace compatibles los archivos de Windows 7 con Windows 10
 * Implementa el patrón Adapter para convertir la interfaz de Windows7File
 * a la interfaz CompatibleFile requerida por Windows 10
 */
class Windows7FileAdapter implements CompatibleFile
{
    private Windows7File $windows7File;
    private array $formatosCompatibles = ['doc', 'xls', 'ppt'];

    public function __construct(Windows7File $windows7File)
    {
        $this->windows7File = $windows7File;
    }

    /**
     * Adapta el método de apertura de Windows 7 para Windows 10
     */
    public function open(): string
    {
        if (!$this->isCompatible()) {
            throw new UnsupportedFileException(
                "No se puede adaptar el archivo '{$this->getName()}' de tipo '{$this->getType()}'"
            );
        }

        $extensionNueva = $this->convertirExtension($this->windows7File->getExtension());

        return "Archivo '{$this->getName()}.{$this->windows7File->getExtension()}' convertido a " .
            "'{$this->getName()}.{$extensionNueva}' y abierto en Windows 10";
    }

    /**
     * Obtiene la versión adaptada (Windows 10 compatible)
     */
    public function getVersion(): string
    {
        return "Windows 10 (adaptado desde " . $this->windows7File->getVersion() . ")";
    }

    /**
     * Obtiene el nombre del archivo
     */
    public function getName(): string
    {
        return $this->windows7File->getNombre();
    }

    /**
     * Obtiene el tipo de archivo convertido
     */
    public function getType(): string
    {
        return $this->convertirExtension($this->windows7File->getExtension());
    }

    /**
     * Verifica si el archivo puede ser adaptado
     */
    public function isCompatible(): bool
    {
        return in_array($this->windows7File->getExtension(), $this->formatosCompatibles);
    }

    /**
     * Convierte la extensión de Windows 7 al equivalente de Windows 10
     */
    private function convertirExtension(string $extensionOriginal): string
    {
        $mapeoExtensiones = [
            'doc' => 'docx',
            'xls' => 'xlsx',
            'ppt' => 'pptx'
        ];

        return $mapeoExtensiones[$extensionOriginal] ?? $extensionOriginal;
    }
}
