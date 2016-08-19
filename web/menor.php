<?php  
require_once("../scripts/acceso.php");
require_once("../functions/funciones.php");

$accesos = array("admin", "user");
tieneAcceso($accesos);
$menor = MenorDeEdad(todasPersonas());

$mensaje ="  " . $menor['nombre'] . " " . $menor['apellido'] . " tiene " . $menor['anios'] . " años y es la persona mas chica de la base de datos";
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
        <a href="listado.php" class="btn btn-info">Volver</a>
        <?php
            $path = $rootpath . '/pruebas/_partials/footer.php';
            include_once($path);
        ?>
    </body>
</html>
