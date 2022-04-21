<?php
session_start();

if(isset($_POST['Accion'])){
    switch($_POST['Accion']){
        case'Agregar':
            $ID = (isset($_POST['Id']));
            $NOMBRE = (isset($_POST['Name']));
            $PRECIO = (isset($_POST['Price']));
            $CANTIDAD = (isset($_POST['cantidad']));
        break;
    }
}

if(!isset($_SESSION['CARRITO'])){
    $producto=array(
    'ID'=>$ID,
    'NOMBRE'=>$NOMBRE,
    'CANTIDAD'=>$CANTIDAD,
    'PRECIO'=>$PRECIO
    );
    $_SESSION['CARRITO'][0]=$producto;
}else{
    $NumeroProductos=count($_SESSION['CARRITO']);
    $producto=array(
        'ID'=>$ID,
        'NOMBRE'=>$NOMBRE,
        'CANTIDAD'=>$CANTIDAD,
        'PRECIO'=>$PRECIO
        );
        $_SESSION['CARRITO'][$NumeroProductos]=$producto;
}
?>