<?php include('template/header.php');  ?>
<?php
include("dashboard/config/db.php");

$senteciaSQL=$conexion->prepare("SELECT * from productos where Brand='Kyosho'");
$senteciaSQL->execute();
$listaProductos=$senteciaSQL->fetchAll(PDO::FETCH_ASSOC);

$total_Productos = $conexion->query("SELECT * from productos where Brand='Kyosho'")->rowCount();//  para ver el total de productos
?>

    <main>
        <section class = "sidebar">
            <div class= "aside">
                <ul>
                    <h2>Categories</h2>
                    <li><a href="index.php">Productos </a></li>
                    <li><a href="Traxxas.php">Traxxas </a></li>
                    <li><a href="Tamiya.php">Tamiya</a></li>
                    <li><a href="Kyosho.php">Kyosho</a></li>
                    <li><a href="Bateries.php">Bateries</a></li>
                </ul>
                <span></span>
            </div>
        </section>
        <section class="content">
            <h2><?=$total_Productos?> Kyosho</h2>
            <?PHP foreach($listaProductos as $productos) { ?>
                <div class="product_box">
                    <?php if($productos['Img']!=""){ ?>
                        <img src="img/products/<?php echo $productos['Img'];?>">
                    <?php } ?>
                    <h3><?php echo $productos['Brand'],' ', $productos['Name']; ?></h3>
                    <p class="product_price">Price: <?php echo $productos['Price']; ?></p>
                    <a href="details.php?id=<?=$productos['Id']?>" class="detail" >detalles</a>
                    <form method='post' action=''>
                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($productos['Id'],COD,KEY);?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['Name'],COD,KEY);?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $productos['Price'];?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
                        <button type='submit' name="Accion" value="Agregar" class='add_to_card'>Añadir al carrito</button>
                    </form>
                </div>
            <?php } ?>
        </section>
    </main>

<?php include('template/footer.php');  ?>