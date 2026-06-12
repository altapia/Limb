<?php
/**
 * Configuración para los tests de ComandosLimb.
 *
 * Copia este fichero a test-config.php y ajusta los valores:
 *   cp tests/test-config.example.php tests/test-config.php
 *
 * test-config.php está en .gitignore y no se sube al repositorio.
 */

// URL base de la API de producción (con trailing slash)
define('TEST_API_URL', 'https://tu-api.example.com/api/');

// chat_id que se usará como remitente del mensaje de prueba.
// Debe ser un chat_id conocido por la API (grupo configurado en la app).
define('TEST_CHAT_ID', 0);

// from_id del usuario de prueba (se usa en cuantoHaPerdidoRiojas y similares)
define('TEST_FROM_ID', 0);

// Token de la API bot (necesario para endpoints que requieren autenticación)
define('TOKEN_API_BOT', 'tu-token-api-bot');

// URL web del grupo (usada por el comando /web)
define('TEST_URL_WEB', 'https://tu-app.example.com');

// Nivel de log (DEBUG muestra todas las llamadas a la API por consola)
if (!defined('LOG_LEVEL')) {
    define('LOG_LEVEL', 'ERROR');
}

// IDs de usuarios hardcoded en Utils::get_humano_name() y Utils::quien_ha_perdido_mas()
// Asigna el from_id real de cada usuario o deja a 0 los que no uses.
if (!defined('ID_AGE'))     define('ID_AGE',     0);
if (!defined('ID_TAPIA'))   define('ID_TAPIA',   0);
if (!defined('ID_NANO'))    define('ID_NANO',    0);
if (!defined('ID_YONI'))    define('ID_YONI',    0);
if (!defined('ID_CAS'))     define('ID_CAS',     0);
if (!defined('ID_JAVI'))    define('ID_JAVI',    0);
if (!defined('ID_KETU'))    define('ID_KETU',    0);
if (!defined('ID_PACO'))    define('ID_PACO',    0);
if (!defined('ID_RIOJANO')) define('ID_RIOJANO', 0);
if (!defined('ID_BARTOL'))  define('ID_BARTOL',  0);
if (!defined('ID_VICENTE')) define('ID_VICENTE', 0);
if (!defined('ID_IBAN'))    define('ID_IBAN',    0);
if (!defined('ID_ZATO'))    define('ID_ZATO',    0);
if (!defined('ID_RULO'))    define('ID_RULO',    0);
if (!defined('ID_MATUTE'))  define('ID_MATUTE',  0);
if (!defined('ID_LUCHO'))   define('ID_LUCHO',   0);
if (!defined('ID_BORJA'))   define('ID_BORJA',   0);
if (!defined('ID_JON'))     define('ID_JON',     0);
if (!defined('ID_FILETE'))  define('ID_FILETE',  0);
