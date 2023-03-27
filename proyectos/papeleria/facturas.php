<?php session_start(); include "SRC/header.php"; require "SRC/conex.php";?>
    <section class="contenedor contenedor-tienda">
        <h1 class="titulo subtitulo">Facturas de Compra</h1>
        <div class="contenedor contenedor-msj"> 
            <?php if(isset($_SESSION['msj'][1])){ ?>
                    <p class="<?=$_SESSION['msj'][0]?>"><?=$_SESSION['msj'][1]?></p>
            <?php
                    unset($_SESSION['msj']);
                }
            ?>
        </div>
        <section class="contenedor contenedor-usuario">
        <?php if(isset($_SESSION['usuario'])){?>
            <!-- MOSTRAR COMPRAS REALIZADAS -->
            <table id="tablaCarrito" class="tabla tabla-carrito">
                <thead>
                    <tr class="carrito-tr carrito-th">
                        <!-- 97% -->
                        <th width="20%">ID Compra</th>
                        <th width="20%">Total</th>
                        <th width="20%">Fecha</th>
                        <th width="20%">Hora</th>
                        <th width="20%">PDF</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql       = "SELECT compra_id,total,fecha,hora FROM compras WHERE usuario_id='".$_SESSION['usuario']['id']."';";
                $resultado = $link->query($sql);
                if($resultado){
                    $i=1;
                    while($fila=$resultado->fetch_array()) {
                ?>
                <tr class="carrito-tr">
                    <td class="carrito-td" width="20%"><?=$fila['compra_id']?></td>
                    <td class="carrito-td" width="20%">$<?=$fila['total']?></td>
                    <td class="carrito-td" width="20%"><?=$fila['fecha']?></td>
                    <td class="carrito-td" width="20%"><?=$fila['hora']?></td>
                    <td class="carrito-td" width="20%">
                        <form action="facturador.php" method="post">
                            <input type="hidden" name="id-factura" value="<?=$fila['compra_id']?>">
                            <input type="hidden" name="hora" value="<?=$fila['hora']?>">
                            <input type="hidden" name="totalAbsoluto" value="<?=$fila['total']?>">
                            <input type="hidden" name="fecha" value="<?=$fila['fecha']?>">
                            <input type="hidden" name="id-usuario" value="<?=$_SESSION['usuario']['id']?>">
                            <button class="boton boton-compra" type="submit" name="pdf-factura">Ver PDF</button>
                        </form>
                    </td>
                </tr>
                <?php 
                        }
                } else { ?>
                <tr style="display:flex;width:100%;">
                    <td style="width:100%;padding:2% 5%;text-align:center;font-size:1.5rem;"> No has realizado ninguna compra.</td>
                </tr>
            <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h2 class="titulo titulo-negro subtitulo">Inicia Sesi&oacute;n para poder ver las compras realizadas con tu cuenta.</h2>
        <?php } ?>
        </section>
    </section>
    <script src="js/main.js"></script>
<?php include "SRC/footer.php"; ?>
