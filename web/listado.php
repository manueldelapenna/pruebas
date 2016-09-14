<?php
require("../scripts/acceso.php");
tieneAcceso('personas_listar');

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
            <?php if (in_array($_SESSION['usuario'], ['administrador'])) { ?>
                <a href="formAgregarPersona.php" class="btn btn-info">Agregar Persona</a>
            <?php } ?>
            <?php if (in_array($_SESSION['usuario'], ['administrador', 'user'])) { ?>
                <a href="mayor.php" class="btn btn-info">Mayor Edad</a>
                <a href="menor.php" class="btn btn-info">Menor Edad</a>
            <?php } ?>
            <br>
            <br/>


            <input type="text" placeholder="Buscar" id="busqueda" onkeyup="filterPerson()" name="busqueda"><br/><br/>


            <br/><br/>
            <label>Items Pagina</label>    
            <select id="cantItems">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
            <input type="hidden" value="id" id="ordenActual">
            <input type="hidden" value="ASC" id="direccionActual">
            <table class="table">
                <thead class="head-table">
                    <tr>
                        <th><a name="id"><span class="glyphicon glyphicon-circle-arrow-up"></span>ID</a></th>
                        <th><a name="nombre"><span></span>Nombre</a></th>
                        <th><a name="apellido"><span></span>Apellido</a></th>
                        <th><a name="edad"><span></span>Edad</a></th>
                        <th><a name="fecha_nacimiento"><span></span>Año Nacimiento</a></th>
                        <th><a name="dni"><span></span>Dni</a></th>
                        <th>Acciones</th>
                    </tr>
                </thead>    
                <tbody class="body-table"> 

                </tbody>
            </table>
        </div>

        <div>
            <input type="hidden" value="1" id="paginaActual">
            <ul class="pagination">

            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
          $(document).ready(function(){
              filterPerson();
          });  
            var paginaActual = 1;
            
            $('#cantItems').change(function () {
                filterPerson();

            });
        </script>

    </body>
</html>
