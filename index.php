<?php

require __DIR__ . '/vendor/autoload.php';

use DesignPatterns\Factory\PersonajeFactory;
use DesignPatterns\Factory\InvalidLevelException;

// Procesar formulario del Factory Pattern
$factoryResult = '';
$factoryError = '';

if ($_POST['action'] ?? '' === 'factory' && !empty($_POST['nivel'])) {
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
</body>

</html>