<?php

require(dirname(__FILE__).'/../../functions/funciones.php');

try{
$id = $_POST['id'];
$salt = generateSalt();
$password = encryptPassword($salt,$_POST['password']);
$confirmPassword = encryptPassword($salt, $_POST['confirmPassword']);


if(encryptPassword($salt, $password) != $confirmPassword){
    throw new Exception("Las contraseñas no son iguales.");
}

$pdo = conectar();
$statement = $pdo->prepare("UPDATE usuarios
                            SET password = :password
                            WHERE id = :id" );
$statement->bindParam(':password', $password);
$statement->bindParam(':id', $idUser);
$statement->execute();

$result = ['code'=>200, 'message'=>"La constraseña ha sido modificada correctamente."];

}catch(Exception $e){
    
    $result = ['error'=> 500, 'message'=> "No se ha podido modificar la constraseña. " . $e->getMessage()];
}


header('Content-Type: application/json');
echo json_encode($result);