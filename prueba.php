<?php

define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
include 'functions/funciones.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');


// GetUpdates para leer a partir del ultimo mensaje leido
$updateId = ultimoUpdateId() + 1;
$content = @file_get_contents(API_URL . 'getUpdates?offset=' . $updateId);
$update = json_decode($content, true);
$results = $update['result'];

foreach ($results as $result) {

    // Diferenciamos si es una respuesta del teclado o si es solo una palabra ingresada por el usuario

    if (isset($result['callback_query'])) { //respuesta del teclado
        $cmd = $result['callback_query']['data'];
        $chatID = $result['callback_query']["message"]["chat"]["id"];
    } else {                               //palabra mandada por el usuario
        $cmd = $result['message']['text'];
        $chatID = $result["message"]["chat"]["id"];
    }

    switch ($cmd) {

        case "/hombre":
            $reply = "La persona ingresada es un hombre";
            $encodeado = "";
            break;

        case "/mujer" :
            $reply = "La persona ingresada es una mujer";
            $encodeado = "";
            break;

        case "/mayor" :
            $mayorPersona = MayorDeEdad(todasPersonas());
            $reply = "  " . $mayorPersona['nombre'] . " " . $mayorPersona['apellido'] . " tiene " . $mayorPersona['anios'] . " años y es la persona mas grande de la base de datos";
            $encodeado = "";
            break;

        case "/menor" :
            $menorPersona = MenorDeEdad(todasPersonas());
            $reply = "  " . $menorPersona['nombre'] . " " . $menorPersona['apellido'] . " tiene " . $menorPersona['anios'] . " años y es la persona mas chica de la base de datos";
            $encodeado = "";
            break;

        case "/hora":
            $reply = date('d-m-Y H:i:s');
            $encodeado = "";
            
            break;

        default:
            //Creamos el teclado
            $data = array(
                'text' => "\xF0\x9F\x9A\xB9" . "Hombre",
                'callback_data' => "/hombre"
            );


            $data2 = array(
                'text' => "\xF0\x9F\x9A\xBA" . "Mujer",
                'callback_data' => "/mujer"
            );

            $data3 = array(
                'text' => "\xF0\x9F\x91\xB4" . "Mayor",
                'callback_data' => "/mayor"
            );


            $data4 = array(
                'text' => "\xF0\x9F\x91\xB6" . "Menor",
                'callback_data' => "/menor"
            );
            
            $data5 = array(
                'text' => "\xE2\x8F\xB0"."Hora",
                'callback_data' => "/hora"
            );

            $keyboard = array(
                'inline_keyboard' => array(array($data, $data2), array($data3, $data4, $data5))
            );

            $encodeado = json_encode($keyboard);

            $reply = "Seleccione un boton";
            break;
    }
    //Enviamos la respuesta
    $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply . "&reply_markup=" . $encodeado;
    file_get_contents($sendto);
    //Actualizamos el update_id
    actualizarUpdateId($result['update_id']);
    @file_get_contents(API_URL . 'getUpdates?offset=' . ($result['update_id'] + 1));
}

