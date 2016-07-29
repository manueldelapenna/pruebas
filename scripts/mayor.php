<?php
require("../functions/funciones.php");
$personas = cargarDatos();

$mayor = MayorDeEdad($personas);

$mensaje = $mayor['nombre'] . " " . $mayor['apellido'] . " tiene " . $mayor['edad'] . " años y es la persona mas grande del array";
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

        <div class="jumbotron"> 
            <?php echo $mensaje; ?>    

        </div>
        
        <?php
            $path = $rootpath . '/pruebas/_partials/footer.php';
            include_once($path);
        ?>
    </body>
</html>
