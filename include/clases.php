<?php
require "include/fpdf.php";

define('DB_SERVER','localhost'); 
define('DB_NAME','sm'); 
define('DB_USER','root'); 
define('DB_PASS',''); 


BD::connect();

class BD{
	
	public static $con;
	public static function connect(){
		BD::$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if (!bd::$con) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			exit;
		}
		mysqli_set_charset(BD::$con, "utf8");
	}
}

class IMG{
    public $src;
    public $width;
    public $height;
    public $imageType;
    public $mime;
    //Position top left
    public $x;
    public $y;
    public $maxWidth;
    public $maxHeight;

    function __construct($src){
        $array=  getimagesize($src);
        $this->width=$array[0];
        $this->height=$array[1];
        $this->imagetype=$array[2];
        $this->mime=$array['mime'];
    }
}

class PDF extends FPDF{
    function Image(IMG $img){
        parent::Image($img->src, $img->x, $img->y, $img->width, $img->height);
    }
}

?>