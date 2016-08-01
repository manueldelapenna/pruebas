<?php 
require("../scripts/acceso.php");
$acceso = tieneAcceso("admin");
require("../functions/funciones.php");
$aux = cargarDatos();
        
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

        <div> 
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Año Nacimiento</th>
                    </tr>
                </thead>    
                <tbody> 

                    <?php
                    foreach ($personas as $aux) {
                        ?>
                        <tr>
                            <td>  <?php echo $aux['nombre']; ?> </td>
                            <td> <?php echo $aux['apellido']; ?> </td>
                            <td> <?php echo $aux['edad']; ?></td>
                            <td> <?php echo AñoDeNacimiento($aux['edad']); ?></td>
                        <?php } ?>

                    </tr>  
                </tbody>
            </table>
        </div>
        <?php
            $path = $rootpath . '/pruebas/_partials/footer.php';
            include_once($path);
        ?>
    </body>
</html>
