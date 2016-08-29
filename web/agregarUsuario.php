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

        <div id="formAgregar" class=" row container col-md-12">
            <form class="form-inline" action="../functions/funAgregarUsuario.php" method="POST">
                <input type="text" class="form-control" placeholder="Nombre del Usuario" name="nameUser">
                <input type="password" class="form-control" placeholder="Contraseña" name="passUser"><br/>
                
                <div class="col-md-6 col-md-offset-3">
                <label>Indique Grupos</label><br/>
                
                <?php 
                foreach(getGrupos() as $grupo){
                ?>   
                
                <input type="checkbox" name="grupos[]" value="<?php echo $grupo['id']?>"><?php echo $grupo['name'] ?><br/>
                
                <?php    
                }
                ?>
                </div>
                <div class="col-md-6 col-md-offset-3">
                <label>Indique los permisos</label><br/>
                
                <?php 
                foreach(getPermisos() as $permiso){
                ?>   
                
                <input type="checkbox" name="permisos[]" value="<?php echo $permiso['id']?>"><?php echo $permiso['name'] ?><br/>
                
                <?php    
                }
                ?>
                
                
                <input type="submit" value="Agregar Usuario" class="btn btn-info">
                <a href="index.php" class="btn btn-info">Volver a inicio</a>
            </form>
            </div>
        </div>



        <?php
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        }

        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>

    </body>
</html>
