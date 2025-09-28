<?php

require_once __DIR__ . '/vendor/autoload.php';

use DesignPatterns\Factory\PersonajeFactory;
use DesignPatterns\Factory\InvalidLevelException;
use DesignPatterns\Adapter\Windows7File;
use DesignPatterns\Adapter\Windows7FileAdapter;
use DesignPatterns\Adapter\Windows10;
use DesignPatterns\Adapter\UnsupportedFileException;
use DesignPatterns\Decorator\Personajes\Guerrero;
use DesignPatterns\Decorator\Personajes\Mago;
use DesignPatterns\Decorator\Personajes\PersonajeManager;
use DesignPatterns\Decorator\Armas\InvalidWeaponException;

// Procesar formulario del Factory Pattern
$factoryResult = '';
$factoryError = '';

if (($_POST['action'] ?? '') === 'factory' && !empty($_POST['nivel'])) {
    try {
        $nivel = $_POST['nivel'];
        $personaje = PersonajeFactory::crearPersonaje($nivel);

        $factoryResult = [
            'nombre' => $personaje->getNombre(),
            'velocidad' => $personaje->getVelocidad(),
            'ataque' => $personaje->atacar(),
            'nivel' => $nivel
        ];
    } catch (InvalidLevelException $e) {
        $factoryError = $e->getMessage();
    }
}

// Procesar formulario del Adapter Pattern
$adapterResult = '';
$adapterError = '';

if (($_POST['action'] ?? '') === 'adapter' && !empty($_POST['extension']) && !empty($_POST['nombre_archivo'])) {
    try {
        $extension = $_POST['extension'];
        $nombreArchivo = $_POST['nombre_archivo'];

        // Crear archivo de Windows 7
        $archivoWin7 = new Windows7File($nombreArchivo, $extension);

        // Crear adaptador y sistema Windows 10
        $adapter = new Windows7FileAdapter($archivoWin7);
        $windows10 = new Windows10();

        // Procesar archivo
        $adapterResult = [
            'archivo_original' => $archivoWin7->abrirEnWindows7(),
            'resultado_apertura' => $windows10->abrirArchivo($adapter),
        ];
    } catch (UnsupportedFileException $e) {
        $adapterError = $e->getMessage();
    } catch (Exception $e) {
        $adapterError = "Error inesperado: " . $e->getMessage();
    }
}

// Procesar formulario del Decorator Pattern
$decoratorResult = '';
$decoratorError = '';

if (($_POST['action'] ?? '') === 'decorator' && !empty($_POST['personaje_tipo'])) {
    try {
        $tipoPersonaje = $_POST['personaje_tipo'];
        $armasSeleccionadas = $_POST['armas'] ?? [];

        // Crear personaje base
        switch ($tipoPersonaje) {
            case 'guerrero':
                $personajeBase = new Guerrero();
                break;
            case 'mago':
                $personajeBase = new Mago();
                break;
            default:
                throw new InvalidWeaponException("Tipo de personaje no válido");
        }

        $manager = new PersonajeManager();

        // Obtener estadísticas base
        $statsBase = $manager->obtenerInformacionCompleta($personajeBase);

        // Aplicar decoradores si hay armas seleccionadas
        $personajeDecorado = $personajeBase;
        if (!empty($armasSeleccionadas)) {
            $personajeDecorado = $manager->agregarMultiplesArmas($personajeBase, $armasSeleccionadas);
        }

        // Obtener estadísticas finales
        $statsFinal = $manager->obtenerInformacionCompleta($personajeDecorado);

        $decoratorResult = [
            'personaje_base' => $statsBase,
            'personaje_final' => $statsFinal,
            'armas_aplicadas' => $armasSeleccionadas,
            'mejoras' => [
                'ataque' => $statsFinal['ataque'] - $statsBase['ataque'],
                'defensa' => $statsFinal['defensa'] - $statsBase['defensa']
            ]
        ];
    } catch (InvalidWeaponException $e) {
        $decoratorError = $e->getMessage();
    } catch (Exception $e) {
        $decoratorError = "Error inesperado: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de Patrones de Diseño en PHP</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <h1>Ejercicios de Patrones de Diseño en PHP</h1>

    <div class="container">
        <h1>🏭 Factory Pattern - Creación de Personajes</h1>

        <form method="POST" action="">
            <input type="hidden" name="action" value="factory">

            <div class="form-group">
                <label for="nivel">Selecciona el nivel de dificultad:</label>
                <select name="nivel" id="nivel" required>
                    <option value="">-- Selecciona un nivel --</option>
                    <option value="fácil" <?= ($_POST['nivel'] ?? '') === 'fácil' ? 'selected' : '' ?>>🟢 Fácil</option>
                    <option value="difícil" <?= ($_POST['nivel'] ?? '') === 'difícil' ? 'selected' : '' ?>>🔴 Difícil</option>
                </select>
            </div>

            <button type="submit">Crear Personaje</button>
        </form>

        <?php if ($factoryError): ?>
            <div class="error">
                <strong>Error:</strong> <?= htmlspecialchars($factoryError) ?>
            </div>
        <?php endif; ?>

        <?php if ($factoryResult): ?>
            <div class="result">
                <div class="character-card">
                    <h2>Personaje creado: <?= htmlspecialchars($factoryResult['nombre']) ?></h2>

                    <div class="character-stats">
                        <div class="stat-item">
                            <strong>⚡ Velocidad:</strong><br>
                            <?= htmlspecialchars($factoryResult['velocidad']) ?> puntos
                        </div>
                        <div class="stat-item">
                            <strong>⚔️ Ataque:</strong><br>
                            <?= htmlspecialchars($factoryResult['ataque']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>🔄 Adapter Pattern - Compatibilidad de Archivos</h1>

        <form method="POST" action="">
            <input type="hidden" name="action" value="adapter">

            <div class="form-group">
                <label for="nombre_archivo">Nombre del archivo:</label>
                <input type="text" name="nombre_archivo" id="nombre_archivo"
                    value="<?= htmlspecialchars($_POST['nombre_archivo'] ?? 'documento_ejemplo') ?>"
                    placeholder="Ej: mi_documento" required>
            </div>

            <div class="form-group">
                <label for="extension">Extensión del archivo de Windows 7:</label>
                <select name="extension" id="extension" required>
                    <option value="">-- Selecciona una extensión --</option>
                    <option value="doc" <?= ($_POST['extension'] ?? '') === 'doc' ? 'selected' : '' ?>>
                        📄 .doc (Word)
                    </option>
                    <option value="xls" <?= ($_POST['extension'] ?? '') === 'xls' ? 'selected' : '' ?>>
                        📊 .xls (Excel)
                    </option>
                    <option value="ppt" <?= ($_POST['extension'] ?? '') === 'ppt' ? 'selected' : '' ?>>
                        📽️ .ppt (PowerPoint)
                    </option>
                </select>
            </div>
            <button type="submit">Adaptar Archivo</button>
        </form>

        <?php if ($adapterError): ?>
            <div class="error">
                <strong>Error:</strong> <?= htmlspecialchars($adapterError) ?>
            </div>
        <?php endif; ?>

        <?php if ($adapterResult): ?>
            <div class="result">
                <div class="adapter-result">
                    <h2><?= htmlspecialchars($adapterResult['resultado_apertura']) ?></h2>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>⚔️ Decorator Pattern - Sistema de Armas</h1>

        <form method="POST" action="">
            <input type="hidden" name="action" value="decorator">

            <div class="form-group">
                <label for="personaje_tipo">Selecciona tu personaje:</label>
                <select name="personaje_tipo" id="personaje_tipo" required>
                    <option value="">-- Selecciona un personaje --</option>
                    <option value="guerrero" <?= ($_POST['personaje_tipo'] ?? '') === 'guerrero' ? 'selected' : '' ?>>
                        🛡️ Guerrero (ATK: 15, DEF: 12)
                    </option>
                    <option value="mago" <?= ($_POST['personaje_tipo'] ?? '') === 'mago' ? 'selected' : '' ?>>
                        🔮 Mago (ATK: 20, DEF: 8)
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Selecciona las armas a equipar:</label>
                <div class="checkbox-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="armas[]" value="espada"
                            <?= in_array('espada', $_POST['armas'] ?? []) ? 'checked' : '' ?>>
                        ⚔️ Espada (+8 ATK, +3 DEF)
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="armas[]" value="arco"
                            <?= in_array('arco', $_POST['armas'] ?? []) ? 'checked' : '' ?>>
                        🏹 Arco (+6 ATK, +1 DEF)
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="armas[]" value="escudo"
                            <?= in_array('escudo', $_POST['armas'] ?? []) ? 'checked' : '' ?>>
                        🛡️ Escudo (+2 ATK, +7 DEF)
                    </label>
                </div>
            </div>

            <button type="submit">Equipar Armas</button>
        </form>

        <?php if ($decoratorError): ?>
            <div class="error">
                <strong>Error:</strong> <?= htmlspecialchars($decoratorError) ?>
            </div>
        <?php endif; ?>

        <?php if ($decoratorResult): ?>
            <div class="result">
                <div class="decorator-comparison">
                    <div class="character-comparison">
                        <div class="character-before">
                            <h3>Personaje seleccionado: <?= htmlspecialchars($decoratorResult['personaje_base']['descripcion']) ?></h3>
                            <div class="character-stats">
                                <div class="stat-item">
                                    <strong>⚔️ Ataque:</strong><br>
                                    <?= $decoratorResult['personaje_base']['ataque'] ?>
                                </div>
                                <div class="stat-item">
                                    <strong>🛡️ Defensa:</strong><br>
                                    <?= $decoratorResult['personaje_base']['defensa'] ?>
                                </div>
                                <div class="stat-item">
                                    <strong>💪 Poder Total:</strong><br>
                                    <?= $decoratorResult['personaje_base']['poder_total'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="arrow">➡️</div>

                        <div class="character-after">
                            <h3>Personaje Equipado</h3>
                            <div class="character-stats">
                                <div class="stat-item">
                                    <strong>Descripción:</strong><br>
                                    <?= htmlspecialchars($decoratorResult['personaje_final']['descripcion']) ?>
                                </div>
                                <div class="stat-item">
                                    <strong>⚔️ Ataque:</strong><br>
                                    <?= $decoratorResult['personaje_final']['ataque'] ?>
                                    <?php if ($decoratorResult['mejoras']['ataque'] > 0): ?>
                                        <span class="bonus">(+<?= $decoratorResult['mejoras']['ataque'] ?>)</span>
                                    <?php endif; ?>
                                </div>
                                <div class="stat-item">
                                    <strong>🛡️ Defensa:</strong><br>
                                    <?= $decoratorResult['personaje_final']['defensa'] ?>
                                    <?php if ($decoratorResult['mejoras']['defensa'] > 0): ?>
                                        <span class="bonus">(+<?= $decoratorResult['mejoras']['defensa'] ?>)</span>
                                    <?php endif; ?>
                                </div>
                                <div class="stat-item">
                                    <strong>💪 Poder Total:</strong><br>
                                    <?= $decoratorResult['personaje_final']['poder_total'] ?>
                                    <span class="bonus">(+<?= $decoratorResult['personaje_final']['poder_total'] - $decoratorResult['personaje_base']['poder_total'] ?>)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($decoratorResult['armas_aplicadas'])): ?>
                        <div class="weapons-applied">
                            <h4>Armas Equipadas:</h4>
                            <ul>
                                <?php foreach ($decoratorResult['armas_aplicadas'] as $arma): ?>
                                    <li><?= htmlspecialchars(ucfirst($arma)) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>