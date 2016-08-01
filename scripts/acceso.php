<?php
session_start();
require("../functions/funciones.php");
$usuarios = obtenerUsuarios();
foreach($usuarios as $usuario){
   echo $usuario['nombre']."<br>";
   
}


function tieneAcceso($username){
    
 if(!isset($_SESSION['usuario'])){
    header("Location: ../web/index.php");
    exit();
} else if($_SESSION['usuario'] != $username){
    die("El usuario no tiene acceso para acceder al contenido");
    
}   
    
}

?>
