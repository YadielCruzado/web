<?php include('template/header.php');  ?>
<?php
include("dashboard/config/db.php");

$senteciaSQL=$conexion->prepare("SELECT * from productos where Brand='Tamiya'");
$senteciaSQL->execute();
$listaProductos=$senteciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

    <main>
        <section class = "sidebar">
            <div class= "aside">
                <ul>
                    <h2>Categories</h2>
                    <li><a href="Traxxas.php">Traxxas </a></li>
                    <li><a href="Tamiya.php">Tamiya</a></li>
                    <li><a href="Kyosho.php">Kyosho</a></li>
                    <li><a href="Bateries.php">Bateries</a></li>
                </ul>
                <span></span>
            </div>
        </section>
        <section class="content">
            <h2>products</h2>
            <?PHP foreach($listaProductos as $productos) { ?>
                <div class="product_box">
                    <?php if($productos['Img']!=""){ ?>
                        <img src="img/products/<?php echo $productos['Img'];?>">
                    <?php } ?>
                    <h3><?php echo $productos['Brand'],' ', $productos['Name']; ?></h3>
                    <p class="product_price">Price: <?php echo $productos['Price']; ?></p>
                    <a href="shoppingcart.html" class="add_to_card">Add to Cart</a>
                    <a href="productdetail.html" class="detail">Detail</a>
                </div>
            <?php } ?>
        </section>
    </main>

<?php include('template/footer.php');  ?>