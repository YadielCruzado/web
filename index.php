<?php include('template/header.php');  ?>
<?php

$senteciaSQL=$conexion->prepare("SELECT * from productos where cantidad > 0");
$senteciaSQL->execute();
$listaProductos=$senteciaSQL->fetchAll(PDO::FETCH_ASSOC);

$SQL=$conexion->prepare("SELECT * from categorias");
$SQL->execute();
$categorias=$SQL->fetchAll(PDO::FETCH_ASSOC);

// $total_Productos = $conexion->query("SELECT * from productos where cantidad > 0")->rowCount();//  para ver el total de productos
?>

    <main>
        <section class = "sidebar">
            <div class= "aside">
                <ul>
                    <h2>categorias</h2>
                    <li><a href="index.php">Todos los productos</a></li>
                    <?PHP foreach($categorias as $categoria) { ?>
                        <li><a href="categorias.php?id=<?=$categoria['Id']?>"><?php echo $categoria['Nombre'],'  (', $categoria['Producto'],')' ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </section>
        <section class="content">
            <h2><?=$total_Productos?> Productos</h2>
            <?PHP foreach($listaProductos as $productos) { ?>
                <div class="product_box">
                    <?php if($productos['Img']!=""){ ?>
                        <img src="img/products/<?php echo $productos['Img'];?>">
                    <?php } ?>
                    <h3><?php echo $productos['Marca'],' ', $productos['Nombre']; ?></h3>
                    <p class="product_price">Price: $<?php echo $productos['Precio']; ?></p>
                    <a href="details.php?id=<?=$productos['Id']?>" class="detail" >Detalles</a>
                    <form method='post' action=''>
                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($productos['Id'],COD,KEY);?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['Nombre'],COD,KEY);?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $productos['Precio'];?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
                        <button type='submit' name="Accion" value="Agregar" class='add_to_card'>Añadir al carrito</button>
                    </form>
                </div>
            <?php } ?>
        </section>
    </main>

<?php include('template/footer.php');  ?>
