<?php

require_once("../scripts/acceso.php");
require_once("../functions/funciones.php");
$mayorPersona = MayorDeEdad(listarPersonas());
$accesos = array("admin", "user");
tieneAcceso($accesos);


$mensaje ="  " . $mayorPersona['nombre'] . " " . $mayorPersona['apellido'] . " tiene " . $mayorPersona['anios'] . " años y es la persona mas grande de la base de datos";
?>

<!DOCTYPE html>

<html>
    <head>
        <?php
        $rootpath = $_SERVER['DOCUMENT_ROOT'];

        $path = $rootpath . '/pruebas/_partials/head.php';
        include_once($path);
        ?>
    </head>
    <body>

        <?php
        $path = $rootpath . '/pruebas/_partials/header.php';
        include_once($path);

        $path = $rootpath . '/pruebas/_partials/menu.php';
        include_once($path);
        ?>
        <br/>
        <br/>
        <div class="jumbotron centered"> 
<?php echo $mensaje; ?>    

        </div>

        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
    </body>
</html>
