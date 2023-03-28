<?php
    define("SALT",'ETECM61A');
    define("ROOT",'GRUPO61A');
    date_default_timezone_set('America/Mexico_City');
    try {
        $link = mysqli_connect("containers-us-west-97.railway.app","root","M1W8DZw00B2XJNWgQJYF","railway");
        if(! isset($link)){
            throw new Exception("Error al conectarse con Base de Datos.");
        }
    }catch(Exception $e){
        $_SESSION['msj'][0] = "msj msj-error";
        $_SESSION['msj'][1] = "Error al conectarse con base de datos.";
    }
?>