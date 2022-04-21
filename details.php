<?php include('template/header.php');  ?>
<?php

if(isset($_GET['id'])){
    $stmt=$conexion->prepare("SELECT * from productos Where id = ?");
    $stmt->execute([$_GET['id']]);

    $productos = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$productos){
        exit('producto inexistente');
    }
}else{
    exit('prouct does not exist!');
}
$conexion = NULL;
?>
<a class="back" href="index.php">Back</a>
<div class= "detalles">
        <img src="img/products/<?php echo $productos['Img'];?>">    
        <div>
            <h3><?php echo $productos['Brand'],' ', $productos['Name']; ?></h3>
            <p class="price">Price: $<?php echo $productos['Price']; ?></p>
            <form method='post' action=''>
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($productos['Id'],COD,KEY);?>">
                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['Name'],COD,KEY);?>">
                <input type="hidden" name="precio" id="precio" value="<?php echo $productos['Price'];?>">
                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
                <button type='submit' name="Accion" value="Agregar" class='add_to_card'>Añadir al carrito</button>
            </form>
            <br>
            <p><?php echo $productos['Detail']?></p>  
        </div>
        
</div>

<?php include('template/footer.php');  ?>