<?php

include 'funciones.php';

$pdo = conectar();
$statement = $pdo->prepare("INSERT INTO personas(dni,nombre,apellido,fecha_nacimiento) VALUE (:dni,:nombre, :apellido, :fecha_nacimiento)");
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$nacimiento = $_POST['nacimiento'];
//validacion dni
if (is_numeric($dni) == 1 && strlen($dni) <= 8) {
   
   $statement->bindParam(':dni', $dni);
}else{
    
    $mensaje = "Dni incorrecto";
    header("Location: ../web/formAgregarPersona.php?mensaje=$mensaje");
}
//fin validacion dni
//
//validacion nombre y apellido
if(is_string($nombre) == 1 && is_string($apellido) == 1){
    
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':apellido', $apellido);
    
}else{
    
    $mensaje = "Solo se permiten letras en el nombre y apellido";
    header("Location: ../web/formAgregarPersona.php?mensaje=$mensaje");
}

//fin validacion nombre y apellido
//
//validacion del año de nacimiento
if (validarFecha($nacimiento) == 1) {
    
     $edad = edad($nacimiento);
    if ($edad > 18) {

        $statement->bindParam(':fecha_nacimiento', $nacimiento);
    } else {
        
        $mensaje = "La persona debe ser mayor a 18 años";
        header("Location: ../web/formAgregarPersona.php?mensaje=$mensaje");
        exit();
    }
} else {
    
    $mensaje = "Año de nacimiento incorrecto ej: dd-mm-aaa";
    header("Location: ../web/formAgregarPersona.php?mensaje=$mensaje");
}
//fin validacion año de nacimiento


$statement->execute();

$mensaje = "La persona ha sido agregada satisfactoriamente";
header("Location: ../web/exito.php?mensaje=$mensaje");
?>    
