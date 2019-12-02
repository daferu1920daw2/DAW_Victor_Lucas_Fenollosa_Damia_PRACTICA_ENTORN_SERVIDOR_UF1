<?php
session_start();
require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

for ($i=0;$i<count($_SESSION['text']);$i++){
   $pdf->Cell(40,10,$_SESSION['text'][$i]); 
   $pdf->Ln();
   $pdf->Image("C:\\xampp\htdocs\projecte\img/".$_SESSION['img'][$i].".jpg");
   $pdf->Ln();
   $pdf->Cell(40,10,"--------------------------------------------------------------------------------"); 
   $pdf->Ln();
 }
 $pdf->Cell(40,10,"Precio total: ".$_SESSION['precioTotal']);
$pdf->Output();
?>