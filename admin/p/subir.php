<?php
session_start();
if(! isset($_POST['subir']) && ! isset($_POST['nombre']) && ! isset($_SESSION['msj'][1])){
    $_SESSION['msj'][0] = "msj msj-error";
    $_SESSION['msj'][1] = "No tienes acceso a esta p&aacute;gina.";
    header("Location: ../../index.php");
    exit;
}
$urlCSS = '../../';
require("../../SRC/conex.php");
if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['proveedor'])){
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $desc = htmlspecialchars($_POST['desc'], ENT_QUOTES, 'UTF-8');
    $proveedor = $_POST['proveedor'];

    $ruta = strtolower($_POST['nombre']);
    $ruta = str_replace(" ", "-", $ruta);
    $imgFormato = explode(".",$_FILES['img']['name']);
    $img = ".".$imgFormato[1];
    $img = $ruta.$img;
    if (!(move_uploaded_file($_FILES['img']['tmp_name'], "../../img/".$img))) {
        $_SESSION['msj'][0] = "msj msj-error";
        $_SESSION['msj'][1] = "Algo ha fallado en la subida de la imagen.";
        header("Location: subir.php");
        exit;
    }
    $sql = "INSERT INTO `productos`(`producto_nombre`, `producto_precio`, `producto_stock`, producto_descripcion, `producto_img`, `proveedor_id`, `ruta`) VALUES ('$nombre','$precio','$stock', '$desc','$img','$proveedor','$ruta')";
    $resultado = $link->query($sql);
    if(! isset($resultado)){
        $_SESSION['msj'][0] = "msj msj-error";
        $_SESSION['msj'][1] = "Algo ha fallado.";
        header("Location: subir.php");
        exit;
    }else {
        $_SESSION['msj'][0] = "msj msj-sucess";
        $_SESSION['msj'][1] = "Producto nuevo añadido correctamente.";
        header("Location: subir.php");
        exit;
    }
}
include("../../SRC/header.php");
$sql = "SELECT proveedor_id, empresa FROM proveedores";
$resultado = $link->query($sql);
?>
<section class="contenedor contenedor-subir">
<?php if(isset($_SESSION['msj'][1])){ ?>
            <p class="<?=$_SESSION['msj'][0]?>"><?=$_SESSION['msj'][1]?></p>
<?php
            unset($_SESSION['msj']);
        }
?>
    <div class="contenedor contenedor-form-usuario">
            <section class="form-usuario form-usuario-registro">
                <form enctype="multipart/form-data" action="subir.php" method="post" id="formSubir">
                    <h1 class="titulo">Subir nuevo producto</h1>
                    <input type="text" name="nombre" placeholder="Ingresa Nombre de producto" required>
                    <input type="number" name="precio" placeholder="Precio $" required>
                    <input type="number" name="stock" placeholder="Stock disponible" required>
                    <textarea class="text-area" name="desc" placeholder="Descripción del producto" required></textarea>
                    <select name="proveedor" required>
                        <option value="0">------ Proveedor de Producto ------</option>
                    <?php  while($fila=$resultado->fetch_array()) { ?>
                        <option value="<?=$fila['proveedor_id']?>"><?=$fila['empresa']?></option>
                    <?php } ?>
                    </select>
                    <span class="boton boton-compra" id="subirBoton">Subir imagen de Producto</span>
                    <input class="subir-img" id="subirInput" type="file" name="img" accept="image/png, image/jpg, image/jpeg, image/webp" hidden required>
                    <button type="submit" class="btn btn-enviar">Subir producto <svg width="30" height="30" viewBox="0 0 24 24" style="fill: #107979;transform: ;msFilter:;"><path d="M13 19v-4h3l-4-5-4 5h3v4z"></path><path d="M7 19h2v-2H7c-1.654 0-3-1.346-3-3 0-1.404 1.199-2.756 2.673-3.015l.581-.102.192-.558C8.149 8.274 9.895 7 12 7c2.757 0 5 2.243 5 5v1h1c1.103 0 2 .897 2 2s-.897 2-2 2h-3v2h3c2.206 0 4-1.794 4-4a4.01 4.01 0 0 0-3.056-3.888C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.611 5.757 9.15 3.609 9.792 2 11.82 2 14c0 2.757 2.243 5 5 5z"></path></svg></button>
                </form>
            </section>
        </div>
</section>
<script src="../../js/subir.js"></script>
<?php  include("../../SRC/footer.php"); ?>