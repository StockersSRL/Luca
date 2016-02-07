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
    public $imageType;//PHP constant
    public $mime;// e.g. "image/png"
    //Position top left
    public $x=0;
    public $y=0;
    public $maxWidth;
    public $maxHeight;
    public $canvasWidth;
    public $canvasHeight;

    function __construct($src){
        $this->src=$src;
        $array=  getimagesize($src);
        // http://php.net/manual/en/function.getimagesize.php
        $this->width=$array[0]/72*25.4;
        $this->height=$array[1]/72*25.4;
        $this->imagetype=$array[2];
        $this->mime=$array['mime'];
    }
    
    function alignHorizontal(){
        $this->x=($this->canvasWidth - $this->width)/2;
    }
    
    function alignVertical(){
        $this->y=($this->canvasHeight - $this->height)/2;
    }
    
    function center(){
        $this->alignHorizontal();
        $this->alignVertical();
    }
    
    function resize($k){
        $centerX = $this->x+$this->width/2;
        $centerY = $this->y+$this->height/2;
        $this->width *= $k;
        $this->height *= $k;
        $this->x = $centerX - $this->width;
        $this->y = $centerY - $this->height;
    }
}

class PDF extends FPDF{
    function img(IMG $img){
        $originalProportion=$img->width/$img->height;
        $maxProportion=$img->maxWidth/$img->maxHeight;
        var_dump($img);
        if($originalProportion > $maxProportion){
            $img->resize($maxProportion);
        }else{
            $img->resize($originalProportion);
        }
        var_dump($img);
        parent::Image($img->src, $img->x, $img->y, $img->width, $img->height);
    }
    
    function setImgCanvasSize(IMG $img){
        $img->canvasWidth=$this->w;
        $img->canvasHeight=$this->h;
        return $img;
    }
}

?>