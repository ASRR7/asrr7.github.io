<?php
session_start();
if(! isset($_POST['editar'])){
    if(! isset($_POST['p_nombre']) && ! isset($_SESSION['msj'][1])){
        $_SESSION['msj'][0] = "msj msj-error";
        $_SESSION['msj'][1] = "No tienes acceso a esta p&aacute;gina.";
        header("Location: ../../index.php");
        exit;
    }
}
$urlCSS = '../../';
require("../../SRC/conex.php");
if(isset($_POST['p_nombre']) && isset($_POST['p_img']) && isset($_POST['p_stock']) && isset($_POST['p_precio'])){
    
    try{
        $nombre = $_POST['p_nombre'];
        $precio = $_POST['p_precio'];
        $stock = $_POST['p_stock'];
        $img = $_POST['p_img'];
        $ruta = $_POST['p_ruta'];
        $id = $_POST['p_id'];
        $sql = "UPDATE productos SET producto_nombre='$nombre', producto_precio=$precio, producto_stock=$stock, producto_img='$img', ruta='$ruta' WHERE producto_id=$id;";
        $resultado = $link->query($sql);
        if(! isset($resultado)){
            throw New Exception ("Error al actualizar la informaci&oaute;n del producto.");
        }else{
            $_SESSION['msj'][0] = "msj msj-sucess";
            $_SESSION['msj'][1] = "Datos actualizados correctamente.";
            header("Location: editar.php");
            exit;
        }
    }
    catch(Exception $e){
        $_SESSION['msj'][0] = "msj msj-error";
        $_SESSION['msj'][1] = $e->getMessage();
        header("Location: editar.php");
        exit;
    }
}
include("../../SRC/header.php");
$sql       = "SELECT producto_id, producto_nombre, producto_precio, producto_stock, producto_img, ruta FROM productos";
$resultado = $link->query($sql);
?>
    <section class="contenedor contenedor-proveedores">
        <!-- SECCION DE MENSAJES -->
<?php if(isset($_SESSION['msj'][1])){ ?>
            <p class="<?=$_SESSION['msj'][0]?>"><?=$_SESSION['msj'][1]?></p>
<?php
            unset($_SESSION['msj']);
        }
?>
        <h1 class="titulo">Editar informaci&oacute;n de productos</h1>
        <table id="tablaCarrito" class="tabla tabla-carrito">
            <thead>
                <tr class="carrito-tr carrito-th proveedores-th">
                    <th width="2%">Id</th>
                    <th width="9%">IMG</th>
                    <th width="21%">Ruta IMG</th>
                    <th width="25%">Nombre</th>
                    <th width="9%">Stock</th>
                    <th width="9%">Precio</th>
                    <th width="21%">Ruta HTML</th>
                    <th width="2%"></th>
                </tr>
            </thead>
            <tbody>
<?php
            while($fila=$resultado->fetch_array()) { ?>
                <tr class="carrito-tr">
                    <td class="carrito-td proveedores-td" width="2%"><?=$fila['producto_id']?></td>
                    <td class="carrito-td proveedores-td" width="9%"><img src="../../img/<?=$fila['producto_img']?>" width="100%"></img></td>
                    <form action="editar.php" method="post" class="form-editar">
                        <input type="hidden" name="p_id" value="<?=$fila['producto_id']?>">
                        <td class="carrito-td proveedores-td" width="21%"><input class="form-editar" name="p_img" type="text" value="<?=$fila['producto_img']?>"> </td> 
                        <td class="carrito-td proveedores-td" width="25%"><input class="form-editar" name="p_nombre" type="text" value="<?=$fila['producto_nombre']?>"> </td>
                        <td class="carrito-td proveedores-td" width="9%"><input class="form-editar" name="p_stock" type="number" value="<?=$fila['producto_stock']?>"> </td>
                        <td class="carrito-td proveedores-td" width="9%"><input class="form-editar" name="p_precio"  type="number" value="<?=$fila['producto_precio']?>"> </td>
                        <td class="carrito-td proveedores-td" width="21%"><input class="form-editar" name="p_ruta" type="text" value="<?=$fila['ruta']?>"> </td>
                        <td class="carrito-td proveedores-td" width="2%"><button class="btn" type="submit"><svg width="30" height="30" viewBox="0 0 24 24" style="fill: #118700;transform: ;msFilter:;"><path d="m21.426 11.095-17-8A.999.999 0 0 0 3.03 4.242L4.969 12 3.03 19.758a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81zM5.481 18.197l.839-3.357L12 12 6.32 9.16l-.839-3.357L18.651 12l-13.17 6.197z"></path></svg></button></td> 
                    </form>
                </tr>
<?php      } ?>
            </tbody>
        </table>
    </section>
<?php  include("../../SRC/footer.php"); ?>