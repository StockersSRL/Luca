<?php
require "include/clases.php";

$pdf=new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
/*
$hoy = date_create();
$lci=21;
$lnombre=80;
$luser=40;
$lsucursal=20;
$lcargo=80+30+5;
*/

$pdf->AddPage();

/*
$sql="SELECT persona.CI, Nombre, Apellido, User, Sucursal, Cargo FROM empleado, persona WHERE empleado.CI = persona.CI";
$resultado=mysqli_query(bd::$con, $sql);

while($fila=mysqli_fetch_object($resultado)){
	$pdf->SetFont("Arial", "", 12);
	$i%2==0 ? $pdf->SetFillColor(32, 86, 172) : $pdf->SetFillColor(255);
	$i%2==0 ? $pdf->SetTextColor(255) : $pdf->SetTextColor(0);
	$pdf->Cell($lci, 5, utf8_decode($fila->CI), 1, 0, 'R', 1);
	$pdf->Cell($lnombre, 5, utf8_decode($fila->Nombre)." ".utf8_decode($fila->Apellido), 1, 0, 'C', 1);
	$pdf->Cell($luser, 5, utf8_decode($fila->User), 1, 0, 'C', 1);
	$pdf->Cell($lsucursal, 5, utf8_decode($fila->Sucursal), 1, 0, 'C',1);
	$pdf->Cell($lcargo, 5, utf8_decode($fila->Cargo), 1, 0, 'L', 1);
	$pdf->Ln();
	$i++;
}


for($i=0; $i<50; $i++){
	$pdf->SetFont("Arial", "", 12);
	$i%2==0 ? $pdf->SetFillColor(32, 86, 172) : $pdf->SetFillColor(255);
	$i%2==0 ? $pdf->SetTextColor(255) : $pdf->SetTextColor(0);
	$pdf->Cell($lci, 5, "46365701", 1, 0, 'R', 1);
	$pdf->Cell($lnombre, 5, "Lucas Rodriguez", 1, 0, 'C', 1);
	$pdf->Cell($luser, 5, "lucasrod", 1, 0, 'C', 1);
	$pdf->Cell($lsucursal, 5, "algo", 1, 0, 'C',1);
	$pdf->Cell($lcargo, 5, "CEO", 1, 0, 'L', 1);
	$pdf->Ln();
}*/

$img = new IMG('fontanero.jpg');
$pdf->setImgCanvasSize($img);
$img->maxHeight=98;
$img->maxWidth=96;
$img->center();
$pdf->img($img);

$pdf->Output('test.pdf', 'I');
?>