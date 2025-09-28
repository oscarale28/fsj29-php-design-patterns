<?php

namespace DesignPatterns\Adapter;

/**
 * Sistema Windows 10 que requiere archivos compatibles
 * Solo puede trabajar con archivos que implementen la interfaz CompatibleFile
 */
class Windows10
{
    private string $version = 'Windows 10';
    private array $archivosAbiertos = [];

    /**
     * Abre un archivo compatible en Windows 10
     */
    public function abrirArchivo(CompatibleFile $archivo): string
    {
        if (!$archivo->isCompatible()) {
            throw new UnsupportedFileException(
                "El archivo '{$archivo->getName()}' no es compatible con {$this->version}"
            );
        }

        $resultado = $archivo->open();
        $this->archivosAbiertos[] = $archivo->getName();

        return "Sistema {$this->version}: " . $resultado;
    }

    /**
     * Procesa múltiples archivos compatibles
     */
    public function procesarArchivos(array $archivos): array
    {
        $resultados = [];

        foreach ($archivos as $archivo) {
            if (!$archivo instanceof CompatibleFile) {
                $resultados[] = "Error: El archivo no implementa la interfaz CompatibleFile";
                continue;
            }

            try {
                $resultados[] = $this->abrirArchivo($archivo);
            } catch (UnsupportedFileException $e) {
                $resultados[] = "Error: " . $e->getMessage();
            }
        }

        return $resultados;
    }

    /**
     * Verifica si un archivo es compatible antes de abrirlo
     */
    public function verificarCompatibilidad(CompatibleFile $archivo): array
    {
        return [
            'nombre' => $archivo->getName(),
            'tipo' => $archivo->getType(),
            'version' => $archivo->getVersion(),
            'compatible' => $archivo->isCompatible(),
            'sistema_destino' => $this->version
        ];
    }

    /**
     * Obtiene estadísticas de uso
     */
    public function getEstadisticas(): array
    {
        return [
            'total_archivos_procesados' => count($this->archivosAbiertos),
            'archivos_recientes' => array_slice($this->archivosAbiertos, -5),
            'sistema' => $this->version
        ];
    }
}
