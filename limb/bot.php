<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/properties.php';

Logger::configure(__DIR__ .'/../config.xml');
$log = Logger::getLogger('botLogger');

$log->debug("Comienza la ejecución");


$rawMsg = file_get_contents('php://input');
$log->debug("Mensaje: ".$rawMsg);

$message = json_decode($rawMsg, true);


if(is_null($message)){
    return;
}

//Si no hay chat_id, salimos
if(!isset($message["message"]["chat"]["id"])) return;

$chatid= $message['message']['chat']['id'];

//Si se trata de un grupo
if($message['message']['chat']['type']=='group'){
    if($chatid==GUSLIMB_GROUPID){
        $log = Logger::getLogger(GUSLIMB_LOGGER);
        $urlApi=GUSLIMB_URL_API;
        $urlWeb=GUSLIMB_URL;
    }else if($chatid==CHAMPIONSLIMB_GROUPID){
        $log = Logger::getLogger(CHAMPIONSLIMB_LOGGER);
        $urlApi=CHAMPIONSLIMB_URL_API;
        $urlWeb=CHAMPIONSLIMB_URL;
    }else{
        return;
    }
}else{
    switch ($chatid) {
        case ID_AGE:
        case ID_TAPIA:
        case ID_NANO:
        case ID_YONI:
        case ID_CAS: 
        case ID_JAVI:
        case ID_KETU:
        case ID_PACO:
        case ID_RIOJANO:
        case ID_BARTOL:
        //case : //Vicente
            $log = Logger::getLogger(GUSLIMB_LOGGER);
            $urlApi=GUSLIMB_URL_API;
            $urlWeb=GUSLIMB_URL;
            break;
        default:
            $log = Logger::getLogger(CHAMPIONSLIMB_LOGGER);
            $urlApi=CHAMPIONSLIMB_URL_API;
            $urlWeb=CHAMPIONSLIMB_URL;
            break;
    }
}
$log->debug("Mensaje: ".$rawMsg);
$log->debug('Establecido api: '.$urlApi);



//Si se recibe un documento, se responde con el Id de este.
if(isset($message["message"]["document"])){
    $documentId = $message['message']['document']['file_id'];
    $text="Recibido documento con id: ".$documentId;
    enviarTexto($text,$chatid, false);
    return;
}

//Si se recibe una foto, se responde con el Id de esta
if(isset($message["message"]["photo"])){
    $documentId = $message['message']['photo'][0]['file_id'];
    $text="Recibida foto con id: ".$documentId;
    enviarTexto($text,$chatid, false);
    return;
}

//Si se recibe un sticket, se responde con el Id de este
if(isset($message["message"]["sticker"])){
    $documentId = $message['message']['sticker']['file_id'];
    $text="Recibido sticker con id: ".$documentId;
    enviarTexto($text,$chatid, false);
    return;
}



if(!isset($message["message"]["text"])) return;

$command= $message['message']['text'];
$test = isset($message["message"]["chat"]["type"]) && $message["message"]["chat"]["type"]=="private";

/*Comandos de pruebas para desarrolladores*/

if($test){

     $log->debug("mensaje privado");

    if(substr($command, 0, strlen('/pruebaTexto')) === '/pruebaTexto'){
        $param = substr($command, strlen('/pruebaTexto')+1);
        enviarTexto($param,$chatid, true);
    }

    if(substr($command, 0, strlen('/pruebaFoto')) === '/pruebaFoto'){
        $param = substr($command, strlen('/pruebaFoto')+1);
        enviarFoto($param,$chatid);
    }

    if(substr($command, 0, strlen('/pruebaDoc')) === '/pruebaDoc'){
        $param = substr($command, strlen('/pruebaDoc')+1);
        enviarDoc($param,$chatid);
    }

    if(substr($command, 0, strlen('/pruebaSticker')) === '/pruebaSticker'){
        $param = substr($command, strlen('/pruebaSticker')+1);
        enviarSticker($param,$chatid);
    }
}



switch ($command) {
        case '/clasificacion':
				clasificacion($chatid, $urlApi, $log);
					break;
        case '/prox_jornada':
				proxima_jornada($chatid, $urlApi);
					break;
        case '/apuestas':
				apuestas($chatid, $urlApi);
					break;
        case '/web':
                                web($urlWeb, $chatid);
                                break;
        case '/donaSemen':
                                donaSemen($chatid);
                                break;
        case '/bravo':
                        bravo($chatid);
                                break;
        case '/quieroMiPenaltito':
                        quieroMiPenaltito($chatid);
                                break;
        case '/cuantoHaPerdidoRiojas':
                        cuantoHaPerdidoRiojas($chatid);
                                break;
        case '/Gus':
                        gus($chatid);
                                break;
        case '/TeLaComiste':
                        telacomiste($chatid);
                                break;	
        case '/Vicenwin':
                        vicenwin($chatid);
                                break;	
        case '/FatSpanishWaiter':
                        fatSpanishWaiter($chatid);
                                break;	
        case '/cuantoHaGanadoCas':
                        cuantoHaGanadoCas($chatid);
                                break;
        default:
                        insultar($chatid);
}		


$log->debug("Fin de la ejecución");


//Función para convertir EMOJIS
function unichr($i) {
    return iconv('UCS-4LE', 'UTF-8', pack('V', $i));
}

function enviarTexto($text, $chatid,$markdown){
    global $TOKEN;
    global $log;
    try {
        $data= [
                'chat_id' => (int) $chatid,
                'text' => $text
            ];


        if($markdown){
            $log->debug("Activado markdown");
            $data["parse_mode"]="Markdown";
        }

        enviarMensaje('/sendMessage', $data);
        
    } catch (Exception $e) {
        syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e–>getMessage());
        exit(1);
    }
}

function enviarFoto($docId, $chatid){
    global $TOKEN;
    global $log;

    $log->debug("Enviando foto con id: ".$docId);
    try {
        $data= [
                'chat_id' => (int) $chatid,
                'photo' => $docId
            ];

        enviarMensaje('/sendPhoto', $data);

    } catch (Exception $e) {
        syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e–>getMessage());
        exit(1);
    }
}

function enviarDoc($docId, $chatid){
    global $TOKEN;
    global $log;

    $log->debug("Enviando doc con id: ".$docId);
    try {
        $data= [
                'chat_id' => (int) $chatid,
                'document' => $docId
            ];

        enviarMensaje('/sendDocument', $data);

    } catch (Exception $e) {
        syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e–>getMessage());
        exit(1);
    }
}

function enviarSticker($docId, $chatid){
    global $TOKEN;
    global $log;

    $log->debug("Enviando Sticker con id: ".$docId);
    try {
        $data= [
                'chat_id' => (int) $chatid,
                'sticker' => $docId
            ];

        enviarMensaje('/sendSticker', $data);

    } catch (Exception $e) {
        syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e–>getMessage());
        exit(1);
    }
}

function enviarAccionChat($action, $chatid){
    global $TOKEN;
    try {
         $data= [
                'chat_id' => (int) $chatid,
                'action' => $action
            ];

        enviarMensaje('/sendChatAction', $data);

    } catch (Exception $e) {
        syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e–>getMessage());
        exit(1);
    }
}

function enviarMensaje($accion, $data){
    global $TOKEN;
    global $log;
    global $endpoint;
    try {       

        $options = [
                CURLOPT_URL => $endpoint. $accion,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => null,
                CURLOPT_POSTFIELDS => null
            ];

        if ($data) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        $curl = curl_init();

        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        $log->debug("Respuesta Telegram: ".$result);

    } catch (Exception $e) {
        syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e–>getMessage());
        exit(1);
    }
}

function clasificacion($chatid, $urlApi, $log){
	$log->debug('clasificacion');
    enviarAccionChat('typing',$chatid);

    $text='Clasificación de la última fase en curso:'.PHP_EOL.PHP_EOL;

    $log->debug($urlApi . 'clasificacion');
    $json = file_get_contents($urlApi . 'clasificacion');
    $obj = json_decode($json);

    foreach($obj as $valor) {
        $text=$text.$valor->pos.'.- '.$valor->nombre.': '.$valor->neto.'€'.PHP_EOL;
    }
    enviarTexto($text,$chatid, false);
}

function proxima_jornada($chatid, $urlApi){
	enviarAccionChat('typing',$chatid);

    $text='';
    $json = file_get_contents($urlApi . 'prox_jornada');

    $obj = json_decode($json);
    $fecha='';

    $idPartido=-1;
    foreach($obj as $valor) {
        $fecha=$valor->fecha;
        if($idPartido!=$valor->id){
            $text=$text.PHP_EOL;
            $idPartido=$valor->id;
            $text=$text.substr($valor->hora,0,5).' '.$valor->local_c.' vs '.$valor->visitante_c.'=>'.$valor->apostante;
        }else{
            $text=$text.', '.$valor->apostante;
        }
    }

    $fecha= substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4);
    $text='Próxima jornada '.$fecha.': '.PHP_EOL.$text;
    enviarTexto($text,$chatid, false);
}

function apuestas($chatid, $urlApi){
	enviarAccionChat('typing',$chatid);

    $text='';
    $json = file_get_contents($urlApi . 'apuestas');

    $obj = json_decode($json);
    $fecha='';

    $idPartido=-1;
    $apostante='';

    $emoji_star= unichr(0x1F538);
    $emoji_guion= unichr(0x2796);
    $emoji_cara=unichr(0x1F633);
    $emoji_ok=unichr(0x2705);
    $emoji_mal=unichr(0x274C);

    foreach($obj as $valor) {
        if($idPartido!=$valor->partido){
            $idPartido=$valor->partido;
            $fecha=$valor->fecha;
            $text=$text.PHP_EOL.$emoji_star.$valor->local_c.' vs '.$valor->visitante_c.$emoji_star.PHP_EOL;
        }
        if($apostante!=$valor->apostante){
            $apostante=$valor->apostante;
            $text=$text.$emoji_cara.$valor->apostante.PHP_EOL;
        }
        $iconoApuesta=$emoji_guion;
        //1 acertada
        if($valor->acertada=="1"){
            $iconoApuesta=$iconoApuesta.$emoji_ok;
        }else if($valor->acertada=="2"){
             $iconoApuesta=$iconoApuesta.$emoji_mal;
        }
        $text=$text.$iconoApuesta.$valor->apuesta.':'.$valor->apostado.'@'.$valor->cotizacion.PHP_EOL;
    }

    $fecha= substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4);
    $text='Apuestas '.$fecha.': '.PHP_EOL.PHP_EOL.$text;
    enviarTexto($text,$chatid, false);
}

function web($urlWeb, $chatid){
	$text=$urlWeb;
    enviarTexto($text,$chatid, false);
}

function donaSemen($chatid){
	$emoji_mujer=unichr(0x1F64B);
    $emoji_semen=unichr(0x1F4A6);

    $text=$emoji_semen.$emoji_mujer;
    enviarTexto($text,$chatid, false);
}

function bravo($chatid){
	 enviarDoc('BQADBAADuAADmEw-AAFENNvXv3KlQgI',$chatid);
}

function quieroMiPenaltito($chatid){
	 enviarDoc('BQADBAADtwADmEw-AAHFpvL_faHg5QI',$chatid);
}

function cuantoHaPerdidoRiojas($chatid){
	 enviarTexto('jajaja, pues todo pringaos',$chatid, false);
}

function gus($chatid){
	  enviarFoto('AgADBAADKrExG6uCfgABZugFvbiTwBWpaHIwAAQIkbE_6Ksrx8Q2AQABAg',$chatid);
}
	
function telacomiste($chatid){
	  enviarFoto('AgADBAADK7ExG6uCfgAB9rTpspMp9VRGYGkwAAS8GdFc47A_whSFAQABAg',$chatid);
}

function vicenwin($chatid){
	  enviarFoto('AgADBAADLLExG6uCfgAB0UBRGzF7sb96C2swAAS7hCl_X6wqS9ByAQABAg',$chatid);
}

function fatSpanishWaiter($chatid){
	  enviarDoc('BQADBAADMAEAAquCfgABhqhRqhpC5agC',$chatid);
}

function cuantoHaGanadoCas($chatid){
	enviarTexto('Se lo está llevando crudo',$chatid, false);
	enviarFoto('AgADBAADLbExG6uCfgABO7d46OcKzQkVuo8wAATDrhyVPZbKfktbAAIC',$chatid);
}

function insultar($chatid){
	$text = 'Función no implementada. ';
	$insultos = array('¿Eres idiota?', '¿Eres bobo?', '¿Eres falto?', '¿Eres imbécil?', 'Cómeme un huevo');
	$index = rand(0,count($insultos)-1);
	$text .= $insultos[$index];
	
	enviarTexto($text,$chatid, false);
}

?>
