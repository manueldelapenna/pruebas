<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pruebas/telegramBot/config/database.php';

require(dirname(__FILE__).'/../const.php');
function actualizarUpdateId($update_id) {

    $pdo = conectar();
    $ultimo = $update_id +1;
    $statement = $pdo->prepare("UPDATE configuracion "
            . "SET valor= '$ultimo' "
            . "where nombre= 'update_id'");
    $statement->execute();
}

function ultimoUpdateId() {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT valor "
            . "from configuracion "
            . "where nombre= 'update_id'");
    $statement->execute();
    $result = $statement->fetchColumn();
    return $result;
}

//Enviamos la respuesta
function enviar($chatID, $reply, $encodeado){
$sendto = API_URL . "sendmessage?chat_id=" . $chatID . "&text=" . $reply . "&reply_markup=" . $encodeado;
file_get_contents($sendto);
}


function existeChatId($chatID){
  //corrobora si existe el chatID
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT count(*) from datos
                                WHERE chatid = '$chatID'");
    $statement->execute();
    $result = $statement->fetchColumn();
    
    return $result;
}

function agregarChatID($chatID){
    //agregar chatID
    $pdo = conectar();
    $statement = $pdo->prepare("INSERT INTO datos(chatid) VALUES ('$chatID')");
    $result = $statement->execute();
}



function existeSexo($chatID){
    //comprueba si el campo sexo de ese chatID no esta vacio
   $pdo = conectar();
    $statement = $pdo->prepare("SELECT sexo from datos
                                WHERE chatid = '$chatID'");
    $statement->execute();
    $result = $statement->fetchColumn();
    if(!empty($result)){
        return TRUE;
    }
    return FALSE; 
}

function existeLegajo($chatID){
    //comprueba si existe el campo legajo del chatID no esta vacio
   $pdo = conectar();
    $statement = $pdo->prepare("SELECT legajo from datos
                                WHERE chatid = '$chatID'");
    $result = $statement->execute();
    $result = $statement->fetchColumn();
    if(!empty($result)){
        return TRUE;
    }
    return FALSE; 
    
}

function cambiarEntidad($chatID, $entidad){
    //cambia el campo entidad de ese chatID
     $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET entidad= '$entidad'
                                WHERE chatid= '$chatID'");
    $statement->execute();
}

function  borrarCampos($chatID){
    //limpia los campos sexo, legajo y entidad del chatID
    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET sexo= '', legajo='', entidad='' 
                                WHERE chatid='$chatID'");
    $statement->execute();
}

function cargarSexo($chatID,$string){
    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET sexo= '$string' 
                                WHERE chatid='$chatID'");
    $statement->execute();
}

function cargarEntidad($chatID,$entidad){
    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET entidad= '$entidad' 
                                WHERE chatid='$chatID'");
    $statement->execute();
}

function cargarLegajo($chatId,$legajo){
    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE datos 
                                SET legajo= '$legajo' 
                                WHERE chatid='$chatId'");
    $statement->execute();
}


function tieneLegajo($chatID){
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT legajo from datos
                                WHERE chatid = '$chatID'");
    $statement->execute();
    $result = $statement->fetchColumn();
    
    if(!empty($result)){
        return TRUE;
    }
    return FALSE;
}

function noTieneLegajo($chatID){
    $reply = "Debe ingresar un legajo";
    enviar($chatID,$reply,'');
}

function noTieneSexo($chatId){
    $reply = "No ha indicado el sexo de la persona, ingrese /hombre si la persona es masculina o /mujer si la persona es femenina";
    enviar($chatId,$reply,'');
}

function tieneSexo($chatID){
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT sexo from datos
                                WHERE chatid = '$chatID'");
    $statement->execute();
    $result = $statement->fetchColumn();
    
    if(!empty($result)){
        return TRUE;
    }
    return FALSE;
}