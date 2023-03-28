<!DOCTYPE html>
<html lang="ES-MX">
<head>
    <!--
        _____     __     _    ____  ____  _____ 
        | __ ) \ / /    / \  / ___||  _ \|___  |
        |  _ \\ V /    / _ \ \___ \| |_) |  / / 
        | |_) || |    / ___ \ ___) |  _ <  / /  
        |____/ |_|   /_/   \_\____/|_| \_\/_/    
    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Julio Serrepe">
    <title>Papelería | Tienda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>css/estilos.css">
    <link rel="shortcut icon" href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>img/logo.png" type="image/x-icon">
    <script src="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>js/responsive.js"></script>
</head>
<body>
    <header class="contenedor header">
        <h1 class="titulo">Papeler&iacute;a</h1>
        <nav class="nav" id="menuPC">
            <ul class="lista lista-header">
                <li title="Tienda"><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>index.php">Tienda</a></li>
                <li title="Usuario"><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>usuario.php"><svg width="30" height="30" viewBox="0 0 24 24" style="fill:rgb(255,255,255);"><path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"/><path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"/></svg></a></li>
                <li title="Carrito"><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>carrito.php"><svg class="iconos" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(255,255,255);"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg>
                <li title="Facturas"><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>facturas.php">Facturas</a></li>
                <li title="proveedores"><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>proveedores.php">Proveedores</a></li>
            </ul>
        </nav> 
        <svg id="menuMobile" class="menu-mobile none" width="50" height="50" viewBox="0 0 24 24" style="fill: #33cccc;"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
        <div class="enlaces-mobile-contenedor" id="enlacesMobile">
            <ul class="lista-header-mobile">
                <svg id="cerrarEnlacesMobile" width="50" height="50" viewBox="0 0 24 24" style="fill: #f33226;position: absolute; right: 45px; top: 10px;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793z"></path></svg>
                <li><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>index.php">Tienda</a></li>
                <li><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>usuario.php"><svg width="30" height="30" viewBox="0 0 24 24" style="fill:rgb(255,255,255);"><path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"/><path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"/></svg></a></li>
                <li><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>carrito.php"><svg class="iconos" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(255,255,255);"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg>
                <li><a href="<?php if(isset($urlCSS)){echo ($urlCSS);} ?>facturas.php">Facturas</a></li>
                <li><a href="<?php if(isset($urlCSS)){echo ($urlCSS);unset($urlCSS);} ?>proveedores.php">Proveedores</a></li>
            </ul>
        </div>
        <svg class="wave-header" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 310" version="1.1"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(243, 106, 62, 1)" offset="0%"/><stop stop-color="rgba(255, 179, 11, 1)" offset="100%"/></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,62L60,56.8C120,52,240,41,360,41.3C480,41,600,52,720,72.3C840,93,960,124,1080,139.5C1200,155,1320,155,1440,160.2C1560,165,1680,176,1800,170.5C1920,165,2040,145,2160,113.7C2280,83,2400,41,2520,25.8C2640,10,2760,21,2880,25.8C3000,31,3120,31,3240,62C3360,93,3480,155,3600,175.7C3720,196,3840,176,3960,149.8C4080,124,4200,93,4320,103.3C4440,114,4560,165,4680,175.7C4800,186,4920,155,5040,155C5160,155,5280,186,5400,201.5C5520,217,5640,217,5760,206.7C5880,196,6000,176,6120,170.5C6240,165,6360,176,6480,160.2C6600,145,6720,103,6840,98.2C6960,93,7080,124,7200,155C7320,186,7440,217,7560,206.7C7680,196,7800,145,7920,129.2C8040,114,8160,134,8280,124C8400,114,8520,72,8580,51.7L8640,31L8640,310L8580,310C8520,310,8400,310,8280,310C8160,310,8040,310,7920,310C7800,310,7680,310,7560,310C7440,310,7320,310,7200,310C7080,310,6960,310,6840,310C6720,310,6600,310,6480,310C6360,310,6240,310,6120,310C6000,310,5880,310,5760,310C5640,310,5520,310,5400,310C5280,310,5160,310,5040,310C4920,310,4800,310,4680,310C4560,310,4440,310,4320,310C4200,310,4080,310,3960,310C3840,310,3720,310,3600,310C3480,310,3360,310,3240,310C3120,310,3000,310,2880,310C2760,310,2640,310,2520,310C2400,310,2280,310,2160,310C2040,310,1920,310,1800,310C1680,310,1560,310,1440,310C1320,310,1200,310,1080,310C960,310,840,310,720,310C600,310,480,310,360,310C240,310,120,310,60,310L0,310Z"/></svg>
    </header>