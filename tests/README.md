# Tests de ComandosLimb

Tests de integración para las funciones de `ComandosLimb.php`. Llaman a la API de producción y muestran la salida por consola en lugar de enviarla a Telegram.

## Configuración previa

Copia el fichero de ejemplo y ajusta los valores:

```bash
cp tests/test-config.example.php tests/test-config.php
```

Edita `tests/test-config.php` y ajusta los valores:

| Constante | Descripción |
|---|---|
| `TEST_API_URL` | URL base de la API de producción (con trailing slash) |
| `TEST_CHAT_ID` | chat_id registrado en la aplicación |
| `TEST_FROM_ID` | from_id del usuario de prueba |
| `TOKEN_API_BOT` | Token de la API bot |
| `TEST_URL_WEB` | URL web del grupo (para el test de `/web`) |

## Imagen Docker necesaria

Se usa la imagen oficial `php:7.4-cli`. No hace falta build previo del proyecto.

La primera ejecución instala `unzip`, `curl` y `composer` dentro del contenedor. El directorio del proyecto se monta como volumen, por lo que los ficheros de `vendor/` quedan disponibles localmente para ejecuciones posteriores.

## Ejecutar todos los tests

```bash
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli sh -c "apt-get update -qq && apt-get install -y -qq unzip curl && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer install && ./vendor/bin/phpunit --testdox"
```

## Ejecutar un test concreto

Una vez que `vendor/` ya está generado (tras la primera ejecución completa):

```bash
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter <NombreDelTest> --testdox
```

### Ejemplos

```bash
# Clasificación general
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testClasificacion --testdox

# Clasificación de jornada
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testClasificacionJornada --testdox

# Próxima jornada
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testProxJornada --testdox

# Apuestas
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testApuestas --testdox

# Euros
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testEuros --testdox

# Apostad ya
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testApostadYa --testdox

# Web
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testWeb --testdox

# Partidos de la jornada
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testPartidosJornada --testdox

# Mis partidos (requiere TEST_CHAT_ID con token válido en la API)
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testMisPartidos --testdox

# Sin cuota (requiere TEST_CHAT_ID con permisos de admin en la API)
docker run --rm -v "${PWD}:/var/www/html" -w /var/www/html php:7.4-cli ./vendor/bin/phpunit --filter testSinCuota --testdox
```

## Notas

- Los tests **no usan base de datos**. Solo realizan llamadas HTTP a la API configurada en `test-config.php`.
- Los tests `testMisPartidos` y `testSinCuota` se marcan automáticamente como _skipped_ si `TEST_CHAT_ID` no tiene token o permisos suficientes en la API.
- El nivel de log está configurado a `ERROR` por defecto para no ensuciar la salida. Cámbialo a `DEBUG` en `test-config.php` para ver todas las llamadas a la API.
