<?php

define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');



// read incoming info and grab the chatID
$archivo = 'updateId.txt';
if (!$compararUpdateId = file_get_contents($archivo)) {
    die("imposible leer archivo");
}
$content = @file_get_contents(API_URL . 'getUpdates?offset=-1000');
$update = json_decode($content, true);
$results = $update['result'];

foreach ($results as $result) {

    if ($compararUpdateId < $result['update_id']) {
        @file_put_contents($archivo, $result['update_id']);
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
    }
}

function sendMessage() {
    $message = "Respuesta para Tomas.";
    return $message;
}
