<?php
include "SRC/header.php";
require "SRC/conex.php";
$sql       = "SELECT empresa, telefono, correo FROM provedores";
$resultado = $link->query($sql);
$i=1; 
?>
<section class="contenedor contenedor-provedores">
    <h1 class="titulo subtitulo">Nuestros provedores</h1>
    <table id="tablaCarrito" class="tabla tabla-carrito">
        <thead>
            <tr class="carrito-tr carrito-th provedores-th">
                <th width="33%">Empresa</th>
                <th width="33%">Tel&eacute;fono <svg width="40" height="40" viewBox="0 0 24 24" style="fill: #33cccc;transform: ;msFilter:;"><path d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z"></path></svg></th>
                <th width="33%">Correo <svg width="40" height="40" viewBox="0 0 24 24" style="fill: #33cccc;transform: ;msFilter:;"><path d="M20 4H6c-1.103 0-2 .897-2 2v5h2V8l6.4 4.8a1.001 1.001 0 0 0 1.2 0L20 8v9h-8v2h8c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-7 6.75L6.666 6h12.668L13 10.75z"></path><path d="M2 12h7v2H2zm2 3h6v2H4zm3 3h4v2H7z"></path></svg></th>
            </tr>
        </thead>
        <tbody>
<?php
            while($fila=$resultado->fetch_array()) { ?>
            <tr class="carrito-tr">
                <td class="carrito-td provedores-td" width="33%"><?=$fila['empresa']?></td>
                <td class="carrito-td provedores-td" width="33%"><?=$fila['telefono']?></td>
                <td class="carrito-td provedores-td" width="33%"><?=$fila['correo']?></td> 
            </tr>
<?php       } ?>
        </tbody>
    </table>
</section>

<?php include "SRC/footer.php"; ?>