<?php
require "include/fpdf.php";
require "include/clases.php";
class PDF extends FPDF{
	function Header(){
	global $lci;
	global $lnombre;
	global $luser;
	global $lsucursal;
	global $lcargo;
	global $pdf;
	global $i;

		$this->SetFont("Arial", "b", 19);
		$this->SetTextColor(0);
		$this->Cell(0, 5, "Listado de usuarios", 0, 1, 'C');
		$this->Ln();
		
		$this->SetFillColor(255);
		$this->SetTextColor(0);
		$this->SetFont("Arial", "b", 12);
		$this->Cell($lci, 5, "CI", 1, 0, 'C');
		$this->Cell($lnombre, 5, "Nombre", 1, 0, 'C');
		$this->Cell($luser, 5, "Username", 1, 0, 'C');
		$this->Cell($lsucursal, 5, "Sucursal", 1, 0, 'C');
		$this->Cell($lcargo, 5, "Cargo", 1, 0, 'C');
		$this->Ln();
	}
	
	function Footer(){
	global $hoy;
	// $phpdate = strtotime($hoy);
	$meses=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
	$ano = date_format($hoy, "Y");
	$mes =(int) date_format($hoy, "m");
	$dia = date_format($hoy, "j");
	
	$this->Ln();
	$this->SetTextColor(0);
	$this->Cell((297-10-10)/2, 5, "$dia de $meses[$mes] de $ano, ".date_format($hoy, "H:i:s"), 0, 0, "L");
	$this->Cell((297-10-10)/2, 5, "P�gina ".$this->PageNo()."/{nb}", 0, 0, "R");
	}
}
$pdf=new PDF('L', 'mm', 'A4');
$pdf->SetMargins(10, 10, 10);
$pdf->AliasNbPages();

$hoy = date_create();
$lci=21;
$lnombre=80;
$luser=40;
$lsucursal=20;
$lcargo=80+30+5;

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
}*/


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
}

$pdf->Output('usuarios.pdf', 'I');
?>