<?php

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$error = "";
if($usuario == "" || $contrasena == ""){
    $error = 'Debe completar todos los campos';
    header("Location: ../web/index.php?error=$error");
    exit();
    
}





if(($usuario == "user" && $contrasena == "user")||
   ($usuario == "admin" && $contrasena == "admin")){
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("Location: ../web/index.php");
    exit();
}else{
    $error = "No existe el usuario";
    header("Location: ../web/index.php?error=$error");
    
    exit();
    
}
?>
