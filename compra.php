<?php
session_start();
require("SRC/conex.php");
if(! isset($_POST['comprar'])){
    $_SESSION['msj'][0] = 'msj msj-error';
    $_SESSION['msj'][1] = 'P&aacute;gina no disponible.';
    header("Location: index.php");
    exit;
}
if(! isset($_SESSION['usuario'])){
    $_SESSION['msj'][0] = 'msj msj-error';
    $_SESSION['msj'][1] = 'Inicia Sesi&oacute;n o Registrate para poder realizar compras.';
    header("Location: carrito.php");
    exit;
}

try {
    $usID = $_SESSION['usuario']['id'];
    $total = $_POST['totalAbsoluto'];
    $fechaActual = date("d-m-Y");
    $horaActual = date("h:i:s");
    $sql = "INSERT INTO compras (usuario_id,total,fecha,hora) VALUES ('$usID','$total','$fechaActual','$horaActual');";
    $resultado = $link->query($sql);
    if(! isset($resultado)){
        throw new Exception("Error al conectarse con la base de datos.");
    }else{
        $ultimoID = mysqli_insert_id($link);
        foreach($_SESSION['carrito'] as $producto){
            $carCantidad = $producto['cantidad'];
            $carID = $producto['id'];
            // OBTENER STOCK DE PRODUCTO
            $sql = "SELECT producto_stock FROM productos WHERE producto_id=$carID";
            $resultado = $link->query($sql);
            $fila=$resultado->fetch_array();
            $stock = $fila['producto_stock']-$carCantidad;
            if($stock<0){
                throw new Exception("Ocurrió un error en el procesamiento de la compra.");
            }else{
                // MODIFICAR STOCK DE PRODUCTO
                $sql = "UPDATE productos SET producto_stock=$stock WHERE producto_id=$carID";
                $resultado = $link->query($sql);
                if(! isset($resultado)){
                    throw new Exception("Error al conectarse con la base de datos.");
                }
                $carPrecio = $producto['precio'];
                $carTotal = $carCantidad*$carPrecio;
                // INSERTAR DETALLES DE PEDIDO
                $sql = "INSERT INTO detalles_compra (compra_id,producto_id,precio,cantidad,total) VALUES ('$ultimoID','$carID','$carPrecio','$carCantidad','$carTotal');";
                $resultado = $link->query($sql);
                if(! isset($resultado)){
                    throw new Exception("Error al conectarse con la base de datos.");
                }else{
                    unset($_SESSION['carrito']);
                    $_SESSION['msj'][0] = "msj msj-sucess";
                    $_SESSION['msj'][1] = "Compra realizada con &eacute;xito.";
                    header("Location: index.php");
                    exit;
                }
            }
            
        }
    }
}catch(Exception $e){
    $_SESSION['msj'][0] = "msj msj-error";
    $_SESSION['msj'][1] = $e->getMessage();
}

?>