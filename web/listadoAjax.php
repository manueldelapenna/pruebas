<?php
require("../scripts/acceso.php");
tieneAcceso('personas_listar');

require_once("../functions/funciones.php");
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
        $path = $rootpath . '/pruebas/functions/funciones.php';
        include_once($path);
        ?>
        <input type="text" placeholder="Buscar" id="busqueda" onkeyup="filterPerson()" name="busqueda"><br/><br/>
        <input type="button" class="btn btn-info" value="Traer Personas" name="button">


        <div id="result" class="jumbotron" style="display:none">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                    </tr>
                </thead>    
                <tbody class="body-table"> 
                </tbody>
            </table>
        </div>
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>

    </body>
</html>
