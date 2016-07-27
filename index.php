<?php

require("funciones.php");
$personas = cargarDatos();
foreach($personas as $aux){
	echo "nombre: " .$aux['nombre'];
	echo " apellido: " .$aux['apellido'];
	echo " edad: " .$aux['edad'];
	echo "<br>";
}

?>

