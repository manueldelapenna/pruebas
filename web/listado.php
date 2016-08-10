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
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                       <th>Año Nacimiento</th>
                       <th>Dni</th>
                    </tr>
                </thead>    
                <tbody> 

                    <?php
                      foreach(listarPersonas() as $usuario){
                        ?>
                        <tr>
                            <td> <?php echo ucfirst($usuario['nombre']); ?> </td>
                            <td> <?php echo ucfirst($usuario['apellido']); ?> </td>
                            <td> <?php echo edad($usuario['fecha_nacimiento']) ?></td>
                            <td> <?php echo formatearFechaNacimiento($usuario['fecha_nacimiento']); ?></td>
                            <td> <?php echo $usuario['dni']; ?></td>
                            <td> <form action="modificarPersona.php" method ="POST">
                                    <input type="hidden" value="<?php $usuario; ?>" name="personaModificada">
                                    <input type="submit" name="modificar" value="Modificar">
                                </form></td>
                            <td> <form action="../functions/eliminarPersona.php" method ="POST">
                                    <input type="hidden" value="<?php echo $usuario['dni']?>" name="dniPersona" >
                                    <input type="submit" name="eliminar" value="Eliminar">
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
