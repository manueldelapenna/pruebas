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
            <br/>
            
            <div class="jumbotron">

            <p class="centered">Bienvenido <?php echo $_SESSION['usuario']; ?></p>
            </div>
        <?php } else { ?>
            <br>
            <div class="form-group">
                <?php
                $path = $rootpath . '/pruebas/_partials/login.php';
                include_once($path);
                if (isset($_GET['error'])) {
                    echo $_GET['error'];
            
                }
                ?>
            </div>
            <?php
            }
            ?> 
            
           
        
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>
