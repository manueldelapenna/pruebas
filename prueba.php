<?php

define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
include 'functions/funciones.php';

$keyboard = array(
    'keyboard' => array(array('Hola', 'Chau')),
    'one_time_keyboard' => true,
    'resize_keyboard' => true
);


// read incoming info and grab the chatID
$updateId = ultimoUpdateId() + 1;
$content = @file_get_contents(API_URL . 'getUpdates?offset=' . $updateId);
$update = json_decode($content, true);
$results = $update['result'];

foreach ($results as $result) {

    // compose reply
	
	if(isset($result['callback_query'])){
		$cmd = $result['callback_query']['data'];
		$chatID = $result['callback_query']["message"]["chat"]["id"];
	}else{
		$cmd = $result['message']['text'];
		$chatID = $result["message"]["chat"]["id"];
	}
	
    switch ($cmd) {

        case "/hombre":
            $reply = "La persona ingresada es un hombre";
            $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
            file_get_contents($sendto);
            break;

        case "/mujer" :
            $reply = "La persona ingresada es una mujer";
            $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
            file_get_contents($sendto);
            break;
        
        case "/mayor" :
            $mayorPersona = MayorDeEdad(todasPersonas());
            $reply ="  " . $mayorPersona['nombre'] . " " . $mayorPersona['apellido'] . " tiene " . $mayorPersona['anios'] . " años y es la persona mas grande de la base de datos";
             $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
            file_get_contents($sendto);
            break;
            
        case "/menor" :
            $menorPersona = MenorDeEdad(todasPersonas());
            $reply ="  " . $menorPersona['nombre'] . " " . $menorPersona['apellido'] . " tiene " . $menorPersona['anios'] . " años y es la persona mas chica de la base de datos";
             $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
            file_get_contents($sendto);   
            break;
        
        case "/usuarios":
            $usuarios = todasPersonas();
            foreach($usuarios as $usuario){
                $user['nombre']=$usuario['nombre'];
                $user['apellido']=$usuario['apellido'];
                $reply=  json_encode($user);
             $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
            file_get_contents($sendto);
            }
            
            break;
            
        default:
            $chatID = $result["message"]["chat"]["id"];

            $keyboard = array(
                'keyboard' => array(array('/hombre', '/mujer'),array('/mayor','/menor')),
                'one_time_keyboard' => true,
                'resize_keyboard' => true
            );
            $encodeado = json_encode($keyboard);

			$data = array();
			$data['text'] = "Hombre";
			$data['callback_data'] = "/hombre";
			
			$data2 = array();
			$data2['text'] = "Mujer";
			$data2['callback_data'] = "/mujer";
			
			$data3 = array();
			$data3['text'] = "Mayor";
			$data3['callback_data'] = "/mayor";
			
			$data4 = array();
			$data4['text'] = "Menor";
			$data4['callback_data'] = "/menor";
			
			$keyboard = array();
			$keyboard['inline_keyboard'] = array(array($data, $data2), array( $data3, $data4));
			
			$encodeado = json_encode($keyboard);
			
            $reply = "Seleccione un boton";
            $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply . "&reply_markup=" . $encodeado;
            file_get_contents($sendto);
            break;
            }
    //$chatID = $result["message"]["chat"]["id"];
    // send reply
    /* $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
      file_get_contents($sendto); */

    actualizarUpdateId($result['update_id']);
    @file_get_contents(API_URL . 'getUpdates?offset=' . ($result['update_id'] + 1));
}

