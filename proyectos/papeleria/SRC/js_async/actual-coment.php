<?php
    require("../conex.php");
    if(isset($_POST['actualizar'])){
        $comentarios = array();
        $x = $y = 0;
        $id_p = $_POST['producto_id'];
        $sql = "SELECT id_comentario, usuarios.username, fecha, hora, comentario FROM comentarios INNER JOIN usuarios ON usuarios.id=comentarios.usuario_id WHERE id_padre is NULL AND producto_id=".$id_p." ORDER BY fecha DESC,hora DESC";
        $resultado = $link->query($sql);
        while($fila=$resultado->fetch_array()){
            $comentarios[$x]['id_comentario'] = $fila['id_comentario'];
            $comentarios[$x]['username'] = $fila['username'];
            $comentarios[$x]['fecha'] = $fila['fecha'];
            $comentarios[$x]['hora'] = $fila['hora'];
            $comentarios[$x]['comentario'] = $fila['comentario'];
            $id_coment = $fila['id_comentario'];
            $sqll = "SELECT id_comentario, id_padre, usuarios.username, fecha, hora, comentario FROM comentarios INNER JOIN usuarios ON usuarios.id=comentarios.usuario_id WHERE id_padre=".$id_coment." ORDER BY fecha DESC,hora DESC";
            $resultadoz = $link->query($sqll);
            $y = 0;
            while($filaz=$resultadoz->fetch_array()){
                $comentarios[$x]['hijos'][$y]['id_comentario'] = $filaz['id_comentario'];
                $comentarios[$x]['hijos'][$y]['username'] = $filaz['username'];
                $comentarios[$x]['hijos'][$y]['fecha'] = $filaz['fecha'];
                $comentarios[$x]['hijos'][$y]['hora'] = $filaz['hora']; 
                $comentarios[$x]['hijos'][$y]['comentario'] = $filaz['comentario']; 
                $y++;
            }
            // if($y<1){
            //     $comentarios[$x]['hijos'][0] = 0;
            // }
            $x++;
        }
        $comentariosJSON = json_encode($comentarios);
        header('Content-Type: application/json');
        // Devolver los datos en formato JSON
        echo $comentariosJSON;
    }
?>