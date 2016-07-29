<?php
require("../functions/funciones.php");
$personas = cargarDatos();

$mayor = MayorDeEdad($personas);

$mensaje = $mayor['nombre'] . " " . $mayor['apellido'] . " tiene " . $mayor['edad'] . "años y es la persona mas grande del array";
?>

<!DOCTYPE html>

<html>
    <head>

        <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        
        $path .= '/pruebas/_partials/head.php';
        include_once($path);
        ?>
    </head>
    <body>
        <div>
            <div id="header">
                <h1 style="text-align: center">Tarea</h1>
            </div>
            <div class="btn-group" role="group" aria-label="..." style="margin-left: 350px">
                <button type="button" class="btn btn-default" onClick="location.href = '../scripts/index.php'">Mostrar Datos</button>
                <button type="button" class="btn btn-default" onclick="location.href = '../scripts/mayor.php'" >Mayor de Edad</button>
                <button type="button" class="btn btn-default">Menor de Edad</button>
            </div>

        </div>
        <div> 
<?php echo $mensaje; ?>    

        </div>

    </body>
</html>
