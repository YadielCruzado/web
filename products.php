<?php include('template/header.php');  ?>
<?php
include("dashboard/config/db.php");

$senteciaSQL=$conexion->prepare("SELECT * from productos");
$senteciaSQL->execute();
$listaProductos=$senteciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

    <?PHP foreach($listaProductos as $productos) { ?>
        <div class="product_box">
            <?php if($productos['Img']!=""){ ?>
                <img src="img/products/<?php echo $productos['Img'];?>">
            <?php } ?>
            <h3><?php echo $productos['Name']; ?></h3>
            <p class="product_price">Price: <?php echo $productos['Price']; ?></p>
            <a href="shoppingcart.html" class="add_to_card">Add to Cart</a>
            <a href="productdetail.html" class="detail">Detail</a>
        </div>
    <?php } ?>


<?php include('template/footer.php');  ?>