<?php session_start();?>
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

        if (isset($_SESSION['usuario'])) {
            ?>
            <div class="jumbotron">

            <p class="centered"><?php echo $_GET['mensaje']; ?></p>
            </div>
        <?php } else { ?>
            <br>
            <div class="form-group container">
                <?php
                $path = $rootpath . '/pruebas/_partials/login.php';
                include_once($path);
                if (isset($_GET['mensaje'])) {
                    echo $_GET['mensaje'];
                }
            }
            ?> 
             <a href="index.php" class="btn btn-info">Volver a inicio</a>
            </div>
        
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>
