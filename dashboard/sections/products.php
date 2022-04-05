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
        $pId =(isset($_POST['product_Id']))?$_POST['product_Id']:"";
        $pName =(isset($_POST['product_Name']))?$_POST['product_Name']:"";
        $pBrand =(isset($_POST['product_Brand']))?$_POST['product_Brand']:"";
        $pDetails =(isset($_POST['product_Detail']))?$_POST['product_Detail']:"";
        $pPrice =(isset($_POST['product_Price']))?$_POST['product_Price']:"";
        $pImg =(isset($_FILES['product_Img']['name']))?$_FILES['product_Img']['name']:"";
        $action =(isset($_POST['action']))?$_POST['action']:"";

    include("../config/db.php");

        switch($action){
            case "Add":
                $senteciaSQL = $conexion->prepare("INSERT INTO productos (Name, Brand, Detail, Price, Img) VALUES (:Name, :Brand, :Detail, :Price, :Img);");
                $senteciaSQL->bindParam(':Name',$pName);
                $senteciaSQL->bindParam(':Brand',$pBrand);
                $senteciaSQL->bindParam(':Detail',$pDetails);
                $senteciaSQL->bindParam(':Price',$pPrice);

                $Date = new DateTime();
                $fileName=($pImg!="")?$Date->getTimestamp()."_".$_FILES["product_Img"]["name"]:"img.jpg";

                $tmpImg=$_FILES["product_Img"]["tmp_name"];

                if($tmpImg!=""){
                    move_uploaded_file($tmpImg,"../../img/products/".$fileName);
                }

                $senteciaSQL->bindParam(':Img',$fileName);
                $senteciaSQL->execute();

                header("location:products.php");
                break;
            case "Modify":
                $senteciaSQL=$conexion->prepare("UPDATE productos SET Name=:Name, Brand=:Brand, Detail=:Detail, Price=:Price WHERE Id = :Id");
                $senteciaSQL->bindParam(':Name',$pName);
                $senteciaSQL->bindParam(':Brand',$pBrand);
                $senteciaSQL->bindParam(':Detail',$pDetails);
                $senteciaSQL->bindParam(':Price',$pPrice);
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();

                if($pImg!=""){

                    $Date = new DateTime();
                    $fileName=($pImg!="")?$Date->getTimestamp()."_".$_FILES["product_Img"]["name"]:"img.jpg";
                    $tmpImg=$_FILES["product_Img"]["tmp_name"];

                    move_uploaded_file($tmpImg,"../../img/products/".$fileName);

                    $senteciaSQL=$conexion->prepare("SELECT Img FROM productos WHERE Id = :Id");
                    $senteciaSQL->bindParam(':Id',$pId);
                    $senteciaSQL->execute();
                    $Producto=$senteciaSQL->fetch(PDO::FETCH_LAZY);

                    if(isset($Producto["Img"]) && ($Producto["Img"]!="img.jpg")  ){
                        if(file_exists("../../img/products/".$Producto["Img"])){
                            unlink("../../img/products/".$Producto["Img"]);
                        }
                    }

                    $senteciaSQL=$conexion->prepare("UPDATE productos SET Img=:Img WHERE Id = :Id");
                    $senteciaSQL->bindParam(':Img',$fileName);
                    $senteciaSQL->bindParam(':Id',$pId);
                    $senteciaSQL->execute();
                }
                header("location:products.php");
                break;
            case "Cancel":
                header("location:products.php");
                break;
            case "Seleccionar":
                $senteciaSQL=$conexion->prepare("SELECT * FROM productos WHERE Id = :Id");
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();
                $Producto=$senteciaSQL->fetch(PDO::FETCH_LAZY);

                $pName=$Producto['Name'];
                $pBrand=$Producto['Brand'];
                $pDetails=$Producto['Detail'];
                $pPrice=$Producto['Price'];
                $pImg=$Producto['Img'];
                break;
            case "Borrar":

                $senteciaSQL=$conexion->prepare("SELECT Img FROM productos WHERE Id = :Id");
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();
                $Producto=$senteciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($Producto["Img"]) && ($Producto["Img"]!="img.jpg")  ){
                    if(file_exists("../../img/products/".$Producto["Img"])){
                        unlink("../../img/products/".$Producto["Img"]);
                    }
                }
                $senteciaSQL=$conexion->prepare("DELETE FROM productos WHERE Id = :Id");
                $senteciaSQL->bindParam(':Id',$pId);
                $senteciaSQL->execute();

                header("location:products.php");
                break;
        }

        $senteciaSQL=$conexion->prepare("SELECT * from productos");
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
                <li><a href="<?php echo $url;?>/dashboard/sections/close.php">Cerrar</a></li>
                <li><a href="<?php echo $url;?>">Ver sitio web</a></li>
            </ul>
        </nav>
    </header>
    <section class="info">
        <div class="first">
            <h2>Datos de productos</h2>
            <form method="post" enctype="multipart/form-data">
                <div>
                    <label for="ID">ID:</label>
                    <input type="text" required readonly value="<?php echo $pId;?>" name="product_Id" id="product_Id" placeholder = "ID">
                </div>
                <div>
                    <label for="product_Name">Name:</label>
                    <input type="text" required value="<?php echo $pName;?>" name = "product_Name" id="product_Name" placeholder = "Enter the product name">
                </div>
                <div>
                    <label for="product_Brand">Brand:</label>
                    <input type="text" required value="<?php echo $pBrand;?>" name = "product_Brand" id="product_Brand" placeholder = "Enter the product Brand">
                </div>
                <div>
                    <label for="product_Detail">Detail:</label>
                    <input type="text" required value="<?php echo $pDetails;?>" name = "product_Detail" id="product_Detail" placeholder = "Enter the product Details">
                </div>
                <div>
                    <label for="product_Price">Price:</label>
                    <input type="text" required value="<?php echo $pPrice;?>" name = "product_Price" id="product_Price" placeholder = "Enter the product Price">
                </div>
                <div>
                    <label for="product_Img">Image:</label>
                    <!-- <?php echo $pImg;?> -->
                    <?php
                    if($pImg!=""){ ?>
                        <img src="../../img/products/<?php echo $pImg;?>" width="70">
                    <?php } ?>

                    <input type="file" name="product_Img" id="product_Img" placeholder = "Enter the product picture">
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
                        <th>Brand</th>
                        <th>detail</th>
                        <th>price</th>
                        <th>Imagen</th>
                        <th>Acctions</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach($listaProductos as $productos) { ?>
                    <tr>
                        <td><?php echo $productos['Id'];  ?></td>
                        <td><?php echo $productos['Name'];  ?></td>
                        <td><?php echo $productos['Brand'];  ?></td>
                        <td><?php echo $productos['Detail'];  ?></td>
                        <td><?php echo $productos['Price'];  ?></td>
                        <td>
                            
                            <img src="../../img/products/<?php echo $productos['Img'];?>" width="50" >

                        </td>
                        <td><form method="post">
                            <input type="hidden" name="product_Id" id="product_Id" value=" <?php echo $productos['Id'];?>">
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