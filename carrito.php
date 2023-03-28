<?php 
session_start();
unset($producto);
if(isset($_POST['enviado'])){
    // Funcion general para agregar al carrito
    if(isset($_POST['img']) && isset($_POST['titulo']) && isset($_POST['precio']) && isset($_POST['id'])){
        $carritoStock = $_POST['stock'];
        if($carritoStock<1){
            $_SESSION['msj'][0] = 'msj msj-error';
            $_SESSION['msj'][1] = 'No hay stock disponible del producto.';
            header("Location: index.php");
            exit;
        }
        $carritoId = $_POST['id'];
        $carritoImg = $_POST['img'];
        $carritoTitulo = $_POST['titulo'];
        $carritoPrecio = $_POST['precio'];
        if(isset($_SESSION['carrito'])){
            $x = -1;
            foreach($_SESSION['carrito'] as $i => $producto){
                // Encontrando el ID del producto que se quiere agregar
                if($carritoId == $producto['id']){
                    $x = $i;
                }
            }
            // Comprobando que sí está en el carrito
            if($x != -1){
                if($_SESSION['carrito'][$x]['cantidad']<$_SESSION['carrito'][$x]['stock']){
                    // Si la cantidad de producto a comprar es menor (una diferencia mínima de 1)
                    // Agrega cantidad porque como mínimo puede agregar uno más
                    $_SESSION['carrito'][$x]['cantidad']++;
                }else {
                    // SI la cantidad de producto comprado es igual al del stock retorna error
                    $_SESSION['msj'][0] = 'msj msj-error';
                    $_SESSION['msj'][1] = 'No hay stock disponible del producto.';
                    header("Location: index.php");
                    exit;
                }
            }else {
                // Si no está lo establece como nuevo producto
                $n = count($_SESSION['carrito']);
                $carritoCantidad = 1;
                $_SESSION['carrito'][$n]['id'] = $carritoId;
                $_SESSION['carrito'][$n]['titulo'] = $carritoTitulo;
                $_SESSION['carrito'][$n]['stock'] = $carritoStock;
                $_SESSION['carrito'][$n]['precio'] = $carritoPrecio;
                $_SESSION['carrito'][$n]['cantidad'] = $carritoCantidad;
                $_SESSION['carrito'][$n]['img'] = $carritoImg;
            }
            $_SESSION['msj'][0] = 'msj msj-sucess';
            $_SESSION['msj'][1] = 'Agregado correctamente.';
            header("Location: index.php");
            exit;
        }else{
            // Si no hay repetidos
            $carritoCantidad = 1;
            $_SESSION['carrito'][0]['id'] = $carritoId;
            $_SESSION['carrito'][0]['titulo'] = $carritoTitulo;
            $_SESSION['carrito'][0]['stock'] = $carritoStock;
            $_SESSION['carrito'][0]['precio'] = $carritoPrecio;
            $_SESSION['carrito'][0]['cantidad'] = $carritoCantidad;
            $_SESSION['carrito'][0]['img'] = $carritoImg;
            $_SESSION['msj'][0] = 'msj msj-sucess';
            $_SESSION['msj'][1] = 'Agregado correctamente.';
            header("Location: index.php");
            exit;
        }
    }else{
        // MENSAJE DE ERROR
        $_SESSION['msj'][0] = 'msj msj-error';
        $_SESSION['msj'][1] = 'Hubo un error al añadir.';
        header("Location: index.php");
        exit;
    }
}
// ---------------------------------------------
// - MODIFICAR CANTIDAD DE PRODUCTO DE CARRITO -
// ---------------------------------------------
if(isset($_POST['id-reducir'])){
    // Reducir en uno la cantidad comprada (-1)
    $carritoId = $_POST['id-reducir'];
    foreach($_SESSION['carrito'] as $i => $producto){
        if($carritoId == $producto['id']){
            $_SESSION['carrito'][$i]['cantidad']--;
            if($_SESSION['carrito'][$i]['cantidad']<1){
                $_SESSION['carrito'][$i]['cantidad']++;
            }
        }
    }
    $_SESSION['msj'][0] = 'msj msj-sucess';
    $_SESSION['msj'][1] = 'Reducido con &eacute;xito.';
    header("Location: carrito.php");
    exit;
    // 
    // 
}else if(isset($_POST['id-aumentar'])) {
    // Aumentar en uno la cantidad comprada (+1)
    $carritoId = $_POST['id-aumentar'];
    foreach($_SESSION['carrito'] as $i => $producto){
        // Encontrando producto a aumentar
        if($carritoId == $producto['id']){
            // Comprobando stock
            if($_SESSION['carrito'][$i]['cantidad']<$_SESSION['carrito'][$i]['stock']){
                $_SESSION['carrito'][$i]['cantidad']++;
            }else {
                $_SESSION['msj'][0] = 'msj msj-error';
                $_SESSION['msj'][1] = 'No hay m&aacute;s stock disponible del producto.';
                header("Location: carrito.php");
                exit;
            }
        }
    }
    $_SESSION['msj'][0] = 'msj msj-sucess';
    $_SESSION['msj'][1] = 'Aumentado con &eacute;xito.';
    header("Location: carrito.php");
    exit;
    // 
    // 
}else if(isset($_POST['id-eliminar'])){
    // Eliminar por completo el producto
    $carritoId = $_POST['id-eliminar'];
    foreach($_SESSION['carrito'] as $i => $producto){
        if($carritoId == $producto['id']){
            unset($_SESSION['carrito'][$i]);
            if(count($_SESSION['carrito'])<1){
                unset($_SESSION['carrito']);
            }else{
                sort($_SESSION['carrito']);
            }
        }
    }
    $_SESSION['msj'][0] = 'msj msj-sucess';
    $_SESSION['msj'][1] = 'Eliminado con &eacute;xito.';
    header("Location: carrito.php");
    exit;
}
include "SRC/header.php";

?>
    <div class="pantalla-pago none" id="pantallaPago">
        <div class="spinner"></div>
        <p class="titulo subtitulo">Procesando pago</p>
    </div>
    <section class="contenedor contenedor-carrito">
    

    <div class="contenedor contenedor-msj">
        <?php if(isset($_SESSION['msj'][1])){ ?>
                <p class="<?=$_SESSION['msj'][0]?>"><?=$_SESSION['msj'][1]?></p>
        <?php
                unset($_SESSION['msj']);
            }
        ?>
    </div>
        <h1 class="titulo">Carrito</h1>
        <table id="tablaCarrito" class="tabla tabla-carrito">
            <thead>
                <tr class="carrito-tr carrito-th">
                    <!-- 97% -->
                    <th width="25%">Nombre</th>
                    <th width="10%">Precio</th>
                    <th width="10%">Cantidad</th>
                    <th width="25%">IMG</th>
                    <th width="15%">Total</th>
                    <th width="4%"></th>
                    <th width="4%"></th>
                    <th width="4%"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_SESSION['carrito'])){
                $totalCarrito = 0;
                foreach($_SESSION['carrito'] as $producto){
                    if(isset($producto['id'])){
            ?>
            <tr class="carrito-tr">
                <td class="carrito-td" width="25%"><?=$producto['titulo']?></td>
                <td class="carrito-td" width="10%">$<?=$producto['precio']?></td>
                <td class="carrito-td" width="10%"><?=$producto['cantidad']?></td>
                <td class="carrito-td" width="25%"><img height="100px" src="<?=$producto['img']?>" alt="<?=$producto['titulo']?>"></td>
                <td class="carrito-td" width="15%">$<?php $totalCarrito+=$producto['cantidad']*$producto['precio'];echo($producto['cantidad']*$producto['precio']);?></td>
                <!-- Añadir uno mas -->
                <td class="carrito-td" width="4%"><form action="carrito.php" method="post">
                    <input type="hidden" name="id-aumentar" value="<?=$producto['id']?>">
                    <button class="boton" type="submit"><svg width="24" height="24" style="fill: rgb(70,150,70);" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/></svg></button>
                </form></td>
                <!-- Reducir uno menos -->
                <td class="carrito-td" width="4%"><form action="carrito.php" method="post">
                    <input type="hidden" name="id-reducir" value="<?=$producto['id']?>">
                    <button class="boton" type="submit"><svg width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(0,0,0);"><path d="M5 11h14v2H5z"/></svg></button>
                </form></td>
                <!-- Eliminar por completo -->
                <td class="carrito-td" width="4%"><form action="carrito.php" method="post">
                    <input type="hidden" name="id-eliminar" value="<?=$producto['id']?>">
                    <button class="boton" type="submit"><svg width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(243, 50, 38, 1);"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"/></svg></button>
                </form></td>
            </tr>
            <?php 
                    }
                }
            } else{ ?>
            <tr style="display:flex;width:100%;">
                <td style="width:100%;padding:2% 5%;text-align:center;font-size:1.5rem;"> No hay productos en el carrito.</td>
            </tr>
        <?php } ?>
            <tr style="display:flex;width:100%;">
                <td width="25%"></td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="25%"></td>
                <td width="15%" style="padding:1% 0%;text-align:center;font-size:1.5rem;">
                <?php if(isset($totalCarrito)){ echo "Total: $".$totalCarrito; } ?>
                </td>
                <td width="12%"></td>
            </tr>
            </tbody>
        </table>
        <?php
        if(isset($totalCarrito)){ ?>
        <form class="form-boton-compra" action="compra.php" method="post">
            <input type="hidden" name="totalAbsoluto" value="<?=$totalCarrito?>">
            <input class="boton boton-compra" id="botonCompra" type="submit" name="comprar" value="Comprar ($<?=$totalCarrito?>)">
        </form>
        <?php } ?>
    </section>
    <script src="js/pantallaCompra.js"></script>
<?php include "SRC/footer.php"; ?>
