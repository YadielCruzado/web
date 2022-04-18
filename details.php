<?php include('template/header.php');  ?>
<?php
include("dashboard/config/db.php");

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
<a href="index.php">back</a>
<div >
        <img src="img/products/<?php echo $productos['Img'];?>">
        <h3><?php echo $productos['Brand'],' ', $productos['Name']; ?></h3>
        <p class="product_price">Price: <?php echo $productos['Price']; ?></p>
        <a href="shoppingcart.html">Add to Cart</a>
        <p><?php echo $productos['Detail']?></p>  
</div>
<?php include('template/footer.php');  ?>