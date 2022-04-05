<?php
session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }else{
        if($_SESSION['user']=="ok"){
            $userName=$_SESSION["userName"];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/web"?>
    <header class="header">
        <h1>Dashboard</h1>
        <nav>
            <ul>
                <li><a href="">Administrador</a></li>
                <li><a href="<?php echo $url;?>/dashboard/inicio.php">Inicio</a></li>
                <li><a href="<?php echo $url;?>/dashboard/sections/products.php">Productos</a></li>
                <li><a href="<?php echo $url;?>/dashboard/sections/close.php">Cerrar</a></li>
                <li><a href="<?php echo $url;?>">Ver sitio web</a></li>
            </ul>
        </nav>
    </header>
    
    