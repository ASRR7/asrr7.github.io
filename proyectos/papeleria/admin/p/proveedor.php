<?php
session_start();
if(! isset($_POST['proveedor']) && !isset($_POST['empresa']) && !isset($_SESSION['msj'][1])){
    $_SESSION['msj'][0] = "msj msj-error";
    $_SESSION['msj'][1] = "No tienes acceso a esta p&aacute;gina.";
    header("Location: ../../index.php");
    exit;
}
$urlCSS = '../../';
require("../../SRC/conex.php");
if(isset($_POST['empresa']) && isset($_POST['correo']) && isset($_POST['telefono'])){
    $empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES, 'UTF-8');
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $sql = "INSERT INTO `proveedores`(`empresa`, `telefono`, `correo`) VALUES ('$empresa','$telefono','$correo')";
    $resultado = $link->query($sql);
    if(! isset($resultado)){
        $_SESSION['msj'][0] = "msj msj-error";
        $_SESSION['msj'][1] = "Algo ha fallado.";
        header("Location: proveedor.php");
        exit;
    }else {
        $_SESSION['msj'][0] = "msj msj-sucess";
        $_SESSION['msj'][1] = "Nuevo proveedor añadido correctamente.";
        header("Location: proveedor.php");
        exit;
    }
}
include("../../SRC/header.php");
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
                <form action="proveedor.php" method="post" id="formSubir">
                    <h1 class="titulo">Nuevo proveedor</h1>
                    <input type="text" name="empresa" placeholder="Ingresa Nombre de Empresa" required>
                    <input type="tel" name="telefono" placeholder="Tel&eacute;fono de la empresa" required>
                    <input type="email" name="correo" placeholder="Correo de la empresa" required>
                    <button type="submit" class="btn btn-enviar">Agregar proveedor <svg width="30" height="30" viewBox="0 0 24 24" style="fill: #107979;transform: ;msFilter:;"><path d="M13 19v-4h3l-4-5-4 5h3v4z"></path><path d="M7 19h2v-2H7c-1.654 0-3-1.346-3-3 0-1.404 1.199-2.756 2.673-3.015l.581-.102.192-.558C8.149 8.274 9.895 7 12 7c2.757 0 5 2.243 5 5v1h1c1.103 0 2 .897 2 2s-.897 2-2 2h-3v2h3c2.206 0 4-1.794 4-4a4.01 4.01 0 0 0-3.056-3.888C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.611 5.757 9.15 3.609 9.792 2 11.82 2 14c0 2.757 2.243 5 5 5z"></path></svg></button>
                </form>
            </section>
        </div>
</section>
<?php  include("../../SRC/footer.php"); ?>