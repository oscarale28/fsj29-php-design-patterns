# Ejercicios de Patrones de Diseño en PHP

Este proyecto implementa cuatro patrones de diseño fundamentales en PHP con una interfaz web interactiva para demostrar su funcionamiento.

## 🎯 Patrones Implementados

### 1. Factory Pattern - Creación de Personajes
Crea diferentes tipos de personajes según el nivel de dificultad seleccionado.

### 2. Adapter Pattern - Compatibilidad de Archivos
Adapta archivos de Windows 7 para que sean compatibles con Windows 10.

### 3. Decorator Pattern - Sistema de Armas
Permite equipar múltiples armas a personajes, mejorando sus estadísticas de forma dinámica.

### 4. Strategy Pattern - Salida de Mensajes
Procesa mensajes en diferentes formatos: consola, JSON o descarga como archivo TXT.

## 🚀 Cómo Ejecutar el Proyecto

### Requisitos Previos
- PHP 8.0 o superior
- Composer
- Servidor web (Apache, Nginx) o PHP built-in server

### Instalación

1. **Clonar o descargar el proyecto**
   ```bash
   git clone https://github.com/oscarale28/fsj29-php-design-patterns.git
   cd php-design-patterns-exercises
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Ejecutar el servidor**

   - Colocar el proyecto en la carpeta del servidor web (htdocs, www, etc.)
   - Acceder desde el navegador

4. **Abrir en el navegador**
   ```
   http://localhost:8000
   ```

## 📋 Uso de la Aplicación

La interfaz web presenta cuatro secciones, una para cada patrón:

1. **Factory Pattern**: Selecciona un nivel de dificultad y crea un personaje
2. **Adapter Pattern**: Ingresa un nombre de archivo y extensión para adaptarlo
3. **Decorator Pattern**: Elige un personaje y equípalo con diferentes armas
4. **Strategy Pattern**: Escribe un mensaje y selecciona el formato de salida

Cada sección incluye formularios interactivos que muestran los resultados en tiempo real.

## 📁 Estructura del Proyecto

```
fsj29-php-design-patterns 
├── src/DesignPatterns/     # Implementaciones de los patrones
|   ├── Adapter/
|   ├── Decorator/
|   ├── Factory/
|   ├── Strategy/
├── index.php               # Interfaz web principal
├── index.css              # Estilos de la aplicación
├── download.php           # Manejo de descargas (Strategy Pattern)
├── composer.json          # Configuración de Composer
```

_Este proyecto fue desarrollado como parte del bootcamp Full Stack Jr. de Kodigo._