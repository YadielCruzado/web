<?php include('template/header.php');  ?>

<?php
include("dashboard/config/db.php");

$senteciaSQL=$conexion->prepare("SELECT * from productos");
$senteciaSQL->execute();
$listaProductos=$senteciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

    <main>
        <section class = "sidebar">
            <div class= "aside">
                <ul>
                    <h2>Categories</h2>
                    <li><a href="">Best sellers</a></li>
                    <li><a href="">Traxxas </a></li>
                    <li><a href="">Tamiya</a></li>
                    <li><a href="">Kyosho </a></li>
                    <li><a href="">Bateries</a></li>
                </ul>
                <span></span>
            </div>
            <div class="bestSellers">
                <h2>Best sellers</h2>
                <section>
                    <img src="img/01.jpg" alt="01">
                    <a href="pDetail.php">Subaru WRX STI</a>
                    <p>$114.99</p>
                </section>
                <section>
                    <img src="img/01.jpg" alt="01">
                    <a href="pDetail.php">Subaru WRX STI</a>
                    <p>$114.99</p>
                </section>
                <section>
                    <img src="img/01.jpg" alt="01">
                    <a href="pDetail.php">Subaru WRX STI</a>
                    <p>$114.99</p>
                </section>
            </div>
        </section>
        <section class="content">
            <h2>products</h2>
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
        </section>
    </main>

<?php include('template/footer.php');  ?>
