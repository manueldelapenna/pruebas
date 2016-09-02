<?php

define('BOT_TOKEN', '267163407:AAHVbvi2N0AFTerkb3ZiDoNPf-zNI5RzDRE');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
include 'functions/funciones.php';



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
    
    $cortado = substr($cmd, 0, 1);
    
    if($cortado == "M" || $cortado == "F"){
      echo $cortado;      
    }
    
    
    if (is_numeric($cmd) && strlen($cmd) <= 11) {
        $legajo = $cmd;
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
    } else {

        switch ($cmd) {

            case "/start":
                $reply = "Buenos Dias!.Escriba /help y obtendra informacion sobre el funcionamiento del programa." .
                        $encodeado = "";
                break;

            case "/help":
                $reply = 'Abajo a la derecha hay un recuadro con el simbolo "/" el cual va a obtener los comandos que puede ingresar. ';
                $encodeado = "";
                break;

            case "Hombre":
            case "/hombre":
                $string = "M";
                $reply = "Ingrese numero de legajo";
               $encodeado = "";
               break;

            case "Docentes":
                $reply = $string ."".$legajo." Docentes";
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
            case "/input":
                $reply = '<form action="prueba.php" method="POST">
                      <input type="text" placeholder="ingrese legajo de la persona"> ';
                $encodeado = "";
                $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&parse_mode=HTML&text=" . $reply . "&reply_markup=" . $encodeado;
                file_get_contents($sendto);

                break;

            default:
                //Creamos el teclado
                $data = array(
                    'text' => "Hombre",
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
                    'text' => "\xE2\x8F\xB0" . "Hora",
                    'callback_data' => "/hora"
                );
                $data6 = array(
                    'text' => "Input",
                    'callback_data' => "/input"
                );


                $keyboard = array(
                    'keyboard' => array(array($data, $data2, $data6), array($data3, $data4, $data5))
                );

                $encodeado = json_encode($keyboard);

                $reply = "Seleccione un boton";
                break;
        }
    }
    //Enviamos la respuesta
    $sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply . "&reply_markup=" . $encodeado;
    file_get_contents($sendto);
    //Actualizamos el update_id
    actualizarUpdateId($result['update_id']);
    @file_get_contents(API_URL . 'getUpdates?offset=' . ($result['update_id'] + 1));
}

