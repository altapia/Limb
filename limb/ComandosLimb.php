<?php
    class ComandosLimb{
        
        private $log;
        
        static function ejecutar($func,$endpoint, $request){
            //Si el usuario o grupo no está configurado para Limb, se sale de estos comandos
            
            if(method_exists('ComandosLimb',$func)){
                $command = new ComandosLimb();
                
                $chatDAO = new ChatDAO();
                
                $chat =$chatDAO->select($request->get_chat_id());
                //Si el chat tiene asociado un solo grupo, se establece ese
                if(sizeof($chat->arrGrupo)==1){
                    return $command->$func($endpoint, $request,$chat->arrGrupo[0]);
                }elseif(sizeof($chat->arrGrupo)>1){
                    $currentCMDDAO = new CurrentCMDDAO();
                    $result = $currentCMDDAO->select($request->get_chat_id());
                    if($result!=null){
                        if($result['grupo']!=null){
                             //Obtener datos grupo
                            $grupoDAO = new GrupoDAO();
                            $grupoVO=$grupoDAO->select($result['grupo']);
                            
                            $currentCMDDAO->delete($request->get_chat_id());
                            return $command->$func($endpoint, $request,$grupoVO);
                        }
                        //Si hay comando en curso, se borra y se inserta este
                        $currentCMDDAO->delete($request->get_chat_id());
                    }
                    
                    $cmd=new CurrentCMDVO();
                    $cmd->chat_id=$request->get_chat_id();
                    $cmd->cmd=$func;
                    $resultInsertCMD = $currentCMDDAO->insert($cmd);

                    //se pregunta por el grupo
                    return Utils::pregunta_grupo($endpoint, $request);
                    
                }else{
                    //El chat no está dado de alta
                    return null;
                }
            }
            return null;
        }
        
        
        function __construct() {
            $this->log = Logger::getLogger('com.hotelpene.limbBot.ComandosLimb');
        }


        private function clasificacion($endpoint, $request, $grupoVO){
            $this->log->debug("Obteniedo clasificacion");
            $time = microtime(true);

            $urlApi=$grupoVO->url_api;

            $response_chat_typing = Response::create_typing_response($endpoint, $request->get_chat_id());
            $response_chat_typing->send();


            //Se obtiene la fase actual
            $jsonFaseActual = Utils::callApi($request, 'util/faseActualClasif', $urlApi);
            $faseActual = json_decode($jsonFaseActual);

	    //Se obtiene la fase siguiente
	    $idFaseSiguiente = intval($faseActual->id);
	    $idFaseSiguiente = $idFaseSiguiente +1;

            $jsonFaseSiguiente = Utils::callApi($request, 'fases/'.$idFaseSiguiente, $urlApi);
            $faseSiguiente = json_decode($jsonFaseSiguiente)[0];

	    $this->log->debug("fase sigueinte numapostadores: ".intval($faseSiguiente->numapostadores));

            $text='*Clasificación de la últ. fase ('.$faseActual->titulo.'):*'.PHP_EOL.PHP_EOL;

            $url='clasificacion/'.$faseActual->id;

            //Se comprueba si es un chat privado, para obtener el token del usuario
            if($request->is_private_chat()){
                $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
                $tokenUsuario = json_decode($jsonTokenUser, true);
                //var_dump($tokenUsuario);
                //Si hay token de usuario del chat, se invoca el comando con el token
               // $objeto = $tokenUsuario[0];
                if($tokenUsuario[0]['token']){
                    $url='clasificacion/'.$faseActual->id.'?token='.$tokenUsuario[0]['token'];
                }
            }


            $json = Utils::callApi($request, $url, $urlApi);
            $obj = json_decode($json);

            if(sizeof($obj)>0 && property_exists($obj[0],'error')){
                $object = new stdClass();
                $object->hide_keyboard =true;
                $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $obj[0]->error->text, json_encode($object));
                return $response;
            }


            $emoji_down= Utils::convert_emoji(0x2B06);
            $emoji_up= Utils::convert_emoji(0x2B07);
            $emoji_balon= Utils::convert_emoji(0x26BD);
            $emoji_dinero= Utils::convert_emoji(0x1F4B0);
            $emoji_yield= Utils::convert_emoji(0x1F4A5);
	    $total_jugadores = intval($faseActual->numapostadores);
	    $pasan = intval($faseSiguiente->numapostadores);

            $i=1;
            foreach($obj as $valor) {
                $jugado = 0 + floatval($valor->jugado);
                $ganado = 0 + floatval($valor->ganancia);
                $yield = ($ganado/$jugado)*100;
		$pasa = $this->getIconoPasa($i, $total_jugadores, $pasan);
            	$text=$text.$pasa.'*'.$i.'.'.$valor->nombre.'*'.$emoji_dinero.number_format((float)$valor->ganancia,2).'€'.$emoji_yield.round($yield,2).'%'.$emoji_balon.$valor->num_partidos.PHP_EOL;
            	$i++;
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            
            $this->log->debug("Fin Obteniedo Clasificación (".(microtime(true)-$time)." s): ");
            return $response;
        }
        
        private function clasificacionJornada($endpoint, $request,$grupoVO){
            $this->log->debug("Obteniedo clasificacion de jornada");
            $time = microtime(true);
            
            $urlApi=$grupoVO->url_api;
            
            $response_chat_typing = Response::create_typing_response($endpoint, $request->get_chat_id());
            $response_chat_typing->send();
            
            
            //Se obtiene la fase actual
            $jsonFaseActual = Utils::callApi($request, 'util/faseActualClasif', $urlApi);
            $faseActual = json_decode($jsonFaseActual);
            
            $text='*Clasificación de la últ Jornada ('.$faseActual->titulo.'-'.$faseActual->tipo->nombre.'):*'.PHP_EOL.PHP_EOL;
            
            $url='clasificacionfasetipo/'.$faseActual->id.'/tipofase/'.$faseActual->tipo->id;
            
            //Se comprueba si es un chat privado, para obtener el token del usuario
            if($request->is_private_chat()){
                $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
                $tokenUsuario = json_decode($jsonTokenUser, true);
                //var_dump($tokenUsuario);
                //Si hay token de usuario del chat, se invoca el comando con el token
               // $objeto = $tokenUsuario[0];
                if($tokenUsuario[0]['token']){
                    $url.='?token='.$tokenUsuario[0]['token'];
                }
            }

            $json = Utils::callApi($request, $url, $urlApi);
            $obj = json_decode($json);

            if(sizeof($obj)>0 && property_exists($obj[0],'error')){
                $object = new stdClass();
                $object->hide_keyboard =true;
                $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $obj[0]->error->text, json_encode($object));
                return $response;
            }
            
            
            $emoji_down= Utils::convert_emoji(0x2B06);
            $emoji_up= Utils::convert_emoji(0x2B07);
            $emoji_balon= Utils::convert_emoji(0x26BD);
            $emoji_dinero= Utils::convert_emoji(0x1F4B0);
            $emoji_yield= Utils::convert_emoji(0x1F4A5);
            
            $i=1;
            foreach($obj as $valor) {
                $jugado = 0 + floatval($valor->jugado);
                $ganado = 0 + floatval($valor->ganancia);
                $yield = ($ganado/$jugado)*100;
		$text=$text.'*'.$i.'.'.$valor->nombre.'*'.$emoji_dinero.number_format((float)$valor->ganancia,2).'€'.$emoji_yield.round($yield,2).'%'.$emoji_balon.$valor->num_partidos.PHP_EOL;
                $i++;
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            
            $this->log->debug("Fin Obteniedo Clasificación fase y jornada (".(microtime(true)-$time)." s): ");
            return $response;
        }

        private function getIconoPasa($posicion, $total_jugadores, $pasan) {
            // https://emojipedia.org
            $emoji_ok = Utils::convert_emoji(0x2705);
            $emoji_ko = Utils::convert_emoji(0x2B07);
            $emoji_first = Utils::convert_emoji(0x2733);
            $emoji_last = Utils::convert_emoji(0x267F);
            if ($posicion === $total_jugadores) {
                return $emoji_last;
            }
            if ($posicion === 1) {
                return $emoji_first;
            }
            /*$pasan = 12;
            switch ($total_jugadores) {
                case 12: $pasan = 6; break;
                case 6: $pasan = 2; break;
                case 2: $pasan = 1; break;
            }*/
            if ($posicion > $pasan) {
                return $emoji_ko;
            }
            return $emoji_ok;
        }

        private function prox_jornada($endpoint, $request,$grupoVO){
            $this->log->debug("Obteniedo Próxima jornada");
            $time = microtime(true);
            $urlApi=$grupoVO->url_api;

            $response = new Response($endpoint, $request->get_chat_id(), Response::TYPE_CHAT_ACTION);
            $response->chat_action='typing';
            $response->send();

            //Se obtiene la fecha del proximo partido
	    $jsonFaseAct = Utils::callApi($request,'util/faseActual', $urlApi);
	    $faseAct = json_decode($jsonFaseAct);
	    $fase = $faseAct->id;
	    $tipoFase = $faseAct->tipo->id;

            $json = Utils::callApi($request, 'partidos/fase/'.$fase.'/'.$tipoFase, $urlApi);
            $obj = json_decode($json);

            $text='';
            $fecha='';

            foreach($obj as $valor) {
		    if($fecha!=$valor->fecha){
                        $text=$text.PHP_EOL;
                    }
	            $fecha=$valor->fecha;
                    $text=$text.PHP_EOL;
                    $idPartido=$valor->id;
                    //Apostantes
                    $apostantes='';
                    $idx = 0;
                    foreach($valor->usuarios as $usu) {
                        if($idx>0){
                            $apostantes.=', '.$usu->nombre;
                        }else{
                            $apostantes.=$usu->nombre;
                        }
                        $idx++;
                    }

		    $fechaFormat= substr($fecha,8,2).'/'.substr($fecha,5,2); //.'/'.substr($fecha,0,4);
		    $text=$text.$fechaFormat.' '.substr($valor->hora,0,5).' '.$valor->local->nombre_corto.' vs '.$valor->visitante->nombre_corto;
                    if($apostantes!=null){
                        $text.='=>'.$apostantes;
                    }
            }

            if($fecha==null){
                $text='*No hay próxima jornada* '.PHP_EOL;
            }else{
                $fecha= substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4);
                $text='*Próxima jornada: '.$faseAct->titulo.' - '.$faseAct->tipo->nombre.':* '.PHP_EOL.$text;
            }

            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));

            $this->log->debug("Fin Obteniedo Próxima jornada (".(microtime(true)-$time)." s): ");
            return $response;
        }

        private function apuestas($endpoint, $request,$grupoVO){
            $this->log->debug("Obteniendo apuestas");
            $time = microtime(true);
            $urlApi=$grupoVO->url_api;
            
            $response = new Response($endpoint, $request->get_chat_id(), Response::TYPE_CHAT_ACTION);
            $response->chat_action='typing';
            $response->send();
        
            //Se obtiene la fecha del proximo partido
            $jsonFecha = Utils::callApi($request, 'util/fechaProxPartido/', $urlApi);
            $fecha = json_decode($jsonFecha);
            
            
            //Se obtienen los partidos de HOY. Si no hay, se obtienen los de la próxima jornada
            $fechaHoy = date('Y-m-d');
            $jsonPartidos = Utils::callApi($request, 'partidos/fecha/'.$fechaHoy, $urlApi);
            $partidos = json_decode($jsonPartidos);

            if(sizeof($partidos)==0){
                //Se obtiene la fecha del proximo partido
                $jsonFecha = Utils::callApi($request, 'util/fechaProxPartido/', $urlApi);
                $fecha = json_decode($jsonFecha);
                $jsonPartidos = Utils::callApi($request, 'partidos/fecha/'.$fecha->fecha, $urlApi);
                $partidos = json_decode($jsonPartidos);

            }
            
            
            $text='';
            $idPartido=-1;
            $apostante='';
        
            $emoji_star= Utils::convert_emoji(0x1F538);
            $emoji_guion= Utils::convert_emoji(0x2796);
            $emoji_cara=Utils::convert_emoji(0x1F633);
            $emoji_ok=Utils::convert_emoji(0x2705);
            $emoji_mal=Utils::convert_emoji(0x274C);
            $emoji_tijeras=Utils::convert_emoji(0x2702);
            $emoji_cerdo=Utils::convert_emoji(0x1F416);
            
        
            $finUrl='';
            
            //Se comprueba si es un chat privado, para obtener el token del usuario
            if($request->is_private_chat()){
                $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
                $tokenUsuario = json_decode($jsonTokenUser, true);
                //var_dump($tokenUsuario);
                //Si hay token de usuario del chat, se invoca el comando con el token
                if($tokenUsuario[0]['token']){
                    $finUrl='?token='.$tokenUsuario[0]['token'];
                }
            }
        
            foreach($partidos as $partido) {
                //apuestas/partido/104
                $text.=PHP_EOL.$emoji_star.$partido->local->nombre_corto.' vs '.$partido->visitante->nombre_corto.$emoji_star.PHP_EOL;
                
                $jsonApuestas = Utils::callApi($request, 'apuestas/partido/'.$partido->id.$finUrl, $urlApi);
                $apuestas = json_decode($jsonApuestas);
                foreach($apuestas as $apuesta) {
                    
                    if($apostante!=$apuesta->apostante->id){
                        $text.=$emoji_cara.$apuesta->apostante->nombre.PHP_EOL;
                        $apostante=$apuesta->apostante->id;
                    }
                    
                    $iconoApuesta=$emoji_guion;
                    //1 acertada
                    if($apuesta->acertada=="1"){
                        $iconoApuesta=$iconoApuesta.$emoji_ok;
                    }else if($apuesta->acertada=="2"){
                        $iconoApuesta=$iconoApuesta.$emoji_mal;
                    }else if($apuesta->acertada=="4"){
                        $iconoApuesta=$iconoApuesta.$emoji_tijeras;
                    }else if($apuesta->acertada=="3"){
                        $iconoApuesta=$iconoApuesta.$emoji_cerdo;
                    }
                    
                    $text.=$iconoApuesta.$apuesta->desc.':'.$apuesta->importe;
                        if($apuesta->cuota==0){
                            $text.='€'.PHP_EOL;
                        }else{
                            $text.='@'.$apuesta->cuota.PHP_EOL;
                        }
                }
            }
        
            if(sizeof($partidos)>0){
                $fechaTit= substr($fecha->fecha,8,2).'/'.substr($fecha->fecha,5,2).'/'.substr($fecha->fecha,0,4);
                //$fechaTit= $fecha->fecha;
                $text='*Apuestas '.$fechaTit.': *'.PHP_EOL.$text;
            }else{
                $text='*No hay próximos partidos*'.PHP_EOL;
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            
            $this->log->debug("Fin Obteniedo apuestas (".(microtime(true)-$time)." s): ");
            return $response;
        }
        
        private function euros($endpoint, $request,$grupoVO){
            $this->log->debug("Obteniedo euros");
            $time = microtime(true);
            $urlApi=$grupoVO->url_api;
            
            $response = new Response($endpoint, $request->get_chat_id(), Response::TYPE_CHAT_ACTION);
            $response->chat_action='typing';
            $response->send();
        
            $text='*Euros:*'.PHP_EOL;
        
        
            $url='';
             //Se comprueba si es un chat privado, para obtener el token del usuario
            if($request->is_private_chat()){
                $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
                $tokenUsuario = json_decode($jsonTokenUser, true);
                //var_dump($tokenUsuario);
                //Si hay token de usuario del chat, se invoca el comando con el token
                if($tokenUsuario[0]['token']){
                    $url='?token='.$tokenUsuario[0]['token'];
                }
            }
        
            $json = Utils::callApi($request, 'util/euros'.$url, $urlApi);
            $obj = json_decode($json);
            
            $jsonEurIni = Utils::callApi($request, 'propiedades/euros_iniciales'.$url, $urlApi);
            $eurIni = json_decode($jsonEurIni);

            if(is_array($obj) && property_exists($obj[0],'error')){
                $object = new stdClass();
                $object->hide_keyboard =true;
                $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $obj[0]->error->text, json_encode($object));
                return $response;
            }
            $jugado = 0 + floatval($obj->jugado);
            $ganado = 0 + floatval($obj->ganancia);
            $numSanciones = 0 + floatval($obj->num_sanciones);
            $importeSanciones = 0 + floatval($obj->importe_sanciones);
            $eurosIniciales = 0 + floatval($eurIni[0]->valor);

            if($jugado==0){
                $yield=0;
            }else{
                $yield = ($ganado/$jugado)*100;
            }
            $text.='Apostado: '.round($jugado,2).'€'.PHP_EOL;
            $text.='Ganado: '.round($ganado,2).'€'.PHP_EOL;
            $text.='Yield: '.round($yield,2).'%'.PHP_EOL.PHP_EOL;

            $text.='Nº Apuestas Sancionadas: '.$numSanciones.PHP_EOL;
            $text.='Ganado por Sanciones: '.round($importeSanciones,2).'€'.PHP_EOL.PHP_EOL;

            $text.='Euros Iniciales: '.round($eurosIniciales,2).'€'.PHP_EOL;
            $text.='Total Ganado: '.(round($eurosIniciales,2) + round($ganado,2)).'€'.PHP_EOL;

            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            
            $this->log->debug("Fin Obteniedo euros (".(microtime(true)-$time)." s): ");
            return $response;
        }
        
        private function apostadYa($endpoint, $request,$grupoVO){
            $this->log->debug("Obteniedo apostadYa");
            $time = microtime(true);
            $urlApi=$grupoVO->url_api;
            
            $response = new Response($endpoint, $request->get_chat_id(), Response::TYPE_CHAT_ACTION);
            $response->chat_action='typing';
            $response->send();
        
            $emoji_pointing= Utils::convert_emoji(0x1F449);
        	$emoji_r_arrow= Utils::convert_emoji(0x27A1);
        
            //Se obtiene la fase actual
            $jsonFaseActual = Utils::callApi($request, 'util/faseActual', $urlApi);
            $faseActual = json_decode($jsonFaseActual);
            $max_apostable = floatval($faseActual->importe);
            
            //Se obtiene la fecha del proximo partido
            $jsonFecha = Utils::callApi($request, 'util/fechaProxPartido/', $urlApi);
            $fecha = json_decode($jsonFecha);
            
            //Partidos de esa fecha
            $jsonPartidos = Utils::callApi($request, 'partidos/fecha/'.$fecha->fecha, $urlApi);
            $partidos = json_decode($jsonPartidos);

            //$text='*Faltan por apostar:*'.PHP_EOL;
            setlocale(LC_ALL,"es_ES");
            $text =  '*'.strftime("%d %b",strtotime($fecha->fecha)).' - Faltan por apostar:*'.PHP_EOL.PHP_EOL;
            
            $insultar=false;
            foreach($partidos as $partido){
                
                //Apostado en ese partido
                $jsonApostantes = Utils::callApi($request, '/util/apostadoApostantePartido/'.$partido->id, $urlApi);
                $apostantes = json_decode($jsonApostantes);
                
                $arrApostantes = $partido->usuarios;
                
                foreach($apostantes as $apostante){
                    if($apostante->apostado==$max_apostable){
                        $i=0;
                        foreach($arrApostantes as $apost){        
                            if($apost->id ==$apostante->idapostante){
                                array_splice($arrApostantes,$i,1);
                                continue;
                            }
                            $i++;
                        }
                    }
                }
                
                if(sizeof($arrApostantes)>0){
                     $text.=' *'.$partido->local->nombre_corto.' vs '.$partido->visitante->nombre_corto.'* '.substr($partido->hora,0,5).PHP_EOL;
                    $insultar=true;
                    foreach($arrApostantes as $apost){  
                        $text.=$emoji_pointing.$apost->nombre . PHP_EOL;
                    }
                }
            }
            if($insultar){
                $text.=PHP_EOL.'Apostad ya '.Utils::getInsultoPlural();
            }else{
                $text.="Han apostado todos. Muy bien " . Utils::getInsultoPlural() . "." . PHP_EOL;
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            
            $this->log->debug("Fin Obteniedo apostadYa (".(microtime(true)-$time)." s): ");
            return $response;
        }
        
        private function web($endpoint, $request,$grupoVO){
            $url =$grupoVO->url_web;
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $url, json_encode($object));
            return $response;
        }
        
        private function mispartidos($endpoint, $request,$grupoVO){
            
            $urlApi=$grupoVO->url_api;
            
            //Se comprueba si es un chat privado, para obtener el token del usuario
            if($request->is_private_chat()){
                $text = self::sendMisPartidos($request, $urlApi);
            }else{
                $text = 'Esto solo se puede usar en privado, motherfucker!!';
            }
            
            if($text==''){
                $text='No tienes partidos pendientes';
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            return $response;
        }
        
        
        private function sendMisPartidos($request, $urlApi){
            $text='';
            
            $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
            $tokenUsuario = json_decode($jsonTokenUser, true);

            //Si hay token de usuario del chat, se invoca el comando con el token
            if($tokenUsuario[0]['token']){
                $idUsuario = $tokenUsuario[0]['id'];
                
                $finUrl='?token='.$tokenUsuario[0]['token'];
                $jsonPartidos = Utils::callApi($request, 'partidos/usuario/'.$tokenUsuario[0]['token'], $urlApi);
                $partidos = json_decode($jsonPartidos);
                
                $fechaaux='';
                
                $emoji_star= Utils::convert_emoji(0x1F538);
                $emoji_guion= Utils::convert_emoji(0x2796);
                $emoji_cara=Utils::convert_emoji(0x1F633);
                $emoji_ok=Utils::convert_emoji(0x2705);
                $emoji_mal=Utils::convert_emoji(0x274C);
                $emoji_tijeras=Utils::convert_emoji(0x2702);
                $emoji_cerdo=Utils::convert_emoji(0x1F416);
            
                foreach($partidos as $part){  
                    setlocale(LC_ALL,"es_ES");
                    $fecha = strftime("%d %b %Y",strtotime($part->fecha));
                    if($fecha != $fechaaux){
                        $text.=PHP_EOL.'`      '.$fecha.' `'.PHP_EOL;
                        $fechaaux=$fecha;
                    }
                    $text.='*'.substr($part->hora,0,5).': '.$part->local->nombre_corto.' vs '.$part->visitante->nombre_corto.'*'.PHP_EOL;
                    
                    
                    /*Se obtienen las apuestas*/
                    $jsonApuestasPartidos = Utils::callApi($request, 'apuestas/partido/'.$part->id.'/'.$idUsuario.$finUrl, $urlApi);
                    $apuestas = json_decode($jsonApuestasPartidos);
                    
                    foreach($apuestas as $apuesta) {

                        $iconoApuesta=$emoji_guion;
                        //1 acertada
                        if($apuesta->acertada=="1"){
                            $iconoApuesta=$iconoApuesta.$emoji_ok;
                        }else if($apuesta->acertada=="2"){
                            $iconoApuesta=$iconoApuesta.$emoji_mal;
                        }else if($apuesta->acertada=="4"){
                            $iconoApuesta=$iconoApuesta.$emoji_tijeras;
                        }else if($apuesta->acertada=="3"){
                            $iconoApuesta=$iconoApuesta.$emoji_cerdo;
                        }
                        
                        $text.=$iconoApuesta.$apuesta->desc.':'.$apuesta->importe;
                        if($apuesta->cuota==0){
                            $text.='€'.PHP_EOL;
                        }else{
                            $text.='@'.$apuesta->cuota.PHP_EOL;
                        }
                    }
                    
                }
            }
            return $text;
        }
        
        private function apostar($endpoint, $request,$grupoVO){
            $urlApi=$grupoVO->url_api;
            //Se comprueba si es un chat privado, para obtener el token del usuario
            $text='';
            if($request->is_private_chat()){
                    
                $currentCMDDAO = new CurrentCMDDAO();
                $result = $currentCMDDAO->select($request->get_chat_id());
                if($result!=null){
                    //Si hay comando en curso, se borra y se inserta este
                    $currentCMDDAO->delete($request->get_chat_id());
                }
                
                $cmd=new CurrentCMDVO();
                $cmd->chat_id=$request->get_chat_id();
                $cmd->cmd='apostar';
                $cmd->grupo=$grupoVO->id;
                
                $resultInsertCMD = $currentCMDDAO->insert($cmd);
    
                $apostarCMDDAO = new ApostarCMDDAO();
                $cmd = new ApostarCMDVO();
                $cmd->chat_id=$request->get_chat_id();
                $resultInsertApostarCMD = $apostarCMDDAO->insert($cmd);
                
                $this->log->debug("apostar al grupo: ".$grupoVO->nombre);
                return self::preguntarPartido($endpoint, $request, $urlApi);
                  
            }else{
                $text = 'Esto solo se puede usar en privado, nigga!!';
            }
            
            return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
        }
        
        
        private function preguntarPartido($endpoint, $request, $urlApi){
            $this->log->debug("preguntar partidos ");
            $text='';
            
            $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
            $tokenUsuario = json_decode($jsonTokenUser, true);

            //Si hay token de usuario del chat, se invoca el comando con el token
            if($tokenUsuario[0]['token']){
                $finUrl='?token='.$tokenUsuario[0]['token'];
                $jsonPartidos = Utils::callApi($request, 'partidos/usuario/'.$tokenUsuario[0]['token'], $urlApi);
                $partidos = json_decode($jsonPartidos);
                $text='¿A que partido quieres apostar?'.PHP_EOL.PHP_EOL;
                $fechaaux='';
                $arr = Array();
                foreach($partidos as $part){  
                    setlocale(LC_ALL,"es_ES");
                    $fecha = strftime("%d %b %Y",strtotime($part->fecha));
                    if($fecha != $fechaaux){
                        $text.='*'.$fecha.'*'.PHP_EOL;
                        $fechaaux=$fecha;
                    }
                    $text.='*     '.substr($part->hora,0,5).': *'.$part->local->nombre_corto.' vs '.$part->visitante->nombre_corto.PHP_EOL;
                    array_push($arr, [$part->id.' | '.substr($part->hora,0,5).': '.$part->local->nombre_corto.' vs '.$part->visitante->nombre_corto]);
                }
                
                if(count($arr)==0){
                    $text='No tienes partidos pendientes';
                    return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
                }else{
                    $object = new stdClass();
                    $object->keyboard = $arr;
                    $object->resize_keyboard=true;
                    $object->one_time_keyboard=true;
                    return  Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
                }
            }else{
                $text='No he podido identificarte, cama';
                return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
            }
        }
        
        private function cuantoHaPerdidoRiojas($endpoint, $request,$grupoVO){
            $urlApi=$grupoVO->url_api;
            
            $result= Utils::quien_ha_perdido_mas($endpoint, $request, $urlApi);
            $humano = Utils::get_humano_name($request->get_from_id());
            $this->log->debug("Humano: ".$humano." - ".$request->get_from_id());
            switch($result){
                case 0:
                    $text= $humano. ', de momento llevas más pasta que el cocacolitas, sigue así';
                    return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
                    break;
                case 1:
                    $insulto = Utils::aleatorio(['Maldito', 'Jodido', 'Estúpido', 'Condenado', 'Retrasado', 'Podemita']);
                    $text = $insulto.' '.$humano.', si has perdido más pasta tú ';
                    return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
                    break;
                case 2:
                    $text= 'Pero mira que eres bobo gelete... No sabes ni lo que has perdido. Eres el Pedro Sánchez de las apuestas.';
                    return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
                    break;
                case 4:
                    $text= 'No se ni quién eres, mejor que ni me hables muerto de hambre.';
                    return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
                    break;
                default:
                    $text='Ni más ni menos que tú, parguela';
                    return Response::create_text_response($endpoint,  $request->get_chat_id(), $text);
                    break;
            }            
           
        }
        
        private function partidos_jornada($endpoint, $request,$grupoVO){
            $this->log->debug("Obteniedo partidos jornada");
            $time = microtime(true);
            $urlApi=$grupoVO->url_api;
            
            $response = new Response($endpoint, $request->get_chat_id(), Response::TYPE_CHAT_ACTION);
            $response->chat_action='typing';
            $response->send();
        
            //Se obtiene la fecha del proximo partido
            $jsonFase = Utils::callApi($request,'util/faseActual', $urlApi);
            $fase = json_decode($jsonFase);
            
            $this->log->debug("jsonFase: ".$jsonFase);
            
            
            $this->log->debug("url: ".'partidos/fase/'.$fase->id.'/'.$fase->tipo->id);

	        if($fase->tipo->id!=null){ 
	            $json = Utils::callApi($request, 'partidos/fase/'.$fase->id.'/'.$fase->tipo->id, $urlApi);
	        }else{
		        $json = Utils::callApi($request, 'partidos/fase/'.$fase->id, $urlApi);
	        }
            $obj = json_decode($json);
            
            $this->log->debug("jsonPartidos: ".$json);
            
            $text='';
            $fecha='';
            
            foreach($obj as $valor) {
                if($fecha!=$valor->fecha){
                    $fecha=$valor->fecha;
                    $text=$text.PHP_EOL.PHP_EOL.'*'.substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4).'*';
                }
                $text=$text.PHP_EOL;
                $idPartido=$valor->id;
                //Apostantes
                $apostantes='';
                $idx = 0;
                foreach($valor->usuarios as $usu) {
                    if($idx>0){
                        $apostantes.=', '.$usu->nombre;
                    }else{
                        $apostantes.=$usu->nombre;
                    }
                    $idx++;
                }
                $text=$text.substr($valor->hora,0,5).' '.$valor->local->nombre_corto.' vs '.$valor->visitante->nombre_corto;
                if($apostantes!=null){
                    $text.='=>'.$apostantes;   
                }
            }
        
            if($fecha==null){
                $text='*No hay próxima jornada* '.PHP_EOL;
            }else{
               // $fecha= substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4);
                $text='*Próxima jornada* '.PHP_EOL.$text;
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            
            $this->log->debug("Fin Obteniedo Próxima jornada (".(microtime(true)-$time)." s): ");
            return $response;
        }

	private function sincuota($endpoint, $request,$grupoVO){
            
            $urlApi=$grupoVO->url_api;
            
            //Se comprueba si es un chat privado, para obtener el token del usuario
            if($request->is_private_chat()){
                $text = self::sendMisPartidos($request, $urlApi);
                $text='';
            
                $jsonTokenUser = Utils::callApi($request, 'tokenusuario/'.$request->get_chat_id().'?token='.TOKEN_API_BOT, $urlApi);
                $tokenUsuario = json_decode($jsonTokenUser, true);

                //Si hay token de usuario del chat, se invoca el comando con el token
                if($tokenUsuario[0]['token']){
                    $idUsuario = $tokenUsuario[0]['id'];
                    
                    $finUrl='?token='.$tokenUsuario[0]['token'];
                    $json = Utils::callApi($request, 'apuestas/sincuota'.$finUrl, $urlApi);
                    $sinCuota = json_decode($json);
                    if(property_exists($sinCuota, 'error')){
                        $text = 'Esto solo lo puede usar un admin, tonto';
                    }else{
                        $emoji_guion= Utils::convert_emoji(0x2796);
                        if(sizeof($sinCuota)>0){
                            $text = '*Lista de partidos con apuestas sin cuotas:*';
                            foreach($sinCuota as $valor) {
                                $text.=PHP_EOL.$emoji_guion.' '.substr($valor->HORA,0,5).' '.$valor->LOCAL.' vs '.$valor->VISITANTE .' ('.$valor->NOMBRE.')';
                            }
                        }
                    }
                }

            }else{
                $text = 'Esto solo se puede usar en privado, motherfucker!!';
            }
            
            if($text==''){
                $emoji_ok=Utils::convert_emoji(0x2705);
                $text = $emoji_ok.' No hay apuestas sin cuota';
            }
            
            $object = new stdClass();
            $object->hide_keyboard =true;
            $response = Response::create_text_replymarkup_response($endpoint,  $request->get_chat_id(), $text, json_encode($object));
            return $response;
        }
    }
?>
