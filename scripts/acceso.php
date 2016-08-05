<?php

session_start();
require("../functions/funciones.php");
function tieneAcceso($usernameArray) {

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../web/index.php");
        exit();
    } else {

        $tieneAcceso = in_array($_SESSION['usuario'], $usernameArray);
        
         if (!$tieneAcceso) {
            $error = "El usuario no tiene acceso";
            header("Location: ../web/error.php/error=$error");
            return FALSE;
        }
         return TRUE;
    }
}

?>
