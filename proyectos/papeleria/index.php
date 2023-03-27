<?php session_start(); include "SRC/header.php"; require "SRC/conex.php";?>
    <section class="contenedor contenedor-tienda">
    <div class="contenedor contenedor-msj">
    <?php if(isset($_SESSION['msj'][1])){ ?>
            <p class="<?=$_SESSION['msj'][0]?>"><?=$_SESSION['msj'][1]?></p>
    <?php
            unset($_SESSION['msj']);
        }
    ?>
    </div>
        <?php
        try{
            $sql = "SELECT producto_id, producto_nombre, producto_precio, producto_stock, producto_img, ruta FROM productos";
            $resultado = $link->query($sql);
            if(! isset($resultado)){
                throw new Exception("Error al conectarse con la base de datos.");
            }
            $i=1;
            while($fila=$resultado->fetch_array()) {
        ?>
        <div class="tarjeta_producto">
            <h1 class="tarjeta_producto-titulo"><?=$fila['producto_nombre']?></h1>
            <div class="tarjeta_producto-img">
                <a href="productos/<?=$fila['ruta']?>.html" class="tarjeta_producto-img-a">
                    <img src="img/<?=$fila['producto_img']?>" alt="<?=$fila['producto_nombre']?>" title="<?=$fila['producto_nombre']?>">
                </a>
            </div>
            <p class="tarjeta_producto-precio">$<?=$fila['producto_precio']?></p>
            <form action="carrito.php" method="post">
                <input type="hidden" name="id" value="<?=$fila['producto_id']?>">
                <input type="hidden" name="img" value="img/<?=$fila['producto_img']?>">
                <input type="hidden" name="titulo" value="<?=$fila['producto_nombre']?>">
                <input type="hidden" name="precio" value="<?=$fila['producto_precio']?>">
                <input type="hidden" name="stock" value="<?=$fila['producto_stock']?>">
                <input type="submit" name="enviado" class="tarjeta_producto-btn" value="Agregar al carrito">
            </form>
            </div>
        <?php 
        $i++; }
        } catch(Exception $e){
            $_SESSION['msj'][0] = "msj-error";
            $_SESSION['msj'][1] = $e->getMessage();
        }
        ?>
        </section>
<?php include "SRC/footer.php"; ?>
