<?php
require("funciones.php");
$personas = cargarDatos();

$mayor = MayorDeEdad($personas);

echo $mayor['nombre']." ".$mayor['apellido']." tiene ".$mayor['edad']. "años y es la persona mas grande del array";

