<?php

session_start();
require("../functions/funciones.php");

function tieneAcceso($nombrePermiso) {

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../web/index.php");
        exit();
    } else {

        $tieneAcceso = tienePermiso($_SESSION['usuario'], $nombrePermiso);

        if ($tieneAcceso) {
            return TRUE;
        }
        $error = "El usuario no tiene acceso";
        header("Location: ../web/error.php?error=$error");
        return FALSE;
    }
}

?>
