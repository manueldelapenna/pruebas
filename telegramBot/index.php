<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pruebas/telegramBot/functions/funciones.php';
require_once 'functions/processCommand.php';

// GetUpdates para leer a partir del ultimo mensaje leido
$updateId = ultimoUpdateId();
$content = @file_get_contents(API_URL . 'getUpdates?offset=' . $updateId);
$update = json_decode($content, true);
$results = $update['result'];

foreach ($results as $result) {
    
$cmd = $result['message']['text'];
$chatID = $result["message"]["chat"]["id"];    

switch ($cmd) {
    
case "/start":
    saludo($chatID);
break;

case "/hombre":
    procesarSexo($chatID,'M');
    break;

case "/mujer":
    procesarSexo($chatID,'F');
    break;

case "/caja":
    procesarEntidad('caja');
    break;

case "/docentes":
    procesarEntidad('docentes');
    break;

case "/salud":
    procesarEntidad('salud');
    break;

case "/help":
    ayuda();
    break;

case "/cancelar":
    cancelar();
    break;
    
default:
    procesarLegajo();
    break;
}    
 actualizarUpdateId($result['update_id']);   
}
