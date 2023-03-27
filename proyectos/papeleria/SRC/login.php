<?php
require("conex.php");
session_start();
if((! isset($_POST['registro'])) && (! isset($_POST['inicio']))){
    $_SESSION['msj'][0] = 'msj msj-error';
    $_SESSION['msj'][1] = 'P&aacute;gina no disponible.';
    header("Location: ../index.php");
    exit;
}else {
    $_SESSION['msj'][0] = 'msj msj-error';
    if(isset($_POST['registro'])){
        if($_POST['contraseña2'] == $_POST['contraseña']){
            if(isset($_POST['nombre'])){
                if(isset($_POST['username'])){
                    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
                    if(isset($_POST['correo'])){
                        $correo = $_POST['correo'];
                        $sql = "SELECT username FROM usuarios WHERE username='$username'";
                        $resultado = $link->query($sql);
                        $fila = $resultado->fetch_array();
                        if(! isset($fila['username'])){
                            $sql = "SELECT correo FROM usuarios WHERE correo='$correo'";
                            $resultado = $link->query($sql);
                            $fila = $resultado->fetch_array();
                            if(! isset($fila['correo'])){
                                $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
                                $password = md5($_POST['contraseña'].$SALT);
                                $sql = "INSERT INTO usuarios (nombre,username,correo,contraseña) VALUES ('".$nombre."','".$username."','".$correo."','".$password."');";
                                $resultado = $link->query($sql);
                                if($resultado){
                                    $sql = "SELECT id,nombre,username,correo FROM usuarios WHERE correo='$correo' AND contraseña='$password'";
                                    $resultado = $link->query($sql);
                                    $fila=$resultado->fetch_array();
                                    $_SESSION['usuario']['id'] = $fila['id'];
                                    $_SESSION['usuario']['nombre'] = $fila['nombre'];
                                    $_SESSION['usuario']['username'] = $fila['username'];
                                    $_SESSION['usuario']['correo'] = $fila['correo']; ?>
                                    <script>
                                        localStorage.setItem("username", '<?=$_SESSION['usuario']['username']?>');
                                    </script>
                                    <?php $_SESSION['msj'][0] = 'msj msj-sucess';
                                    $_SESSION['msj'][1] = 'Registro completado correctamente. Gracias por su preferencia.';
                                    header("Location: ../usuario.php");
                                    exit;
                                }else {
                                    $_SESSION['msj'][1] = 'Ocurri&oacute; un error inesperado. Vuelve a intentarlo';
                                }
                            }else {
                                $_SESSION['msj'][1] = 'Correo ya registrado.';
                            }
                        }else {
                            $_SESSION['msj'][1] = 'Username no disponible.';
                        }
                    }else {
                        $_SESSION['msj'][1] = 'Ingresa tu correo.';
                    }
                }else{
                    $_SESSION['msj'][1] = 'Ingresa tu username.';
                }
            }else {
                $_SESSION['msj'][1] = 'Ingresa tu nombre.';
            }
        }else{
            $_SESSION['msj'][1] = 'La contraseña no coincide.';
        }
        // INGRESAR AL SISTEMA
    }else if(isset($_POST['inicio'])){
        if(isset($_POST['correo'])){
            $correo = $_POST['correo'];
            if(isset($_POST['contraseña'])){
                $password = md5($_POST['contraseña'].$SALT);
                $sql = "SELECT id,nombre,username,correo,contraseña,admin FROM usuarios WHERE correo='$correo'OR username='$correo' AND contraseña='$password'";
                $resultado = $link->query($sql);
                if($resultado){
                    $fila=$resultado->fetch_array();
                    if($password == $fila['contraseña']){
                        $_SESSION['usuario']['id'] = $fila['id'];
                        $_SESSION['usuario']['nombre'] = $fila['nombre'];
                        $_SESSION['usuario']['username'] = $fila['username'];
                        $_SESSION['usuario']['correo'] = $fila['correo'];?>
                        <?php
                        unset($password);
                        if($fila['admin'] == 1){
                            $_SESSION['usuario']['admin'] = 1;
                        }
                        $_SESSION['msj'][0] = 'msj msj-sucess';
                        $_SESSION['msj'][1] = 'Inicio de Sesi&oacute;n &eacute;xitoso. Le damos la bienvenida.';
                        header("Location: ../usuario.php");
                        exit;
                    }else {
                        $_SESSION['msj'][1] = 'Contraseña incorrecta.';
                    }
                }else {
                    $_SESSION['msj'][1] = 'Contraseña incorrecta.';
                }
            }else{
                $_SESSION['msj'][1] = 'Ingresa tu contraseña.';
            }
        }else{
            $_SESSION['msj'][1] = 'Ingresa tu correo.';
        }
    }else{
        $_SESSION['msj'][1] = 'Ocurri&oacute; un error durante el proceso de carga.';
    }
    header("Location: ../usuario.php");
    exit;
}


?>