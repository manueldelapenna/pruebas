<?php


require(dirname(__FILE__).'/../index.php');

function saludo($chatID){
    if(!existeChatId($chatID)){
        agregarChatID($chatID);
    }
    
     $reply = "Buenos Dias!.Para comenzar a realizar la consulta deberá apretar uno de los botones para indicar de que sexo es la persona la cual desea consultar su informacion.Ante cualquier duda envie /help";
     /*$data = array(
                'text' => 'Hombre',
                'callback_data' => '/hombre'
            );


            $data2 = array(
                'text' => '\xF0\x9F\x9A\xBA' . 'Mujer',
                'callback_data' => '/mujer'
            );

            $keyboard = array(
                'keyboard' => array($data, $data2),
                'resize_keyboard' => true,
                'one_time_keyboard' => true,
                
            );
     $encodeado = json_encode($keyboard);  */    
     enviar($chatID,$reply,'');
     
}

function procesarSexo($chatID,$string){
    if(!existeChatId($chatID)){
        agregarChatID($chatID);
    }
   if($string == "M"){
       $sexo = "un hombre";
   }else{
       $sexo = "una mujer";
   }
    $reply = "Usted ha ingresado que la persona es ".$sexo. ".Ahora ingrese el legajo de la persona";
    cargarSexo($chatID,$string);
    enviar($chatID,$reply,'');
}

function procesarLegajo($chatId,$legajo){
    if(!tieneSexo($chatId)){
        noTieneSexo($chatId);
        exit();
    }
    cargarLegajo($chatId,$legajo);
    $reply = "El legajo que ha ingresado es: ".$legajo. ".Ahora debe ingresar la entidad que pertenece: /caja, /docentes, /salud";
    enviar($chatId,$reply,'');
}

function procesarEntidad($chatID,$string){
   if(!tieneLegajo($chatID)){
       
       noTieneLegajo($chatID);
       exit();
   } 
   cargarEntidad($chatID,$string);
   $reply = "La entidad que se ha cargado es: ".$string.".Muchas gracias por realizar la consulta";
   borrarCampos($chatID);
   enviar($chatID,$reply,'');
}

