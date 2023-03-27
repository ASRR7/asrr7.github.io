<?php
    if(isset($_POST['id'])){
        require("SRC/conex.php");
        $id = $_POST['id'];
        $sql = "SELECT producto_stock FROM productos WHERE producto_id=$id";
        $resultado = $link->query($sql);
        $fila=$resultado->fetch_array();
        $stock = $fila['producto_stock'];
        echo json_encode($stock);
    }
?>