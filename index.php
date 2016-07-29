<?php



require("funciones.php");
$personas = cargarDatos();
foreach($personas as $aux){
  
	echo "nombre: " .$aux['nombre']."<br/>";
	echo " apellido: " .$aux['apellido']."<br/>";
	echo " edad: " .$aux['edad']."<br/>";
         echo "Año de nacimiento".AñoDeNacimiento($aux['edad'])."<br>";
        echo "--------------------------------";
        
	echo "<br>";
        
}



