<?php

session_start();
include 'funciones.php';

$nombreGrupo = $_GET['nameGroup'];

if(!soloLetras($nombreGrupo)){
    
    $mensaje = "Debe ingresar un nombre de grupo que contenga solo letras";
    header("Location: ../web/agregarGrupo.php?mensaje=$mensaje");
    
}else{
    
    $pdo = conectar();
    $statement = $pdo->prepare("INSERT INTO grupos(name) VALUE (:name)");
    $statement->bindParam(':name', $nombreGrupo);
    $statement->execute();
    $mensaje = "El grupo ha sido agregado satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
    
}


    
