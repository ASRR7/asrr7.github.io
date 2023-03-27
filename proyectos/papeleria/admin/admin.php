<?php
session_start();
require("../SRC/conex.php");
$admin = openssl_decrypt($_POST['admin'],"AES-128-ECB",SALT);
if($admin != ROOT){
    $_SESSION['msj'][0] = "msj msj-error";
    $_SESSION['msj'][1] = "No tienes acceso a esta p&aacute;gina.";
    header("Location: ../index.php");
    exit;
}
$urlCSS = '../';
include("../SRC/header.php");
?>
    <section class="contenedor contenedor-admin">
        <div>
            <form action="p/creadorProductos.php" method="post" class="form-crud">
                <h2>Creador de p&aacute;ginas de productos.</h2>
                <input type="hidden" name="productos" value="TRUE">
                <button class="boton boton-compra" type="submit">Ir a la p&aacute;gina</button>
            </form>
            
            <form action="p/subir.php" method="post" class="form-crud">
                <h2>Subir nuevo producto.</h2>
                <input type="hidden" name="subir" value="TRUE">
                <button class="boton boton-compra" type="submit">Ir a la p&aacute;gina</button>
            </form>
            
            <form action="p/proveedor.php" method="post" class="form-crud">
                <h2>Añadir nuevo proveedor.</h2>
                <input type="hidden" name="proveedor" value="TRUE">
                <button class="boton boton-compra" type="submit">Ir a la p&aacute;gina</button>
            </form>

            <form action="p/editar.php" method="post" class="form-crud">
                <h2>Editar productos existentes.</h2>
                <input type="hidden" name="editar" value="TRUE">
                <button class="boton boton-compra" type="submit">Ir a la p&aacute;gina</button>
            </form>

            <form action="p/analizar-datos.php" method="post" class="form-crud">
                <h2>Analizar estad&iacute;sticas de la p&aacute;gina.</h2>
                <input type="hidden" name="analizar" value="TRUE">
                <button class="boton boton-compra" type="submit">Ir a la p&aacute;gina</button>
            </form>
        </div>
    </section>
<?php include("../SRC/footer.php"); ?>