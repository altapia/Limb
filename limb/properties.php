<?php
    //Registrar la url del bot en Telegram (tiene que ser https)
    //https://api.telegram.org/botTOKEN/setWebhook?url=<url>
    //https://api.telegram.org/botTOKEN/getWebhookInfo para comprobar el estado
    
    // Obtener valores desde variables de entorno
    $TOKEN = getenv('TELEGRAM_BOT_TOKEN');
    if ($TOKEN === false || $TOKEN === null) {
        $TOKEN = '';
    }

    $VENDOR_AUTOLOAD_PATH = '/../vendor/autoload.php';

    // CONSTANTES por WEB - IDs de usuarios
    define('ID_AGE', getenv('ID_AGE') !== false ? getenv('ID_AGE') : '');
    define('ID_TAPIA', getenv('ID_TAPIA') !== false ? getenv('ID_TAPIA') : '');
    define('ID_NANO', getenv('ID_NANO') !== false ? getenv('ID_NANO') : '');
    define('ID_YONI', getenv('ID_YONI') !== false ? getenv('ID_YONI') : '');
    define('ID_CAS', getenv('ID_CAS') !== false ? getenv('ID_CAS') : '');
    define('ID_JAVI', getenv('ID_JAVI') !== false ? getenv('ID_JAVI') : '');
    define('ID_KETU', getenv('ID_KETU') !== false ? getenv('ID_KETU') : '');
    define('ID_PACO', getenv('ID_PACO') !== false ? getenv('ID_PACO') : '');
    define('ID_RIOJANO', getenv('ID_RIOJANO') !== false ? getenv('ID_RIOJANO') : '');
    define('ID_BARTOL', getenv('ID_BARTOL') !== false ? getenv('ID_BARTOL') : '');
    define('ID_VICENTE', getenv('ID_VICENTE') !== false ? getenv('ID_VICENTE') : '');
    define('ID_IBAN', getenv('ID_IBAN') !== false ? getenv('ID_IBAN') : '');
    define('ID_ZATO', getenv('ID_ZATO') !== false ? getenv('ID_ZATO') : '');
    define('ID_RULO', getenv('ID_RULO') !== false ? getenv('ID_RULO') : '');
    define('ID_MATUTE', getenv('ID_MATUTE') !== false ? getenv('ID_MATUTE') : '');
    define('ID_LUCHO', getenv('ID_LUCHO') !== false ? getenv('ID_LUCHO') : '');
    define('ID_BORJA', getenv('ID_BORJA') !== false ? getenv('ID_BORJA') : '');
    define('ID_JON', getenv('ID_JON') !== false ? getenv('ID_JON') : '');
    define('ID_FILETE', getenv('ID_FILETE') !== false ? getenv('ID_FILETE') : '');

    // Configuración de API y Base de Datos
    define('TOKEN_API_BOT', getenv('TOKEN_API_BOT') !== false ? getenv('TOKEN_API_BOT') : '');

    // Configuración de Logger (DEBUG, INFO, WARN, ERROR)
    $logLevel = getenv('LOG_LEVEL');
    define('LOG_LEVEL', $logLevel !== false && $logLevel !== '' ? $logLevel : 'DEBUG');

    define('BD_USER', getenv('DB_USER') !== false ? getenv('DB_USER') : '');
    define('BD_PASSWORD', getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '');
    define('BD_NAME', getenv('DB_NAME') !== false ? getenv('DB_NAME') : '');
    define('BD_HOST', getenv('DB_HOST') !== false ? getenv('DB_HOST') : '');

    $endpoint = "https://api.telegram.org/bot".$TOKEN;
?>