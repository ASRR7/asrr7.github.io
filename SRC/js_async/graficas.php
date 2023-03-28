<?php
require("../conex.php");
if(isset($_POST['tipo'])){
    if($_POST['tipo'] == "proveedores"){
        $datos = array();
        $sql = "SELECT proveedores.empresa, COUNT(productos.producto_id) AS cantidad_productos FROM productos JOIN proveedores ON productos.proveedor_id = proveedores.proveedor_id GROUP BY proveedores.empresa;";
        $resultado = $link->query($sql);
        $x = 0;
        while($fila = $resultado->fetch_array()){
            $datos[$x]['provedor'] = $fila['empresa'];
            $datos[$x]['numero'] = $fila['cantidad_productos'];
            $totalP = $fila['cantidad_productos'];
            // Generar color a partir del nombre de la empresa
            $datos[$x]['color'] = '#'.substr(md5($fila['empresa']), 0, 6);;
            $x++;
        }
        for($z=0; $z<$x; $z++){
            // Porcentaje de cada dato
            $datos[$z]['dato'] = ($datos[$z]['numero']*10)/$totalP;
        }
    }else if($_POST['tipo'] == "compras"){
        $mes = $_POST['mes'];
        $datos = array();
        $sql = "SELECT DATE_FORMAT(STR_TO_DATE(fecha, '%d-%m-%Y'), '%d-%m-%Y') AS dia, COUNT(compra_id) AS cantidad_compras FROM compras WHERE MONTH(STR_TO_DATE(fecha, '%d-%m-%Y')) = $mes GROUP BY STR_TO_DATE(fecha, '%d-%m-%Y');";
        $resultado = $link->query($sql);
        $x = 0;
        while($fila = $resultado->fetch_array()){
            $datos[$x]['dia'] = $fila['dia'];
            $datos[$x]['compras'] = $fila['cantidad_compras'];
            $datos[$x]['color'] = '#'.substr(md5($fila['dia']), 0, 6);
            $x++;
        }
    }else if($_POST['tipo'] == "vendidos"){
        $datos = array();
        $sql = "SELECT productos.producto_nombre AS producto, SUM(detalles_compra.cantidad) AS cantidad_vendida FROM detalles_compra JOIN productos ON detalles_compra.producto_id = productos.producto_id GROUP BY detalles_compra.producto_id ORDER BY cantidad_vendida DESC LIMIT 5;";
        $resultado = $link->query($sql);
        $x = 0;
        while($fila = $resultado->fetch_array()){
            $datos[$x]['producto'] = $fila['producto'];
            $datos[$x]['cantidad'] = $fila['cantidad_vendida'];
            $datos[$x]['color'] = '#'.substr(md5($fila['producto']), 0, 6);
            $x++;
        }
    }
    $datosJSON = json_encode($datos);
    header('Content-Type: application/json');
    // Devolver los datos en formato JSON
    echo $datosJSON;
}
?>