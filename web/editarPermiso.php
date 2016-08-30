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
        ?>
        <br/>
        <br/>
<!--Cuerpo-->
<?php 
$permisoId = $_GET['id'];
$permiso = getPermiso($permisoId);
?>

<form action="../functions/funEditarPermiso.php" method="GET">
    <input type="text" value="<?php echo $permiso[0]['name'];?>" name="permisoName">
    <input type="hidden" value ="<?php echo $permisoId;?>" name="permisoId">
    <input type="submit" value="Modificar Permiso" class="btn btn-info">
</form>
<br/>

<a href="verPermisos.php" class="btn btn-info">Volver</a>

        
        
        
<!--Footer-->   
 <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>