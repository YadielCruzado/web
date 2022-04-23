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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/web"?>
    <?php
        $pId =(isset($_POST['Categori_Id']))?$_POST['Categori_Id']:"";
        $pName =(isset($_POST['Categori_Name']))?$_POST['Categori_Name']:""; 
        $pProduct =(isset($_POST['categori_Product']))?$_POST['categori_Product']:"";
        $action =(isset($_POST['action']))?$_POST['action']:"";

    include("../config/db.php");

        switch($action){
            case "Add":
                $senteciaSQL = $conexion->prepare("INSERT INTO categorias (Nombre, Producto) VALUES (:Name, :Product);");
                $senteciaSQL->bindParam(':Name',$pName);
                $senteciaSQL->bindParam(':Product',$pProduct);
                $senteciaSQL->execute();
                header("location:categorias.php");
                break;
            case "Modify":
                $senteciaSQL=$conexion->prepare("UPDATE categorias SET Nombre=:Name, Producto=:Producto WHERE Id = :Id");
                $senteciaSQL->bindParam(':Name',$pName);
                $senteciaSQL->bindParam(':Producto',$pProduct);
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();
                header("location:categorias.php");
                break;
            case "Cancel":
                header("location:categorias.php");
                break;
            case "Seleccionar":
                $senteciaSQL=$conexion->prepare("SELECT * FROM categorias WHERE Id = :Id");
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();
                $Producto=$senteciaSQL->fetch(PDO::FETCH_LAZY);

                $pName=$Producto['Nombre'];
                $pProduct=$Producto['Producto'];
                break;
            case "Borrar":
                echo "hola";
                $senteciaSQL=$conexion->prepare("DELETE FROM categorias WHERE Id=:Id");
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();
                header("location:categorias.php");
                break;
        }

        $senteciaSQL=$conexion->prepare("SELECT * from categorias");
        $senteciaSQL->execute();
        $listaProductos=$senteciaSQL->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <header class="header">
        <h1>Dashboard</h1>
        <nav>
            <ul>
                <li><a href="">Administrador</a></li>
                <li><a href="<?php echo $url;?>/dashboard/inicio.php">Inicio</a></li>
                <li><a href="<?php echo $url;?>/dashboard/sections/products.php">Productos</a></li>
                <li><a href="<?php echo $url;?>/dashboard/sections/categorias.php">Categorias</a></li>
                <li><a href="<?php echo $url;?>/dashboard/sections/close.php">Cerrar</a></li>
                <li><a href="<?php echo $url;?>">Ver sitio web</a></li>
            </ul>
        </nav>
    </header>
    <section class="info">
        <div class="first">
            <h2>Anadir productos</h2>
            <form method="post" enctype="multipart/form-data">
                <div>
                    <label for="Categori_Id">ID:</label>
                    <input type="text" required readonly value="<?php echo $pId;?>" name="Categori_Id" id="product_Id" placeholder = "ID">
                </div>
                <div>
                    <label for="Categori_Name">Name:</label>
                    <input type="text" required value="<?php echo $pName;?>" name = "Categori_Name" id="Categori_Name" placeholder = "Enter the product name">
                </div>
                <div>
                    <label for="categori_Product">Brand:</label>
                    <input type="text" required value="<?php echo $pProduct;?>" name = "categori_Product" id="categori_Product" placeholder = "Entre el tipo de product">
                </div>
                <button type="submit" name="action" <?php echo($action=="Seleccionar")?"disabled":""; ?> value="Add" >Add</button>
                <button type="submit" name="action" <?php echo($action!="Seleccionar")?"disabled":""; ?> value="Modify" >Modify</button>
                <button type="submit" name="action" <?php echo($action!="Seleccionar")?"disabled":""; ?> value="Cancel" >Cancel</button>
            </form>
        </div>
        <div class="second">
            <h2>Datos de productos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Producto</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach($listaProductos as $productos) { ?>
                    <tr>
                        <td><?php echo $productos['Id'];  ?></td>
                        <td><?php echo $productos['Nombre'];  ?></td>
                        <td><?php echo $productos['Producto'];  ?></td>
                        <td><form method="post">
                            <input type="hidden" name="Categori_Id" id="Categori_Id" value=" <?php echo $productos['Id'];?>">
                            <input type="submit" name="action" value="Seleccionar">
                            <input type="submit" name="action" value="Borrar">
                        </form></td>
                    </tr><?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>