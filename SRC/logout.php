<?php
if(isset($_POST['salir'])){
    session_start();
    unset($_SESSION['usuario']);?>
    <script>
        localStorage.removeItem("username");
    </script>
    <?php
    $_SESSION['msj'][0] = 'msj msj-sucess';
    $_SESSION['msj'][1] = 'Sesi&oacute;n finalizada correctamente.';
}else{
    $_SESSION['msj'][0] = 'msj msj-error';
    $_SESSION['msj'][1] = 'Cierra sesi&oacute;n desde la p&aacute;gina de usuario.';
}
header("Location: ../index.php");
exit;
?>