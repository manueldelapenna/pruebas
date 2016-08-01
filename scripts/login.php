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
        
        <div class="form-group container">
            <form class="form-inline" action="validar.php" method="POST"> 
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="usuario"  placeholder="Usuario" name="usuario">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="contrasena">
                <input type="submit" class="btn btn-primary" value="Sign In">
            </form>
        </div>
    </div>


    <?php
    $path = $rootpath . '/pruebas/_partials/footer.php';
    include_once($path);
    ?>




</body>
</html>