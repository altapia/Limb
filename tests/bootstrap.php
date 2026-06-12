<?php
/**
 * Bootstrap para los tests de ComandosLimb.
 * Carga solo los ficheros necesarios — sin database.php ni DAOs.
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/test-config.php';

// Configurar Log4PHP al nivel definido en test-config (por defecto ERROR para no ensuciar la salida)
Logger::configure([
    'rootLogger' => [
        'appenders' => ['console'],
        'level'     => LOG_LEVEL,
    ],
    'appenders' => [
        'console' => [
            'class'  => 'LoggerAppenderConsole',
            'layout' => [
                'class'  => 'LoggerLayoutSimple',
            ],
        ],
    ],
]);

// Clases del proyecto (sin database.php ni DAOs)
require_once __DIR__ . '/../limb/RequestException.php';
require_once __DIR__ . '/../limb/Request.php';
require_once __DIR__ . '/../limb/Response.php';
require_once __DIR__ . '/../limb/Utils.php';
require_once __DIR__ . '/../limb/vo/grupoVO.php';
require_once __DIR__ . '/../limb/ComandosLimb.php';
