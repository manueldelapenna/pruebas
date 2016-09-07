<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pruebas/telegramBot/config/database.php';

function actualizarUpdateId($update_id) {

    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE configuracion "
            . "SET valor=$update_id "
            . "where nombre='update_id'");
    $statement->execute();
    $result = $statement->fetchColumn();


    return $result;
}

function ultimoUpdateId() {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT valor "
            . "from configuracion "
            . "where nombre='update_id'");
    $statement->execute();
    $result = $statement->fetchColumn();


    return $result;
}

//Enviamos la respuesta
function enviar($chatID, $reply, $encodeado){
$sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply . "&reply_markup=" . $encodeado;
file_get_contents($sendto);
return;
}


function existeId($chatID){
  //corrobora si existe el chatID
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT id from telegramBot");
    $result = $statement->fetchColumn();
    if($result){
        return TRUE;
    }
    return FALSE;
    
}

function agregarChatID($chatID){
    //agregar chatID
    $pdo = conectar();
    $statement = $pdo->prepare("INSERT INTO datos (chatid, sexo, legajo, entidad) VALUES ($chatID, '', '', '')");
    $result = $statement->fetchColumn();
    
    return $result;
}

function cambiarSexo($chatID, $string){
    //cambia el sexo de la persona que tiene el chatID
 $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET sexo=$string 
                                WHERE chatid=$chatID");
    $statement->execute();
    $result = $statement->fetchColumn();


    return $result;   
}

function existeSexo($chatID){
    //comprueba si el campo sexo de ese chatID no esta vacio
   $pdo = conectar();
    $statement = $pdo->prepare("SELECT sexo from telegramBot
                                WHERE id=$chatID");
    $result = $statement->fetchColumn();
    if($result){
        return TRUE;
    }
    return FALSE; 
}

function existeLegajo($chatID){
    //comprueba si existe el campo legajo del chatID no esta vacio
   $pdo = conectar();
    $statement = $pdo->prepare("SELECT legajo from telegramBot
                                WHERE id=$chatID");
    $result = $statement->fetchColumn();
    if($result){
        return TRUE;
    }
    return FALSE; 
    
}

function cambiarEntidad($chatID, $entidad){
    //cambia el campo entidad de ese chatID
     $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET entidad=$entidad
                                WHERE chatid=$chatID");
    $statement->execute();
    $result = $statement->fetchColumn();


    return $result; 
}

function  borrarCampos($chatID){
    //limpia los campos sexo, legajo y entidad del chatID
}