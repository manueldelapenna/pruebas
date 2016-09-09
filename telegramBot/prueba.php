<?php

define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
include $_SERVER['DOCUMENT_ROOT'] . '/pruebas/telegramBot/functions/funciones.php';



// GetUpdates para leer a partir del ultimo mensaje leido
$updateId = ultimoUpdateId() + 1;
$content = @file_get_contents(API_URL . 'getUpdates?offset=' . $updateId);
$update = json_decode($content, true);
$results = $update['result'];

foreach ($results as $result) {

// Diferenciamos si es una respuesta del teclado o si es solo una palabra ingresada por el usuario

    /* if (isset($result['callback_query'])) { //respuesta del teclado
      $cmd = $result['callback_query']['data'];
      $chatID = $result['callback_query']["message"]["chat"]["id"];
      } else {                               //palabra mandada por el usuario
      $cmd = $result['message']['text'];
      $chatID = $result["message"]["chat"]["id"];
      } */

    $cmd = $result['message']['text'];
    $chatID = $result["message"]["chat"]["id"];

    if (!existeId($chatID)) {
        agregarChatID($chatID);
        $cmd = "/start";
    }

    switch ($cmd) {
        case "/start":
            $reply = "Buenos Dias!.Para comenzar a realizar la consulta deberá apretar uno de los botones para indicar de que sexo es la persona la cual desea consultar su informacion.Ante cualquier duda envie /help";

            $data = array(
                'text' => "Hombre",
                'callback_data' => "/hombre"
            );


            $data2 = array(
                'text' => "\xF0\x9F\x9A\xBA" . "Mujer",
                'callback_data' => "/mujer"
            );

            $keyboard = array(
                'keyboard' => array($data, $data2),
                'resize_keyboard' => true,
                'one_time_keyboard' => true,
                'force_reply' => true
            );

            $encodeado = json_encode($keyboard);

            enviar($chatID, $reply, $encodeado);
            break;

        case "Hombre":
        case "/hombre":
            cambiarSexo($chatID, 'M');
            $reply = "Ingrese numero de legajo";
            $encodeado = "";
            enviar($chatID, $reply, $encodeado);
            break;

        case "Mujer":
        case "/mujer":
            cambiarSexo($chatID, 'F');
            $reply = "Ingrese numero de legajo";
            $encodeado = "";
            enviar($chatID, $reply, $encodeado);
            break;
    }

    if (!existeSexo($chatID)) {
        $reply = "Debe ingresar /hombre o /mujer para indicar el sexo";
        $encodeado = "";
        enviar($chatID, $reply, $encodeado);
    }

    $legajo = preg_replace('/[^0-9]/i', $cmd);
    if (!existeLegajo($chatID) && preg_match("/^[0-9]{7,11}$/", $legajo)) {
        $reply = "Indique la entidad";
        $data = array(
            'text' => "Caja",
            'callback_data' => "Caja"
        );


        $data2 = array(
            'text' => "Docentes",
            'callback_data' => "Docentes"
        );

        $data3 = array(
            'text' => "Salud",
            'callback_data' => "Salud"
        );

        $keyboard = array(
            'keyboard' => array(array($data, $data2, $data3)),
            'resize_keyboard' => true,
            'one_time_keyboard' => true,
            'force_reply' => true
        );

        $encodeado = json_encode($keyboard);
        enviar($chatID, $reply, $encodeado);
    }

    switch ($cmd) {
        case "Caja":
            cambiarEntidad($chatID, 'Caja');
            break;

        case "Docentes":
            cambiarEntidad($chatID, 'Docentes');
            break;

        case "Salud":
            cambiarEntidad($chatID, 'Salud');
            break;
    }

    if (tieneTodo($chatID)) {
        $reply = "Gracias por realizar la consulta";
        $encodeado = "";
        borrarCampos($chatID);
        enviar($chatID, $reply, $encodeado);
    }


//Actualizamos el update_id
    actualizarUpdateId($result['update_id']);
    @file_get_contents(API_URL . 'getUpdates?offset=' . ($result['update_id'] + 1));
}

