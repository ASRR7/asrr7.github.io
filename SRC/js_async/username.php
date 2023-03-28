<?php
    require("../conex.php");
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $sql = "SELECT username FROM usuarios WHERE username='$username'";
        $resultado = $link->query($sql);
        $fila = $resultado->fetch_array();
        if(isset($fila['username'])){
            echo $fila['username'];
        }else{
            echo 'none';
        }
    }else if(isset($_POST['correo'])){
        $correo = $_POST['correo'];
        $sql = "SELECT correo FROM usuarios WHERE correo='$correo'";
        $resultado = $link->query($sql);
        $fila = $resultado->fetch_array();
        if(isset($fila['correo'])){
            echo $fila['correo'];
        }else{
            echo 'none';
        }
    }
?>