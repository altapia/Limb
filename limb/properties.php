<?php
    //Registrar la url del bot en Telegram (tiene que ser https)
    //https://api.telegram.org/botTOKEN/setWebhook?url=<url>
    //https://api.telegram.org/botTOKEN/getWebhookInfo para comprobar el estado
    
    // Obtener valores desde variables de entorno
    $TOKEN = getenv('TELEGRAM_BOT_TOKEN') ;

    $VENDOR_AUTOLOAD_PATH = '/../vendor/autoload.php';

    // CONSTANTES por WEB - IDs de usuarios
    define('ID_AGE', getenv('ID_AGE') );
    define('ID_TAPIA', getenv('ID_TAPIA') );
    define('ID_NANO', getenv('ID_NANO') );
    define('ID_YONI', getenv('ID_YONI') );
    define('ID_CAS', getenv('ID_CAS') );
    define('ID_JAVI', getenv('ID_JAVI') );
    define('ID_KETU', getenv('ID_KETU') );
    define('ID_PACO', getenv('ID_PACO') );
    define('ID_RIOJANO', getenv('ID_RIOJANO') );
    define('ID_BARTOL', getenv('ID_BARTOL') );
    define('ID_VICENTE', getenv('ID_VICENTE') );
    define('ID_IBAN', getenv('ID_IBAN') );
    define('ID_ZATO', getenv('ID_ZATO') );
    define('ID_RULO', getenv('ID_RULO') );
    define('ID_MATUTE', getenv('ID_MATUTE') );
    define('ID_LUCHO', getenv('ID_LUCHO') );
    define('ID_BORJA', getenv('ID_BORJA') );
    define('ID_JON', getenv('ID_JON') );
    define('ID_FILETE', getenv('ID_FILETE') );

    // Configuración de API y Base de Datos
    define('TOKEN_API_BOT', getenv('TOKEN_API_BOT') );

    // Configuración de Logger (DEBUG, INFO, WARN, ERROR)
    define('LOG_LEVEL', getenv('LOG_LEVEL') ?: 'DEBUG');

    define('BD_USER', getenv('DB_USER') );
    define('BD_PASSWORD', getenv('DB_PASSWORD') );
    define('BD_NAME', getenv('DB_NAME') );
    define('BD_HOST', getenv('DB_HOST') );

    $endpoint = "https://api.telegram.org/bot".$TOKEN;
?>