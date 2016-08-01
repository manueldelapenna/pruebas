<?php session_start(); 
include("../scripts/acceso.php");
require("../functions/funciones.php");
$personas = cargarDatos();

$menor = MenorDeEdad($personas);

$mensaje ="  " . $menor['nombre'] . " " . $menor['apellido'] . " tiene " . $menor['edad'] . " años y es la persona mas chica del array";
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
         
        <div class="jumbotron"> 
            <?php echo $mensaje; ?>    

        </div>
        
        <?php
            $path = $rootpath . '/pruebas/_partials/footer.php';
            include_once($path);
        ?>
    </body>
</html>
