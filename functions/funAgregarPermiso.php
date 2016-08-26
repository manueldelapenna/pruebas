<?php

session_start();
include 'funciones.php';

$nombrePermiso = $_GET['namePermiso'];

if($nombrePermiso == ""){
    
    $mensaje = "Debe ingresar un permiso";
    header("Location: ../web/agregarPermiso.php?mensaje=$mensaje");
    
}else{
    
    $pdo = conectar();
    $statement = $pdo->prepare("INSERT INTO permisos(name) VALUE (:name)");
    $statement->bindParam(':name', $nombrePermiso);
    $statement->execute();
    $mensaje = "El permiso ha sido agregado satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
    
}

