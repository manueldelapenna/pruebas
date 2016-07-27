<?php

$personas = [];
$persona = [];

$persona["nombre"] = "Manuel";
$persona["apellido"] = "Dela";
$persona["edad"] = 30;

$personas[] = $persona;

$persona["nombre"] = "Tomas";
$persona["apellido"] = "Echague";
$persona["edad"] = 21;

$personas[] = $persona;

$persona["nombre"] = "Juan";
$persona["apellido"] = "Perez";
$persona["edad"] = 40;

$personas[] = $persona;

$persona["nombre"] = "Jose";
$persona["apellido"] = "Sanchez";
$persona["edad"] = 60;

$personas[] = $persona;

$persona["nombre"] = "Pepe";
$persona["apellido"] = "Lopez";
$persona["edad"] = 75;

$personas[] = $persona;

$persona["nombre"] = "Jorge";
$persona["apellido"] = "Rodriguez";
$persona["edad"] = 18;

$personas[] = $persona;

$persona["nombre"] = "Sebastian";
$persona["apellido"] = "Veron";
$persona["edad"] = 40;

$personas[] = $persona;

$persona["nombre"] = "Carlos";
$persona["apellido"] = "Tevez";
$persona["edad"] = 32;

$personas[] = $persona;

$persona["nombre"] = "Oscar";
$persona["apellido"] = "Cordoba";
$persona["edad"] = 42;

$personas[] = $persona;

$persona["nombre"] = "Roman";
$persona["apellido"] = "Riquelme";
$persona["edad"] = 37;

$personas[] = $persona;

$persona["nombre"] = "Martin";
$persona["apellido"] = "Palermo";
$persona["edad"] = 39;

$personas[] = $persona;

$persona["nombre"] = "Emanuel";
$persona["apellido"] = "Ginobili";
$persona["edad"] = 40;

$personas[] = $persona;

$persona["nombre"] = "Luis";
$persona["apellido"] = "Scola";
$persona["edad"] = 37;

$personas[] = $persona;

$persona["nombre"] = "Hernan";
$persona["apellido"] = "Diaz";
$persona["edad"] = 23;

$personas[] = $persona;

foreach($personas as $aux){
	echo "nombre: " .$aux['nombre'];
	echo " apellido: " .$aux['apellido'];
	echo " edad: " .$aux['edad'];
	echo "<br>";
}

