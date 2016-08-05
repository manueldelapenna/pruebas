<?php

include '../config/database.php';

function listarPersonas() {
    
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT * FROM personas");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function MayorDeEdad($arreglo) {

    $mayor = [];
    $mayor['edad'] = -1;
    for ($i = 0; $i < count($arreglo); $i++) {
        if ($mayor['edad'] < $arreglo[$i]['edad']) {
            $mayor = $arreglo[$i];
        }
    }

    return $mayor;
}

function MenorDeEdad($arreglo) {
    $menor = [];
    $menor['edad'] = 100;
    for ($i = 0; $i < count($arreglo); $i++) {
        if ($menor['edad'] > $arreglo[$i]['edad']) {
            $menor = $arreglo[$i];
        }
    }

    return $menor;
}

function Promedio() {
    $contador = count($personas);
    $sumador = 0;
    for ($i = 0; $i = $contador; $i++) {

        $sumador = $sumador + $personas[$i][edad];
    }
    $promedio = $sumador / $contador;
    return $promedio;
}

function AñoDeNacimiento($edad) {

    $nacimiento = date("Y") - $edad;


    return $nacimiento;
}

function agregarUsuarios($dni,$nombre,$apellido,$edad) {
   $pdo = conectar();
  
    $statement = $pdo->prepare("INSERT INTO usuarios(dni,nombre,apellido,edad) VALUE (:dni,:nombre, :apellido, :edad)");
    $statement->bindParam(':dni',$dni);
    $statement->bindParam(':nombre',$nombre);
    $statement->bindParam(':apellido',$apellido);
    $statement->bindParam(':edad',$edad);
    $statement->execute();
    
}

function obtenerUsuarios() {
   $pdo = conectar();
  
    $statement = $pdo->prepare("SELECT * FROM usuarios");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function verificarUsuario($usuario, $contrasena) {

    foreach (obtenerUsuarios() as $u) {

        if ($u['username'] == $usuario && $u['password'] == $contrasena) {
            return TRUE;
        }
    }

    return FALSE;
}

?>