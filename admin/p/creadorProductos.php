<?php
$urlCSS = '../';
if(! isset($_POST['productos'])){
    $_SESSION['msj'][0] = "msj msj-error";
    $_SESSION['msj'][1] = "No tienes acceso a esta p&aacute;gina.";
    header("Location: ../../index.php");
    exit;
}
require("../../SRC/conex.php");
$sql       = "SELECT ruta FROM productos";
$resultado = $link->query($sql);
while($fila=$resultado->fetch_array()) {
    $ruta = $fila['ruta'];
    $archivo = "../../productos/".$ruta.".html";
    if(! file_exists($archivo)){
        ob_start();
        $sql = "SELECT proveedores.empresa, producto_id, producto_nombre, producto_precio, producto_stock, producto_descripcion, producto_img FROM productos INNER JOIN proveedores ON productos.proveedor_id=proveedores.proveedor_id WHERE ruta='$ruta';";
        $resultado = $link->query($sql);
        $fila=$resultado->fetch_array();
        include("../../SRC/header.php"); ?>
        <section class="contenedor contenedor-producto">
            <h1 class="titulo"><?=$fila['producto_nombre']?></h1>
            <div class="contenedor contenedor-100">
                <div class="contenedor contenedor-50">
                    <div class="contenedor contenedor-50-img">
                        <img src="../img/<?=$fila['producto_img']?>" alt="<?=$fila['producto_nombre']?>">
                    </div>
                    <!-- Descripción del producto -->
                    <p class="text-justify"><?=$fila['producto_descripcion']?></p>
                </div>
                <div class="contenedor contenedor-50 contenedor-50-2">
                    <form action="../carrito.php" method="post">
                        <p class="texto"> <b>Stock: </b><span id="stock"><?=$fila['producto_stock']?></span></p>
                        <p class="texto"> <b>Precio:</b> $<?=$fila['producto_precio']?> </p>
                        <p class="texto"> <b>Proveedor:</b> <?=$fila['empresa']?>        </p>
                        <input type="hidden" name="id" id="id" value="<?=$fila['producto_id']?>">
                        <input type="hidden" name="img" value="img/<?=$fila['producto_img']?>">
                        <input type="hidden" name="titulo" value="<?=$fila['producto_nombre']?>">
                        <input type="hidden" name="precio" value="<?=$fila['producto_precio']?>">
                        <input type="hidden" name="stock" id="inputStock" value="<?=$fila['producto_stock']?>">
                        <input id="btnProducto" type="submit" name="enviado" class="tarjeta_producto-btn" value="Agregar al carrito">
                    </form>
                </div>
            </div>
        </section>
        <!--  -->
        <!--  -->
        <!--  -->
        <section class="contenedor contenedor-producto">
            <h1 class="subtitulo">Comentarios del producto</h1>
            <!-- Estructura para hacer un comentario -->
                <div class="com-comentar">
                    <div id="comentario" contenteditable="true" class="com-coment" placeholder="Escribe un comentario"></div>
                    <button id="btnComentar" class="btn btn-enviar btn-comentar">Comentar</button>
                </div>
            <div id="comentarios" class="contenedor contenedor-comentarios"> 
                <?php 
                    $sql = "SELECT id_comentario, usuarios.username, fecha, hora, comentario FROM comentarios INNER JOIN usuarios ON usuarios.id=comentarios.usuario_id WHERE id_padre is NULL AND producto_id=".$fila['producto_id']." ORDER BY fecha,hora;";
                    $resultado = $link->query($sql);
                    while($fila=$resultado->fetch_array()){
                ?>

                <!-- Estructura base de comentario -->
                <div class="com-contenedor" id="<?=$fila['id_comentario']?>">
                    <div class="com-info">
                        <h3 class="subtitulo sub-com"> <?=$fila['username']?> <!-- Username --></h3>
                        <h4 class="subtitulo sub-com sub-com-fecha"> <?=$fila['fecha']?><!-- Fecha --> </h4> 
                        <h4 class="subtitulo sub-com sub-com-fecha"> <?=$fila['hora']?><!-- Hora --></h4> 
                    </div>
                    <div class="com-coment"><?=$fila['comentario']?></div>
                    <!-- Responder al comentario -->
                    <button class="com-res" value="<?=$fila['id_comentario']?>">Responder</button>
                    <!-- Recuadro de respuesta siguiendo el esquema anterior -->
                    <!-- Se va disminuyendo el tamaño del recuadro. Establecer un mínimo de ancho -->
                    <!-- Usar el username como referencial. @fulanito -->
                    <!-- <div id="contresc(id)">
                        <div id="resc(id)" contenteditable="true" class="com-coment">Esta es una prueba para probar los estilos de css, ya me cansé</div>
                        <button class="btn btn-enviar btn-comentar btn-responder" value="resc(id)">Responder</button>
                    </div> -->
                </div>

                <?php } ?>
            </div>
        </section>
        <!-- Actualizar la cantidad de stock desde servidor -->
        <script src="../js/stock.js"></script>
        <script src="../SRC/js_async/comentarios.js"></script>
<?php        
        include("../../SRC/footer.php");
        $productoNuevo = fopen($archivo,'w');
        fwrite($productoNuevo, ob_get_contents());
        fclose($productoNuevo);
        ob_end_flush();
        if(file_exists($archivo)){
            echo "<script>"."document.addEventListener('DOMContentLoaded',()=>{
                location.reload();
            });"."</script>";
        }
    }
}

$_SESSION['msj'][0] = "msj msj-sucess";
$_SESSION['msj'][1] = "P&aacute;gina de productos creada con &eacute;xito.";
header("Location: ../../usuario.php");
exit;
?>