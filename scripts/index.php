<?php
require("../functions/funciones.php");
$personas = cargarDatos();
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

    </body>
</html>
