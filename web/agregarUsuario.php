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


        <form class="form-inline" action="../functions/funAgregarUsuario.php" method="POST">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-2">
                    <input type="text" class="form-control" placeholder="Nombre del Usuario" name="nameUser">
                    <input type="password" class="form-control" placeholder="Contraseña" name="passUser">
                    <input type="text" class="form-control" placeholder="Email" name="email">  <br/>
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <label>Indique Grupos</label><br/>

                    <?php
                    foreach (getGrupos() as $grupo) {
                        ?>   

                        <input type="checkbox" name="grupos[]" value="<?php echo $grupo['id'] ?>"><?php echo $grupo['name'] ?><br/>

                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-3 ">
                    <label>Indique los permisos</label><br/>

                    <?php
                    foreach (getPermisos() as $permiso) {
                        ?>   

                        <input type="checkbox" name="permisos[]" value="<?php echo $permiso['id'] ?>"><?php echo $permiso['name'] ?><br/>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-4">
                    <input type="submit" value="Agregar Usuario" class="btn btn-info" id="agregar">
                    <a href="index.php" class="btn btn-info">Volver a inicio</a>
                </div>
            </div>
        </form>





        <?php
        if (isset($_GET['mensaje'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_GET['mensaje']; ?>
            </div> 

            <?php
        }
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>

        <script>
            $('#agregar').click(function () {
                var string = $('input[name="grupos[]"]');
                alert(string);
            });

        </script>

    </body>
</html>
