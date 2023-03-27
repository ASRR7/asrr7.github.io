<?php
    require("../conex.php");
    if(isset($_POST['comentar'])){
        // Buscar username en BBDD
        $username = $_POST['username'];
        $sql = "SELECT id, username FROM usuarios WHERE username='$username'";
        $resultado = $link->query($sql);
        $fila = $resultado->fetch_array();
        if($username == $fila['username']){
            $user_id = $fila['id'];
            $producto_id = $_POST['producto_id'];
            $id_padre = $_POST['id_padre'];
            $comment = htmlspecialchars($_POST['comentario'], ENT_QUOTES, 'UTF-8');
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            if($id_padre == -1){
                $sql = "INSERT INTO `comentarios`(`producto_id`, `usuario_id`, `fecha`, `hora`, `comentario`) VALUES
                ($producto_id,$user_id,'$fecha','$hora','$comment')";
            }else {
                $sql = "INSERT INTO `comentarios`(`id_padre`, `producto_id`, `usuario_id`, `fecha`, `hora`, `comentario`) VALUES
                ($id_padre,$producto_id,$user_id,'$fecha','$hora','$comment')";
            }
            $resultado = $link->query($sql);
            $ultimoID = mysqli_insert_id($link);
            if($resultado){
                echo $ultimoID;
            }else{ 
                echo false;
            }
        }else{
            echo false;
        }
    }
?>