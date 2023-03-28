<?php
session_start();
if(! isset($_POST['analizar'])){
    $_SESSION['msj'][1] = "No tienes acceso a esta p&aacute;gina.";
    header("Location: ../../index.php");
    exit;
}
$urlCSS = '../../';
require("../../SRC/conex.php"); 
include("../../SRC/header.php");
?>
    <section class="contenedor contenedor-admin">
        <h1 class="titulo">Gr&aacute;ficas sobre la p&aacute;gina</h1>
        <!-- Cantidad de Productos de cada proveedor -->
        <div>
            <h2 class="subtitulo">Cantidad de productos de cada proveedor</h2>
            <canvas id="productosProveedor" width="400" height="400"></canvas>
            <ul class="subtitulo" id="listaProveedores">
            </ul>
        </div>

        <!--  -->
        <div style="margin-top:100px;">
            <h2 class="subtitulo">Cantidad de compras por d&iacute;a
            <select id="mesCompras">
                <option value="0">Enero</option>
                <option value="1">Febrero</option>
                <option value="2">Marzo</option>
                <option value="3">Abril</option>
                <option value="4">Mayo</option>
                <option value="5">Junio</option>
                <option value="6">Julio</option>
                <option value="7">Agosto</option>
                <option value="8">Septiembre</option>
                <option value="9">Octubre</option>
                <option value="10">Noviembre</option>
                <option value="11">Diciembre</option>
            </select>
            </h2>
            <canvas id="comprasDia" width="1200" height="500"></canvas>
        </div>

        <!--  -->
        <div style="margin-top:100px;">
            <h2 class="subtitulo">5 productos m&aacute;s vendidos</h2>
            <canvas id="masVendidos" width="1200" height="700"></canvas>
        </div>
    </section>
    <script src="../../js/graficas.js"></script>
<?php  include("../../SRC/footer.php"); ?>