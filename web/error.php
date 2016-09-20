<?php session_start(); ?>
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
        <div class="jumbotron">

            <p class="centered"><?php echo $_GET['error']; ?></p>
        </div>

<?php
$path = $rootpath . '/pruebas/_partials/footer.php';
include_once($path);
?>


    </body>
</html>
