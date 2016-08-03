<?php

session_start();
require("../functions/funciones.php");
$usuarios = obtenerUsuarios();

function tieneAcceso($usernameArray) {

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../web/index.php");
        exit();
    } else {

        $tieneAcceso = in_array($_SESSION['usuario'], $usernameArray);
        
         if (!$tieneAcceso) {
            die("El usuario no tiene acceso para acceder al contenido");
        }
    }
}

?>
