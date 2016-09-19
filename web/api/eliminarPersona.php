<?php


require(dirname(__FILE__).'/../../functions/funciones.php');

try{
    if(!isset($_POST['id'])){
        throw new Exception("No hay id definido");
    }
$id = $_POST['id'];
$pdo = conectar();
$statement = $pdo->prepare("DELETE FROM personas where id= :id");
$statement->bindParam(':id',$id, PDO::PARAM_INT);
$statement->execute();
$result = ['code'=>200, 'message'=>"Se borro la persona"];    
}catch(Exception $e){
$result = ['code'=>500, 'message'=>"Hubo un error al borrar la persona: ". $e->getMessage()];    
}

header('Content-Type: application/json'); 
echo json_encode($result);