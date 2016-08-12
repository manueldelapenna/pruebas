<?php

include 'funciones.php';
 echo $_POST['personaModificada']['nombe'];
$pdo = conectar();
$statement = $pdo->prepare('UPDATE INTO personas set nombre= :nombre, apellido= :apellido, fecha_nacimiento= :fecha_nacimiento');
$fecha_nacimiento = $_POST['nacimiento'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$errores = validarPersona($dni, $nombre, $apellido, $nacimiento);

if(count($errores) == 0){

$statement->bindParam(':fecha_nacimiento',  desformatearFechaNacimiento($nacimiento));
$statement->bindParam(':nombre', $nombre);
$statement->bindParam(':apellido', $apellido);
$statement->bindParam(':dni', $dni);
$statement->execute();

$mensaje = "La persona ha sido modificada satisfactoriamente";
header("Location: ../web/exito.php?mensaje=$mensaje");
}else{
    if(!isset($errores['nombre'])){
        $_SESSION['form_persona']['nombre']= $nombre;
    }
    if(!isset($errores['apellido'])){
        $_SESSION['form_persona']['apellido']= $apellido;
    }
    if(!isset($errores['dni'])){
        $_SESSION['form_persona']['dni']= $dni;
    }
    if(!isset($errores['nacimiento'])){
        $_SESSION['form_persona']['nacimiento']= $nacimiento;
    }
    
    
    $mensajes = implode('<br>', $errores);
   header("Location: ../web/modificarPersona.php?mensaje=$mensajes"); 
    
   
    }