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


        <?php
        $user = $_SESSION['usuario'];
        $password = getPasswordUser($user);
        $idUser = getIdUsuario($user);
        $all = getAllUser($user);
        ?>

        <h2> <?php echo ucfirst($user) ?></h2>
        <div id="editarGrupo" class="col-md-12 col-md-offset-4">
            <form class="form-inline" action="../functions/funEditarMiUsuario.php" method="POST">
                <input type="text" class="form-control" value="<?php echo ucfirst($user) ?>" name="username"><br/>
                <input type="text" class="form-control" value="<?php echo ucfirst($all[0]['firstname']) ?>" placeholder="Nombre" name="firstname"><br/>
                <input type="text" class="form-control" value="<?php echo ucfirst($all[0]['lastname']) ?>" placeholder="Apellido" name="lastname"><br/>
                <input type="text" class="form-control" value="<?php echo ucfirst($all[0]['email']) ?>" placeholder="Email" name="email"><br/>
                <input type="checkbox" id="change-password">¿Desea Cambiar la contraseña?<br/>
                <div id="passwordContainer" style="display:none">
                    <input type="password" id="password" class="form-control" placeholder="Nueva Contraseña" name="password">
                    <input type="checkbox" id="show-password"><br/>
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirmar Contraseña" name="confirmPassword">
                    <input type="checkbox" id="show-password2"><br/>
                </div>
                <input type="hidden" class="form-control" value="<?php echo $idUser ?>" name="id"><br/>
                <input type="submit" value="Modificar Usuario" class="btn btn-info">
                <a href="verUsuarios.php" class="btn btn-info">Volver</a>
            </form>
        </div>       

        <script>
            $(document).ready(function () {
                $("#show-password").click(function () {
                    if ($(this).is(':checked')) {
                        $("#password").prop("type", "text");
                    } else {
                        $("#password").prop("type", "password");
                    }
                })

                $("#show-password2").click(function () {
                    if ($(this).is(':checked')) {
                        $("#confirmPassword").prop("type", "text");
                    } else {
                        $("#confirmPassword").prop("type", "password");
                    }
                })

                $("#change-password").click(function () {
                    if ($(this).is(':checked')) {
                        $("#passwordContainer").show();
                    } else {
                        $("#password").val("");
                        $("#confirmPassword").val("");
                        $("#passwordContainer").hide();

                    }
                })
            });
        </script>
        <?php
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        }
        ?>


        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>