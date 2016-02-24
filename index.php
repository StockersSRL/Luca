<?php
require "include/clases.php";
require "include/draw.php";

class PDF extends PDF_Draw{
    function Header(){
        if ( $this->PageNo() !== 1 ) {
            global $categoria;
            $txt = $categoria;
            $txt=  utf8_decode($txt);
            $txt= strtoupper($txt);
            $x=15.202;
            $y=297-293.667;
            $w=179.596;
            $h=30.31;
            $this->RoundedRect($x, $y, $w , $h, 7, '0101', 'F', null, array(247, 217,23));
            $fontsize=72;
            $this->SetFont('Arial', 'B', $fontsize);
            $this->SetTextColor(70, 152, 199);
            $this->setXY($x, $y);
            while($this->GetStringWidth($txt)>$w){
                $fontsize--;
                $this->SetFontSize($fontsize);
            }
            $this->Cell($w, $h, $txt, 0, 0, 'C');
        }
    }
    
    function Footer() {
        if ( $this->PageNo() !== 1 ) {
            //SEPARATOR
            $this->SetY(297-28.605);
            $this->Cell(0, 0.683, '', 0, 1, '', true);
            
            //TEXT
            $this->SetFont('Arial', 'B', 12);
            $this->SetY(297-23.803);
            $txt = 'PAYSANDÚ 1215 APTO 101';
            $txt = utf8_decode($txt);
            $this->Cell(0, 4.4, $txt, 0, 0);
            
            //PAGE
            $this->setX(75);
            $txt = "Página ".$this->PageNo()."/{nb}";
            $txt = utf8_decode($txt);
            $this->Cell(173.282-75, 4.4, $txt, 0, 1, 'R');
            
            //TEXT
            $txt = 'TEL/FAX : 2902 7764';
            $txt = utf8_decode($txt);
            $this->Cell(0, 4.4, $txt, 0, 1);
            
            $txt = 'CEL : 099 27 41 81';
            $txt = utf8_decode($txt);
            $this->Cell(0, 4.4, $txt, 0, 0);
            
            //DATE
            global $hoy;
            $meses=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
            $ano = date_format($hoy, "Y");
            $mes = (int) date_format($hoy, "m");
            $dia = date_format($hoy, "j");
            $this->setX(75);
            $txt = "$dia de $meses[$mes] de $ano, ".date_format($hoy, "H:i");
            $txt = utf8_decode($txt);
            $this->Cell(173.282-75, 4.4, $txt, 0, 1, 'R');
            
            //IMAGE
            $this->Image('images/pdf/fontanero.jpg', 173.282, 297-27.546, 21.302);
            
        }
    }
    
    function ImageCenter($file, $x, $y, $maxw, $maxh){
        $imgsize=  getimagesize($file);
        $imgw=$imgsize[0]/$this->k;
        $imgh=$imgsize[1]/$this->k;
        

        $imgratio=$imgh/$imgw;
        $maxratio=$maxh/$maxw;
        
        if($imgratio < $maxratio){//IMAGE LANDSCAPE
            $k=$maxw/$imgw;
            $w=$maxw;
            $h=$imgh*$k;
            $y+=($maxh-$h)/2;
        }else{//IMAGE PORTRAIT
            $k=$maxh/$imgh;
            $h=$maxh;
            $w=$imgw*$k;
            $x+=($maxw-$w)/2;
        }
        $this->Image($file, $x, $y, $w, $h);
    }

}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetMargins(15.202, 6.088, 15.202);
$pdf->SetAutoPageBreak(true, 6.088);
$pdf->AddFont('Bodoni MT', 'B', 'bod_b.php');
$pdf->AddFont('Arial', '', 'arial.php');
$pdf->AddFont('Arial', 'B', 'arialbd.php');
$hoy = date_create();

$pdf->AddPage();

//TALMET
$x = 15.175;
$y = 297-283.295;
$border = $x-14.32;
$height = 58.779;
$width = 180.656;
$pdf->SetFillColor(0, 0, 128);
$pdf->Rect($x-$border, $y-$border, $width+2*$border, $height+2*$border, 'F');
$pdf->Image('images/pdf/talmet.jpg', $x, $y, $width, $height);

//FONTANERO
$pdf->Image('images/pdf/fontanero.jpg', 53.734, 297-201.132, 97.852);

//FERE
$x = 17.141;
$y = 297-66.26;
$height = 19.707;
$width = 48.605;
$pdf->SetFillColor(0);
$pdf->Rect($x-$border, $y-$border, $width+2*$border, $height+2*$border, 'F');
$pdf->Image('images/pdf/fere.jpg', $x, $y, $width, $height);

//CLIUS
$x = 80.067;
$pdf->SetFillColor(255, 0, 0);
$pdf->Rect($x-$border, $y-$border, $width+2*$border, $height+2*$border, 'F');
$pdf->Image('images/pdf/clius.jpg', $x, $y, $width, $height);

//METASUL
$x = 141.027;
$pdf->SetFillColor(0);
$pdf->Rect($x-$border, $y-$border, $width+2*$border, $height+2*$border, 'F');
$pdf->Image('images/pdf/metasul.jpg', $x, $y, $width, $height);

//SEPARATOR
$y = 297-35.541;
$width = 192.284;
$x = (210-$width)/2;
$pdf->Rect($x, $y, $width, $border, 'F');

//TEXT
$pdf->SetFont('Bodoni MT', 'B', 16);
$pdf->SetXY(0, 297-31.32);
$txt = 'PAYSANDÚ 1215 APTO 101      TEL/FAX : 2902 7764      CEL : 099 27 41 81';
$txt = utf8_decode($txt);
$pdf->Cell(210, 7, $txt, 0, 0, 'C');
$pdf->Ln();
$pdf->Ln();
$txt = 'E-MAIL : marcoserpi@hotmail.com';
$txt = utf8_decode($txt);
$pdf->Cell(0, 0, $txt, 0, 1, 'C');

$sql="SELECT articulo.id AS 'id_articulo', subarticulo.id AS 'id_subarticulo', categoria.id AS 'id_categoria', codigo, precio, stock, articulo.nombre AS 'nombre', descripcion, imgpath, categoria.nombre AS'nombre_categoria', distincion FROM subarticulo, articulo, categoria WHERE articulo.id = subarticulo.id_articulo AND id_categoria=categoria.id AND activo=1 ORDER BY id_categoria, id_articulo";
$resultado=mysqli_query(bd::$con, $sql);

    $i=0;
    $border=0.896;
    $w=59.865-2*$border;
    $imgh=53.218;
while($fila=mysqli_fetch_object($resultado)){
    
    $categoria=$fila->nombre_categoria;
    $idcat=$fila->id_categoria;
    if($i%9==0 || $idcat!=$idcat2){//SI CAMBIA DE CATEGORIA TAMBIEN
        $idcat2=$idcat;
        $pdf->AddPage();
        $x=15.202;
        $y=36.617;
    }
    if($i%3==0 && $i%9!=0){
        $x=15.202;
        $y+=76.268;
    }
    $pdf->ImageCenter($fila->imgpath, $x+$border, $y+$border, $w, $imgh);
    
    
    $codigo=$fila->codigo;
    if($codigo!=null){
        $txt=  utf8_decode("Código: ".$codigo);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(255);
        $stringw=$pdf->GetStringWidth($txt);
        $pdf->setXY($x+$border+$w-$stringw, $y+$border+$imgh-3);
        $pdf->Cell($stringw, 3, $txt, 0, 0, 'C', true);
    }
    
    $cellh=3.6085;
    if (strcasecmp($fila->distincion, "no")==0) {
        $txt = $fila->nombre;
    } else {
        $txt = $fila->nombre . " " . $fila->distincion . " " . $fila->descripcion;
    }
    $txt=  utf8_decode($txt);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY($x+$border, $y+$border+$imgh);
    $pdf->MultiCell($w, 3.6085, $txt, 0, 'C');
    
    $pdf->Ln();
    $pdf->SetX($x);
    $txt="\$U ".$fila->precio;
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell($w, 3.6085, $txt, 0, 0, 'C');
    
    $x+=59.865;
    $i++;
}

$pdf->Output('test.pdf', 'I');
?>