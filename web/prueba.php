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
			
			$(".pagination").on("click", "a", function () {
				$("#paginaActual").val($(this).text());
				filterPerson();
			});
			
			$(".head-table").on("click", "a", function () {
				//var iconoDireccion = $("#iconoDireccion").val();

				//cambio de direccion
				if ($("#direccionActual").val() === "ASC") {
					$("#direccionActual").val("DESC");
					$(this + ' span').removeClass('glyphicon glyphicon-circle-arrow-up');
					$(this + '[name= ' + $(this).attr('name') + '] span').addClass('glyphicon glyphicon-circle-arrow-down');
				} else {
					$("#direccionActual").val("ASC");
					$(this + ' span').removeClass('glyphicon glyphicon-circle-arrow-down');
					$(this + '[name= ' + $(this).attr('name') + '] span').addClass('glyphicon glyphicon-circle-arrow-up');
				}

				// $(".table").find("span").remove();
				//$(this).append("span").addClass(iconoDireccion);

				//cambio el orden
				$("#ordenActual").val($(this).attr('name'));
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