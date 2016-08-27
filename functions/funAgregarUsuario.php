<?php

session_start();
include 'funciones.php';

$nombreUsuario = $_POST['nameUser'];
$passUsuario = $_POST['passUser'];

if($nombreUsuario == ""){
    
    $mensaje = "Debe ingresar un usuario";
    header("Location: ../web/agregarPermiso.php?mensaje=$mensaje");
    
}else{
    
    $pdo = conectar();
    $statement = $pdo->prepare("INSERT INTO usuarios(username,password,fecha_alta) VALUE (:username,:password, :fecha_alta)");
    $statement->bindParam(':username', $nombreUsuario);
    $statement->bindParam(':password', $passUsuario);
    $statement->bindParam(':fecha_alta',$horaActual = date('Y-m-d H:i:s'));
    $statement->execute();
    $mensaje = "El usuario ha sido agregado satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
    
}

