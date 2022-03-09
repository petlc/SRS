<?php
/*
require_once 'db.connections.php';

$get_info = new Update();

$get_info->query("Select first_name, middle_initial, last_name from employees where id='1666'");
$get_info->execute();

if($get_info->single() > 0){
    $emp_dtls = $get_info->single();
    
    //print_r($emp_dtls);
    
    $f_name = $emp_dtls['first_name'];
    $l_name = $emp_dtls['last_name'];
    
    $f_init = $f_name[0].".".$l_name;
}
*/
?>
<style>
    
    .canvas{
        
        width: 300px;
        height: 300px;
    }
    
    #box{
        padding: 5px 5px;
        width: 200px;
        height: 200px;
        border: 1px solid black;
    }
    
    #circle {
        width: 80px;
        height: 80px;
        padding: 8px;
        border: 2px solid red;
        -moz-border-radius: 100px;
        -webkit-border-radius: 100px;
        border-radius: 100px;
        font-size: 12px;
    }

    #head {
        padding-left: 15px;
        padding-top: 10px;
        position: absolute;
        
    }   
    
    #body {
        padding-left: 12px;
        padding-top: 30px;
        position: absolute;
    }
    
    #foot {
        text-align: center;
        padding-left: 10px;
        padding-top: 50px;
        position: absolute;
    }
    
</style>

<div id="box">
        
    <div id="circle">
        <label id="head">PET MIS</label>
        <label id="body">2018/03/02</label>
        <label id="foot">R.Bacus</label>
    </div>

</div>
  

<form method="get">

    <input type="range" min="80" max="150" value="80" class="slider" id="circleWH">
    <p>Radius: <span id="circleWH_demo"></span></p>
    
    <div class="slidecontainer">
        <label>Dept. Settings</label><br>
        <input type="range" min="1" max="150" value="0" class="slider" id="headx">
        <p>X position: <span id="headx_demo"></span></p>
        <input type="range" min="1" max="150" value="0" class="slider" id="heady">
        <p>Y position: <span id="heady_demo"></span></p>
        <input type="range" min="12" max="80" value="16" class="slider" id="headfont">
        <p>Font Size: <span id="headfont_demo"></span></p>
    </div>
    <div class="slidecontainer">
        <label>Date. Settings</label><br>
        <input type="range" min="1" max="150" value="0" class="slider" id="bodyX">
        <p>X position: <span id="bodyX_demo"></span></p>
        <input type="range" min="15" max="150" value="15" class="slider" id="bodyY">
        <p>Y position: <span id="bodyY_demo"></span></p>
        <input type="range" min="16" max="80" value="16" class="slider" id="bodyfont">
        <p>Font Size: <span id="bodyfont_demo"></span></p>
    </div>
    <div class="slidecontainer">
        <label>Date. Settings</label><br>
        <input type="range" min="1" max="150" value="0" class="slider" id="footX">
        <p>X position: <span id="footX_demo"></span></p>
        <input type="range" min="15" max="150" value="15" class="slider" id="footY">
        <p>Y position: <span id="footY_demo"></span></p>
        <input type="range" min="12" max="80" value="16" class="slider" id="footfont">
        <p>Font Size: <span id="footfont_demo"></span></p>
    </div>
</form>


<script>
var slider = document.getElementById("circleWH");
var slideroutput = document.getElementById("circleWH_demo");
slideroutput.innerHTML = slider.value;
    
slider.oninput = function() {
  slideroutput.innerHTML = this.value;
    
    document.getElementById("circle").style.width = this.value;
    document.getElementById("circle").style.height = this.value;
    document.getElementById("head").style.paddingLeft = (this.value / 5.3332);
    document.getElementById("head").style.paddingTop = (this.value / 7.8);
    document.getElementById("head").style.fontSize = (this.value / 6.66);
    
    document.getElementById("body").style.paddingLeft = (this.value / 6.7);
    document.getElementById("body").style.paddingTop = (this.value / 2.68);
    document.getElementById("body").style.fontSize = (this.value / 6.67);
    
    document.getElementById("foot").style.paddingLeft = (this.value / 8);
    document.getElementById("foot").style.paddingTop = (this.value / 1.6);
    document.getElementById("foot").style.fontSize = (this.value / 6.67);
}

var headx = document.getElementById("headx");
var headxoutput = document.getElementById("headx_demo");
headxoutput.innerHTML = headx.value;
    
headx.oninput = function() {
  headxoutput.innerHTML = this.value;
    
    document.getElementById("head").style.paddingLeft = this.value;
    
}

var heady = document.getElementById("heady");
var headyoutput = document.getElementById("heady_demo");
headyoutput.innerHTML = heady.value;
    
heady.oninput = function() {
  headyoutput.innerHTML = this.value;
    
    document.getElementById("head").style.paddingTop = this.value;
    
}

var font = document.getElementById("headfont");
var font_output = document.getElementById("headfont_demo");
font_output.innerHTML = font.value;
    
font.oninput = function() {
  font_output.innerHTML = this.value;
    document.getElementById("head").style.fontSize = this.value;
    
}

/* Body */


var bodyX = document.getElementById("bodyX");
var bodyXoutput = document.getElementById("bodyX_demo");
bodyXoutput.innerHTML = bodyX.value;
    
bodyX.oninput = function() {
  bodyXoutput.innerHTML = this.value;
    
    document.getElementById("body").style.paddingLeft = this.value;
}

var bodyY = document.getElementById("bodyY");
var bodyYoutput = document.getElementById("bodyY_demo");
bodyYoutput.innerHTML = bodyY.value;
    
bodyY.oninput = function() {
  bodyYoutput.innerHTML = this.value;
    
    document.getElementById("body").style.paddingTop = this.value;
}

var bodyfont = document.getElementById("bodyfont");
var bodyfont_output = document.getElementById("bodyfont_demo");
bodyfont_output.innerHTML = bodyfont.value;
    
bodyfont.oninput = function() {
  bodyfont_output.innerHTML = this.value;
    
    document.getElementById("body").style.fontSize = this.value;
}

/* Foot */

var footX = document.getElementById("footX");
var footXoutput = document.getElementById("footX_demo");
footXoutput.innerHTML = footX.value;
    
footX.oninput = function() {
  footXoutput.innerHTML = this.value;
    
    document.getElementById("foot").style.paddingLeft = this.value;
}

var footY = document.getElementById("footY");
var footYoutput = document.getElementById("footY_demo");
footYoutput.innerHTML = footY.value;
    
footY.oninput = function() {
  footYoutput.innerHTML = this.value;
    
    document.getElementById("foot").style.paddingTop = this.value;
}

var footfont = document.getElementById("footfont");
var footfont_output = document.getElementById("footfont_demo");
footfont_output.innerHTML = bodyfont.value;
    
footfont.oninput = function() {
  footfont_output.innerHTML = this.value;
    
    document.getElementById("foot").style.fontSize = this.value;
}

</script>
<?php



create_image();
print "<img src=image.png?".date("U").">";

function  create_image(){
    $im = @imagecreate(100, 120) or die("Cannot Initialize new GD image stream");
    
    
    $bgc = imagecolorallocatealpha($im, 255, 255, 255, 0.5);
    $red = imagecolorallocate($im, 255,   0,   0);
    $bgc1 = imagecolorallocatealpha($im, 155, 255, 255, 0.5);
    $tc  = imagecolorallocate($im, 0, 0, 0);

    //imagefilledrectangle($im, 0, 0, 149, 49, $bgc);
    /* Output an error message */
        
    imagefill($im,50,10,$bgc);
    imagesetthickness($im, 3);
    imagecolortransparent($im, $bgc);
    imagearc($im,  50,  50,  95,  95,  0, 360, $red);
    imagearc($im,  50,  50,  96,  96,  0, 360, $red);
    imagearc($im,  50,  50,  97,  97,  0, 360, $red);
    imagestring($im, 5, 19, 15, "PET WHD", $red);
    imageline($im, 8,  32,  92,  32, $red);
    imagestring($im, 3, 15, 39, date('Y/m/d'), $red);
    imageline($im, 4,  60,  96,  60, $red);
    
    $name = "P.Kinsekalibre";
    
    $name_cnt = strlen($name);


    if($name_cnt == 6){
        $positionY = "25";
        $font      = "3.5";
        
    }elseif($name_cnt == 7){
        $positionY = "24";
        $font      = "3.5";
        
    }elseif($name_cnt == 8){
        $positionY = "23";
        $font      = "3.5";
        
    }elseif($name_cnt == 9){
        $positionY = "21";
        $font      = "3.5";
        
    }elseif($name_cnt == 10){
        $positionY = "17";
        $font      = "3.5";
        
    }elseif($name_cnt == 11){
        $positionY = "18";
        $font      = "2";
        
    }elseif($name_cnt == 12){
        $positionY = "16";
        $font      = "2";
        
    }elseif($name_cnt == 13){
        $positionY = "13";
        $font      = "2";
        
    }elseif($name_cnt > 13){
        $positionY = "10";
        $font      = "2";
        
    }
    
    
    imagestring($im, $font, $positionY, 62, $name, $red);
    
    imagestring($im, 1, 25, 100, "WL-0001-18", $red);
    imagepng($im,"image.png");
    imagedestroy($im);
}

function LoadPNG($imgname)
{
    /* Attempt to open */
    $im = @imagecreatefrompng($imgname);

    /* See if it failed */
    if(!$im)
    {
        /* Create a blank image */
        $im  = imagecreatetruecolor(100, 100);
        $bgc = imagecolorallocatealpha($im, 255, 255, 255, 0.5);
        $red = imagecolorallocate($im, 255,   0,   0);
        $bgc1 = imagecolorallocatealpha($im, 155, 255, 255, 0.5);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        //imagefilledrectangle($im, 0, 0, 149, 49, $bgc);
        /* Output an error message */
        
        imagefill($im,50,10,$bgc);
        imagesetthickness($im, 3);
        imagecolortransparent($im, $bgc);
        imagearc($im,  50,  50,  95,  95,  0, 360, $red);
        imagearc($im,  50,  50,  95,  95,  0, 360, $red);
        imagestring($im, 5, 19, 15, "PET MIS", $red);
        imageline($im, 8,  32,  92,  32, $red);
        imagestring($im, 3, 15, 39, date('Y/m/d'), $red);
        imageline($im, 4,  60,  96,  60, $red);
        imagestring($im, 3, 15, 62, $imgname, $red);
    }

    return $im;
}

?>