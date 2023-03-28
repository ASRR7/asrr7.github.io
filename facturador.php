<?php
session_start();
require("SRC/conex.php");
require("SRC/fpdf/fpdf.php");
class PDF extends FPDF {
    function header() {
        $this->SetFont('Arial','B',23);
		$this->SetXY(2,0);
		$this->Cell(25,1.7,"Factura de Compra",0,2,'C');                   
		$this->SetFont('Arial','',18);
    }
}

// POSIBLES ERRORES

$_SESSION['msj'][0] = 'msj msj-error';
if(! isset($_SESSION['usuario'])){
    $_SESSION['msj'][1] = 'No tienes acceso a esta p&aacute;gina. Inicia Sesi&oacute;n';
    header("Location: ../index.php");
    exit;
}
if(! isset($_POST['id-factura']) || ! isset($_POST['id-usuario'])){
    $_SESSION['msj'][1] = 'Ocurri&oacute; un error. Intenta m&aacute;s tarde.';
    header("Location: ../index.php");
    exit;
}

// ASIGNANDO VALORES

$idFactura = $_POST['id-factura'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$totalAbsoluto = $_POST['totalAbsoluto'];
$sql       = "SELECT productos.producto_nombre, detalles_compra.precio, detalles_compra.cantidad, detalles_compra.total FROM detalles_compra INNER JOIN productos ON productos.producto_id=detalles_compra.producto_id  WHERE compra_id='$idFactura'";
$resultado = $link->query($sql);
if(! isset($resultado)){
    $_SESSION['msj'][1] = 'Ocurri&oacute; un error. Intenta m&aacute;s tarde.';
    header("Location: ../index.php");
    exit;
}else {

    // COMENZANDO PDF

    $pdf = new PDF('L', 'cm', 'A4');
    $pdf->AddPage();
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetX(2);
    $pdf->SetFont('Arial','B',18);
    //DATOS DE FACTURA 
    $pdf->Cell(25,1,("Nombre: ".html_entity_decode($_SESSION['usuario']['nombre'])),1,0,'C',TRUE);
    $pdf->Ln();
    $pdf->SetX(2);
    $pdf->Cell(25,1,("Correo de Usuario: ".html_entity_decode($_SESSION['usuario']['correo'])),1,0,'C',TRUE);
    $pdf->Ln();
    $pdf->SetX(2);
    $pdf->Cell(25,1,("Id de Compra: ".html_entity_decode($idFactura)),1,0,'C',TRUE);
    $pdf->Ln();
    $pdf->SetX(2);
    $pdf->Cell(25,1,("Fecha de Compra: ".html_entity_decode($fecha)),1,0,'C',TRUE);
    $pdf->Ln();
    $pdf->SetX(2);
    $pdf->Cell(25,1,("Hora de Compra: ".html_entity_decode($hora)),1,0,'C',TRUE);
    $pdf->Ln();
    $pdf->SetX(2);
    $pdf->Cell(25,1,("Total de Compra: ".html_entity_decode($totalAbsoluto)),1,0,'C',TRUE);
    $pdf->Ln();
    $pdf->SetX(2);

    //CREANDO THEAD
    $pdf->SetFillColor(180, 180, 180);
    $pdf->SetX(2);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(12.5,1,"Producto",1,0,'C',TRUE);
    $pdf->Cell(3.5,1,"Precio",1,0,'C',TRUE);
    $pdf->Cell(3.5,1,"Cantidad",1,0,'C',TRUE);
    $pdf->Cell(5.5,1,"Total",1,0,'C',TRUE);
    $pdf->Ln();

    // CICLO PARA CADA PRODUCTO
    
    while($fila=$resultado->fetch_array()){
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetX(2);
        $pdf->Cell(12.5,1,utf8_decode($fila['producto_nombre']),1,0,'C',TRUE);
        $pdf->Cell(3.5,1,('$'.$fila['precio']),1,0,'C',TRUE);
        $pdf->Cell(3.5,1,($fila['cantidad']),1,0,'C',TRUE);
        $pdf->Cell(5.5,1,('$'.$fila['total']),1,0,'C',TRUE);
        $pdf->Ln();
    }
    $pdf->Ln();
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetX(2);
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(25,1,utf8_decode("Gracias por comprar con nosotros."),0,0,'C',TRUE);
}
unset($_SESSION['msj']);
$pdf->Output("", "factura__usuario-".$_SESSION['usuario']['id']."__factura-".$idFactura.".pdf");

?>