<?php

define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
include 'functions/funciones.php';



// read incoming info and grab the chatID
$updateId = ultimoUpdateId() + 1;
$content = @file_get_contents(API_URL . 'getUpdates?offset='.$updateId);
$update = json_decode($content, true);
$results = $update['result'];

foreach ($results as $result) {

         // compose reply

        switch ($result['message']['text']) {

            case "/start":
                $reply = sendMessage();
                break;

            case "/hombre":
                $reply = "La persona ingresada es un hombre";
                break;

            case "/mujer" :
                $reply = "La persona ingresada es una mujer";
                break;

            default:
                $reply = "Los comandos permitidos son:  /start, /hombre, /mujer";
        }
        $chatID = $result["message"]["chat"]["id"];
        // send reply
        $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply;
        file_get_contents($sendto);
        
        actualizarUpdateId($updateId);
    
}

function sendMessage() {
    $message = "Respuesta para Tomas.";
    return $message;
}
