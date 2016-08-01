<?php

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if(empty($usuario) || empty($contrasena)){
    header("Location: login.php");
    echo "Debe completar todos los campos";
    exit();
}

if($usuario == "admin" && $contrasena == "admin"){
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("Location: bienvenida.php");
}else{
    header("Location: login.php");
    echo "No existe el usuario";
    
}

?>
