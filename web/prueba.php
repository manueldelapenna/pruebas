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
        <script src="../web/js/personas.js" type="text/javascript"></script>
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

		<div id="content"></div>


<?php
$path = $rootpath . '/pruebas/_partials/footer.php';
include_once($path);
?>
<script>
    
function listar() {

    $.ajax({
        url: "listado1.php",
        type: 'GET',
        data: {
            
        },
        success: function (data) {

            $("#content").html(data);
			filterPerson();
			$('#cantItems').change(function () {
				filterPerson();

			});

        }
	});
};


$(document).ready(function () {
    listar();
	
	
});

</script>
</body>
</html>

<?php
?>