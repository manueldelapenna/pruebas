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
        <script src="../web/js/miUsuario.js" type="text/javascript"></script>
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


        <?php
        $user = $_SESSION['usuario'];
        $password = getPasswordUser($user);
        $idUser = getIdUsuario($user);
        $all = getAllUser($user);
        ?>

        <h2> <?php echo ucfirst($user) ?></h2>
        <div id="editarGrupo" class="col-md-5 col-md-offset-4 jumbotron">

            <div class="form-group" id="username-form-group"> 
                <input type="text" class="form-control" value="<?php echo ucfirst($user) ?>" placeholder="Nombre de usuario" name="username"><br/>
                <div class="help-block with-errors">
                    <ul class="list-unstyled">
                        <li id="username-error"></li>
                    </ul>
                </div>
            </div> 


            <div class="form-group" id="firstname-form-group"> 
                <input type="text" class="form-control" value="<?php echo ucfirst($all[0]['firstname']) ?>" placeholder="Nombre" name="firstname"><br/>
                <div class="help-block with-errors">
                    <ul class="list-unstyled">
                        <li id="firstname-error"></li>
                    </ul>
                </div>
            </div>

            <div class="form-group" id="lastname-form-group"> 
                <input type="text" class="form-control" value="<?php echo ucfirst($all[0]['lastname']) ?>" placeholder="Apellido" name="lastname"><br/>
                <div class="help-block with-errors">
                    <ul class="list-unstyled">
                        <li id="lastname-error"></li>
                    </ul>
                </div>
            </div>

            <div class="form-group" id="email-form-group"> 
                <input type="text" class="form-control" value="<?php echo ucfirst($all[0]['email']) ?>" placeholder="Email" name="email"><br/>
                <div class="help-block with-errors">
                    <ul class="list-unstyled">
                        <li id="email-error"></li>
                    </ul>
                </div>
            </div>


            <input type="checkbox" id="change-password">¿Desea Cambiar la contraseña?<br/>



            <div id="passwordContainer" style="display:none">
               <div class="form-group" id="password-form-group"> 
                    <input type="password" id="password" class="form-control" placeholder="Nueva Contraseña" name="password">
                    <input type="checkbox" id="show-password"><br/>
                    

                
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirmar Contraseña" name="confirmPassword">
                    <input type="checkbox" id="show-password2"><br/>
                    <div class="help-block with-errors">
                        <ul class="list-unstyled">
                            <li id="password-error"></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <input type="hidden" class="form-control" value="<?php echo $idUser ?>" name="id"><br/>
            <input type="button" value="Modificar Usuario" class="btn btn-info" onclick="modificarUsuario()">
            <a id="volver" class="btn btn-info">Volver</a>
            <div class="help-block with-errors"></div>

        </form>  
    </div>       

    <?php
    $path = $rootpath . '/pruebas/_partials/footer.php';
    include_once($path);
    ?>


</body>
</html>