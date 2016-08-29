<?php

session_start();
include 'funciones.php';

$nombreGrupo = $_POST['nameGroup'];
$permisos = $_POST['permisos'];
$grupoID = $_POST['grupoId'];

if (!soloLetras($nombreGrupo)) {

    $mensaje = "Debe ingresar un nombre de grupo que contenga solo letras";
    header("Location: ../web/agregarGrupo.php?mensaje=$mensaje");
} else {

    $pdo = conectar();
    //agregar grupos
    $statement = $pdo->prepare("UPDATE grupos 
                                SET name = :name 
                                WHERE id = :id");
    $statement->bindParam(':name', $nombreGrupo);
    $statement->bindParam(':id', $grupoID);
    $statement->execute();

    //Busco ID grupo
    $grupoID = $pdo->lastInsertId();


    //Borrar permisos actuales del grupo
    $statement = $pdo->prepare("DELETE FROM grupos_permisos
                                WHERE grupo_id = $grupoID");
    $statement->execute();

    //Agregar todos los permisos de nuevo
     foreach ($permisos as $permiso) {
        
       $string[] = "(" . $grupoID . "," . $permiso . ")";
        
    }
     $string = implode(",",$string);
     $statement = $pdo->prepare("INSERT INTO grupos_permisos(grupo_id,permisos_id) VALUES $string");
      $statement->execute();
    
    $mensaje = "El grupo ha sido modificado satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
}


    