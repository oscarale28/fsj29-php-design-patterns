<?php

namespace DesignPatterns\Factory;

/**
 * Factory para crear personajes según el nivel de dificultad
 * Implementa el patrón Factory Method
 */
class PersonajeFactory
{
    /**
     * Crea un personaje según el nivel de dificultad especificado
     * 
     * @param string $nivel Nivel de dificultad ("fácil" o "difícil")
     * @return Personaje Instancia del personaje creado
     * @throws InvalidLevelException Si el nivel no es válido
     */
    public static function crearPersonaje(string $nivel): Personaje
    {
        // Normalizar el nivel a minúsculas para comparación
        $nivelNormalizado = strtolower(trim($nivel));

        switch ($nivelNormalizado) {
            case 'fácil':
            case 'facil': // Permitir sin tilde también
                return new Esqueleto();

            case 'difícil':
            case 'dificil': // Permitir sin tilde también
                return new Zombi();

            default:
                throw new InvalidLevelException($nivel);
        }
    }

    /**
     * Obtiene los niveles válidos disponibles
     * 
     * @return array Lista de niveles válidos
     */
    public static function getNivelesValidos(): array
    {
        return ['fácil', 'difícil'];
    }
}
