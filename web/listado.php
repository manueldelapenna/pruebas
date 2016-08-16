<?php 
require("../scripts/acceso.php");
$accesos = array("admin");
tieneAcceso($accesos);

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
        $path = $rootpath . '/pruebas/functions/funciones.php';
        include_once($path);
        ?>

        <div>
            <?php if (in_array($_SESSION['usuario'], ['admin'])) { ?>
            <a href="formAgregarPersona.php" class="btn btn-info">Agregar Persona</a>
            <?php } ?>
            <?php if (in_array($_SESSION['usuario'], ['admin', 'user'])) { ?>
            <a href="mayor.php" class="btn btn-info">Mayor Edad</a>
            <a href="menor.php" class="btn btn-info">Menor Edad</a>
             <?php } ?>
            <table class="table">
                <thead>
                    <tr>
                        <th><a href="listado.php?orden=id&direccion=<?php echo (isset($_GET['direccion']))? direccionOrdenamiento($_GET['direccion']) : "ASC";  ?>">ID</a><span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                        <th><a href="listado.php?orden=nombre&direccion=<?php echo (isset($_GET['direccion']))? direccionOrdenamiento($_GET['direccion']) : "ASC";  ?>">Nombre</a><span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                        <th><a href="listado.php?orden=apellido&direccion=<?php echo (isset($_GET['direccion']))? direccionOrdenamiento($_GET['direccion']) : "ASC";  ?>">Apellido</a><span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                        <th><a href="listado.php?orden=fecha_nacimiento&direccion=<?php echo (isset($_GET['direccion']))? direccionOrdenamiento($_GET['direccion']) : "ASC";  ?>">Edad</a><span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                        <th><a href="listado.php?orden=fecha_nacimiento&direccion=<?php echo (isset($_GET['direccion']))? direccionOrdenamiento($_GET['direccion']) : "ASC";  ?>">Año Nacimiento</a><span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                        <th><a href="listado.php?orden=dni&direccion=<?php echo (isset($_GET['direccion']))? direccionOrdenamiento($_GET['direccion']) : "ASC";  ?>">Dni</a><span class="glyphicon glyphicon-circle-arrow-down"></span></th>
                    </tr>
                </thead>    
                <tbody> 

                    <?php
                    $orden = (isset($_GET['orden']))?$_GET['orden'] : "id";
                    $direccion = (isset($_GET['direccion']))?$_GET['direccion'] : "ASC";
                      foreach(listarPersonas($orden,$direccion) as $usuario){
                        ?>
                        <tr>
                            <td> <?php echo $usuario['id']; ?> </td>
                            <td> <?php echo ucfirst($usuario['nombre']); ?> </td>
                            <td> <?php echo ucfirst($usuario['apellido']); ?> </td>
                            <td> <?php echo edad($usuario['fecha_nacimiento']) ?></td>
                            <td> <?php echo formatearFechaNacimiento($usuario['fecha_nacimiento']); ?></td>
                            <td> <?php echo $usuario['dni']; ?></td>
                            <td><a href="formVerPersona.php?id=<?php echo $usuario['id'] ?>" class="btn btn-success">Ver</a></td>
                            <td> <a href="formModificarPersona.php?id=<?php echo $usuario['id'] ?>" class="btn btn-primary"> Modificar</a></td>
                            <td> <form action="../functions/eliminarPersona.php" method ="POST">
                                    <input type="hidden" value="<?php echo $usuario['dni']?>" name="dniPersona" >
                                    <input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger">
                                </form></td>    
                                
                        

                    </tr>  
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
            $path = $rootpath . '/pruebas/_partials/footer.php';
            include_once($path);
        ?>
    </body>
</html>
