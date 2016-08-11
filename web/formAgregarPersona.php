<?php
require_once("../scripts/acceso.php");
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
        $error = "";
        ?>
        <br/>
        <br/>
        <?php var_dump($_SESSION); ?>
        <div id="formAgregar" class="col-md-4 col-md-offset-4">
        <form class="form-inline " action="../functions/agregarPersona.php" method="POST"> 

            <input type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre">*<br/>

            <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido">*<br/>

            <input type="text" class="form-control" id="dni" placeholder="Documento" name="dni" sytle="margin-left: 81px;">* ej:38706974<br/>

            <input type="text" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" name="nacimiento">* ej:21/02/1986<br/><br/>
            <input type="submit" class="btn btn-primary" value="Agregar Persona">
        </form>
        
        <?php
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        }?>
            
        </div> 
            
         <?php   
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        
    </body>
</html>
