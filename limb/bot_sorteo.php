<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/properties.php';
require_once __DIR__ .$VENDOR_AUTOLOAD_PATH;
require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/Response.php';
require_once __DIR__ . '/RequestException.php';
require_once __DIR__ . '/Comandos.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/dao/currentCMDDAO.php';
require_once __DIR__ . '/dao/apostarCMDDAO.php';
require_once __DIR__ . '/dao/chatDAO.php';
require_once __DIR__ . '/dao/grupoDAO.php';
require_once __DIR__ . '/ApostarCMD.php';

Logger::configure(__DIR__ .'/../config.xml');
$log = Logger::getLogger('com.hotelpene.limbBot.bot');

$log->debug("Comienza la ejecución del bot sorteo");
//$log->debug("Cabeceras: ".print_r(getallheaders(), true));


if(isset($_POST["texto"]) && isset($_POST["chat"]) && isset($_POST["token"])){
    $texto =$_POST["texto"];
    $chat =$_POST["chat"];
    $token =$_POST["token"];
    $aviso_admin =$_POST["aviso_admin"];
    
    if($token == $TOKEN){
        
        if($aviso_admin == 1){
            
            $log->info('Enviando notificación a los administradores');

            $response = Response::create_text_response($endpoint, $chat, $texto);
            $resultado = $response->send();
            $result = json_decode($resultado, true);
            if($result["ok"]){
                $log->info('Notificación enviada correctamente');
                echo '{"error": false}';
            } else {
                $log->error('Error al enviar la respuesta. ErroCode: '.$result["error_code"] . '. description: '.$result["description"]);
                echo '{"error":true, "desc":"'.$result["description"].'"}';
            }  
        } else {
            $response = Response::create_text_response($endpoint, $chat, $texto);
            $resultado = $response->send();
            $result = json_decode($resultado, true);
            
            if($result["ok"]){
                $log->info('Respuesta sorteo enviada correctamente');
                echo '{"error": false}';
            }else{
                $log->error('Borrado: Error al enviar la respuesta. ErroCode: '.$result["error_code"] . '. description: '.$result["description"]);
                echo '{"error":true, "desc":"'.$result["description"].'"}';
            }
        }
        
        //echo '{"error": false}';
    }else{
        echo '{"error":true, "desc":"No autorizado"}';
    }
    
}else{
    echo '{"error":true, "desc":"Faltan parametros"}';
}


?>
