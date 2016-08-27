<?php

session_start();
include 'funciones.php';

$nombreGrupo = $_POST['nameGroup'];
$permisos = $_POST['permisos'];

if(!soloLetras($nombreGrupo)){
    
    $mensaje = "Debe ingresar un nombre de grupo que contenga solo letras";
    header("Location: ../web/agregarGrupo.php?mensaje=$mensaje");
    
}else{
    
    $pdo = conectar();
    //agregar grupos
    $statement = $pdo->prepare("INSERT INTO grupos(name) VALUES (:name)");
    $statement->bindParam(':name', $nombreGrupo);
    $statement->execute();
    //Busco ID grupo
    $grupoID = $pdo->lastInsertId();
    //Armamos values
    foreach($permisos as $permiso){
        $string[] = "(".$grupoID.",".$permiso.")";
    }
    $string = implode(",",$string);
 ;  
     //Asociacion entre grupos y permisos
    $statement = $pdo->prepare("INSERT INTO grupos_permisos(grupo_id,permisos_id) VALUES $string");
    $statement->execute();
    
    $mensaje = "El grupo ha sido agregado satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
    
    
}


    
