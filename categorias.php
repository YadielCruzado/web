<?php include('template/header.php');  ?>
<?php

if(isset($_GET['id'])){
    $stmt=$conexion->prepare("SELECT productos.Nombre, productos.Marca, productos.Id,productos.Detalles,productos.Precio,productos.Img FROM categorias JOIN productos ON categorias.Nombre=productos.Marca WHERE categorias.id = ?");
    $stmt->execute([$_GET['id']]);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    exit('prouct does not exist!');
}
$SQL=$conexion->prepare("SELECT * from categorias");
$SQL->execute();
$categorias=$SQL->fetchAll(PDO::FETCH_ASSOC);

$total_Productos = $stmt->rowCount();
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
            <?PHP foreach($productos as $producto) { ?>
                <div class="product_box">
                    <?php if($producto['Img']!=""){ ?>
                        <img src="img/products/<?php echo $producto['Img'];?>">
                    <?php } ?>
                    <h3><?php echo $producto['Marca'],' ', $producto['Nombre']; ?></h3> 
                    <p class="product_price">Price: $<?php echo $producto['Precio']; ?></p>
                    <a href="details.php?id=<?=$producto['Id']?>" class="detail" >Detalles</a>
                </div>
            <?php } ?>
        </section>
    </main>


<?php include('template/footer.php');  ?>