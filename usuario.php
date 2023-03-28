<?php session_start(); include "SRC/header.php"; require "SRC/conex.php";?>
    <section class="contenedor contenedor-tienda">
    <h1 class="titulo subtitulo">USUARIO<?php # $msj = openssl_decrypt("cMLMqBvEUoT2nuK8CB7Pzg==","AES-128-ECB",SALT); var_dump($msj)."XD"; ?> </h1>
    <div class="contenedor contenedor-msj">
        
    <?php if(isset($_SESSION['msj'][1])){ ?>
            <p class="<?=$_SESSION['msj'][0]?>"><?=$_SESSION['msj'][1]?></p>
    <?php
            unset($_SESSION['msj']);
        }
    ?>
    </div>



    <?php if(isset($_SESSION['usuario'])){?>
        <!-- MOSTRAR PERFIL DE USUARIO -->
        <section class="contenedor contenedor-usuario">
            <h2 class="titulo subtitulo">Nombre: <?=$_SESSION['usuario']['nombre']?></h2>
            <h2 class="titulo subtitulo">Correo: <?=$_SESSION['usuario']['correo']?></h2>
            <h2 class="titulo subtitulo">Username: <?=$_SESSION['usuario']['username']?></h2>
            <?php if(isset($_SESSION['usuario']['admin'])){ ?>
                <form action="admin/admin.php" class="cerrar-sesion" method="post">
                    <input type="hidden" name="admin" value="<?php echo openssl_encrypt(ROOT,"AES-128-ECB",SALT) ?>">                    
                    <input class="boton boton-compra boton-form-usuario boton-admin" type="submit" name="send" value="Administración">
                </form>
            <?php } ?>
            <script>
                localStorage.setItem("username", '<?=$_SESSION['usuario']['username']?>');
            </script>
            <form action="SRC/logout.php" class="cerrar-sesion" method="post">
                <input class="boton boton-compra boton-form-usuario" type="submit" name="salir" value="Cerrar Sesión">
            </form>
        </section>
    <?php } else { ?>
        <div class="contenedor contenedor-form-usuario">
            <section class="form-usuario form-usuario-registro" id="form-usuario-registro">
                <h2 class="titulo subtitulo subtitulo-form-usuario">Registro de Usuario</h2>
                <form action="SRC/login.php" method="post">
                    <input type="text" name="nombre" placeholder="Ingresa tu Nombre completo" required>
                    <input type="text" id="username" minlength="4" maxlength="32" name="username" placeholder="Ingresa tu username" required>
                    <p id="msjUsername" class="none msj msj-error">Username no disponible</p>
                    <input id="correo" type="email" name="correo" placeholder="Ingresa tu Correo" required>
                    <p id="msjCorreo" class="none msj msj-error">Correo ya registrado</p>
                    <input type="password" name="contraseña" placeholder="Ingresa tu contraseña" required>
                    <input type="password" name="contraseña2" placeholder="Confirma tu contraseña" required>
                    <button id="btnUsername" class="boton boton-compra boton-form-usuario" type="submit" name="registro">Registrarse</button>
                    <p class="p-mini">Si ya tienes cuenta <b id="inicio" class="bColorAzul">Inicia Sesi&oacute;n</b></p>
                </form>
            </section>
            
            <section class="form-usuario form-usuario-inicio none" id="form-usuario-inicio">
                <h2 class="titulo subtitulo subtitulo-form-usuario">Inicio de Sesi&oacute;n</h2>
                <form action="SRC/login.php" method="post">
                    <input type="text" name="correo" placeholder="Ingresa tu Correo o username" required>
                    <input type="password" name="contraseña" placeholder="Ingresa tu contraseña" required>
                    <button class="boton boton-compra boton-form-usuario" type="submit" name="inicio">Iniciar Sesion</button>
                    <p class="p-mini">Si no tienes cuenta <b id="registro" class="bColorAzul">Registrate</b></p>
                </form>
            </section>
        </div>
    <?php } ?>
    </section>
    <script src="js/main.js"></script>
    <script src="SRC/js_async/username.js"></script>
<?php include "SRC/footer.php"; ?>
