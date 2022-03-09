<?php
/*
require_once 'db.connections.php';

$get_info = new Update();

$get_info->query("Select id, first_name, middle_initial, last_name, department from employees where id='1666'");
$get_info->execute();

if($get_info->single() > 0){
    $emp_dtls = $get_info->single();
    
    //print_r($emp_dtls);
    
    $id     = $emp_dtls['id'];
    $f_name = $emp_dtls['first_name'];
    $l_name = $emp_dtls['last_name'];
    $dept   = $emp_dtls['department'];
    
    $f_init = $f_name[0].".".$l_name;
}
*/                      
require_once 'restriction.php';

    $id     = $id;
    $f_name = $firstname;
    $l_name = $lastname;
    $dept   = $department;
    
    $f_init = $f_name[0].".".$l_name;

if(isset($_POST['generate_stamp'])){
    
    $name       = $_POST['emp_name'];
    $emp_id     = $_POST['emp_id'];
    $emp_dept   = $_POST['emp_dept'];
    $crtd_date  = $_POST['crtd_date'];
    $docu_name  = $_POST['docu_name'];
    
    $table      = "ds_".date("Y");
    
    $regi_stamp = new Update();
    
    $regi_stamp->query("Insert into $table (ds_crtr, ds_crtr_id, ds_crtr_dept, ds_crtd_date, ds_docu_name)Values(:ds_crtr, :ds_crtr_id, :ds_crtr_dept, :ds_crtd_date, :ds_docu_name)");
    $regi_stamp->bind(":ds_crtr",$name);
    $regi_stamp->bind(":ds_crtr_id",$emp_id);
    $regi_stamp->bind(":ds_crtr_dept",$emp_dept);
    $regi_stamp->bind(":ds_crtd_date",$crtd_date);
    $regi_stamp->bind(":ds_docu_name",$docu_name);
    $regi_stamp->execute();
    
    $ds_id   = $regi_stamp->lastInsertId();
    $autoinc = sprintf("%04d",$ds_id);
    $ds_no   = "DS-".$autoinc.date("-".'y');
    
    $regi_stamp->query("Update $table set ds_no = :ds_no where ds_id=:ds_id");
    $regi_stamp->bind(":ds_no",$ds_no);
    $regi_stamp->bind(":ds_id",$ds_id);
    $regi_stamp->execute();
    
    echo createImage($name, $emp_dept, $crtd_date, $ds_no);
print "<img src=image.png?".date("U").">";

    
}
function  createImage($name, $emp_dept, $crtd_date, $ds_no){
        
        $dept = substr($emp_dept, 0, 3);
    
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
        imagestring($im, 5, 19, 15, "PET ".$dept, $red);
        imageline($im, 8,  32,  92,  32, $red);
        imagestring($im, 3, 15, 39, $crtd_date, $red);
        imageline($im, 4,  60,  96,  60, $red);

        

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

        imagestring($im, 1, 25, 100, $ds_no, $red);
        imagepng($im,"image.png");
        imagedestroy($im);
    }
?>

<form method="post">

    <input name="emp_name" value="<?php echo $f_init; ?>">
    <input name="emp_id" value="<?php echo $id; ?>">
    <input name="emp_dept" value="<?php echo $dept; ?>">
    <input name="crtd_date" value="<?php echo date("Y-m-d") ?>">
    <input name="docu_name" value="" required>
    <button type="submit" name="generate_stamp">Generate Stamp</button>
</form>