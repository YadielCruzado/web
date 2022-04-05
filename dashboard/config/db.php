<?php

$host="localhost";
$bd="carritos";
$user="root";
$password="";
try{
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$user,$password);
    // if($conexion){echo "conectado ...  a sistema";}
} catch(exception $ex){
    echo $ex -> getMessage();
}
?>