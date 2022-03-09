<?php
require_once 'db.connections.php';
/* SAMPLE
$full_name  = "Tropicales, Jan Ruwiltton N.";

$nameparts = explode(" ", $full_name);
$nameprs_count = count($nameparts);

echo $nameprs_count."<br>";
$lastname = array_filter(explode(",",$nameparts[0]));
echo $lastname[0]." ".$nameparts[1];
*/

if(isset($_POST['test'])){
    $tmp_path = $_FILES['file']['tmp_name'];

    $uploads_dir = '../updatetools/';
    $name = basename($_FILES["file"]["name"]);
    move_uploaded_file($tmp_path, "$uploads_dir/$name");

    // Get from cell and to cell from the file name
    $cells = array_filter(explode("-",$name));
    $from = $cells[1];
    $tocells = array_filter(explode(".",$cells[2]));
    $to   = $tocells[0];

    //echo $uploads_dir.$_FILES["file"]["name"]."<br>";
    $inputFileName = $uploads_dir.$_FILES["file"]["name"];
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);

    $data = array(1,$objPHPExcel->getActiveSheet()->rangeToArray($from.':'.$to));
    $row = count($data[1]);
    echo $row."<br>";
    $xlsdata = array();
    if($data[0]==1){
        $xlsdata = $data[1];

        for($a=0;$a < $row;$a++){

            if(empty($xlsdata[$a][0])){

                $dpt            = "EDSD";

            }else{

                if (strpos($xlsdata[$a][0], 'Iloilo')!== false) {
                    // has whitespace
                    $dpt_brnch = array_filter(explode(" ",$xlsdata[$a][0]));

                    $dpt       = $dpt_brnch[0];
                    $brnch     = "ILO";

                }else{
                    $dpt            = $xlsdata[$a][0];
                    $brnch          = "MNL";
                }


            }
            $id             = $xlsdata[$a][1];
            echo $xlsdata[$a][1]." ";
            $petid = "pet".sprintf("%04d",$xlsdata[$a][1]);
            echo $petid." ";

            $position       = $xlsdata[$a][2];

            $lastname       = explode(",",$xlsdata[$a][3]);
            $lastnamecnt    = count($lastname);
            //echo $lastnamecnt." ".$lastname[0]."<br>";
            //echo $lastname[0]."<br>";

            $firstname      = array_filter(explode(" ", $lastname[1]));
            $firstnamecnt   = count($firstname);
            //print_r($firstname);

            //echo $firstnamecnt." ".$firstname[1]."<br>";

            //echo $firstnamecnt;
            switch($firstnamecnt){

                    case"1":

                    $fn = $firstname[1];

                    $mi = "";

                    //echo $fn." ".$lastname[0];

                    break;

                    case"2":

                    $fn = $firstname[1];

                    $mi = $firstname[2];

                    //echo $fn." ".$lastname[0];

                    break;

                    case"3":

                    $fn = $firstname[1]." ".$firstname[2];

                    $mi = $firstname[3];

                    //echo $fn." ".$lastname[0];

                    break;

                    case"4":

                    $fn = $firstname[1]." ".$firstname[2]." ".$firstname[3]." ".$firstname[4];

                    $mi = $firstname[4];

                    //echo $fn." ".$lastname[0];

                    break;
            }

            $ln       = $lastname[0];
            $fullname = $fn." ".$mi." ".$ln;

            echo $fullname;

            $check = new Update();

            $check->query("Select * from emp_info where id=:id");
            $check->bind(':id',$id);
            $check->execute();

            if($check->single() > 0){

                //$db_info = $check->single();
                echo " Registered";

                $update = new Update();

                $update->query("Update emp_info set full_name=:fullname, department =:department, branch =:branch where id=:id");
                $update->bind(':id',$id);
                $update->bind(":fullname", $fullname);
                $update->bind(':department', $dpt);
                $update->bind(':branch', $brnch);
                $update->execute();
                /*
                //$update->bind(':lastcheck', date("Y-m-d"));
                if($update->execute()){
                    echo " last check ".date("Y-m-d");
                }else{
                    echo " problem occured on inputting date";
                }
                */
            }else{
                echo " New";

                $insert = new Update();

                $insert->query("Insert into emp_info(id, pet_id, last_name, first_name, middle_initial, full_name, department, branch, position,date_registered)values(:id, :pet_id, :last_name, :first_name, :middle_initial, :full_name, :department, :branch, :position, :insert_date)");
                $insert->bind(':id',$id);
                $insert->bind(':pet_id',$petid);
                $insert->bind(':last_name', $ln);
                $insert->bind(':first_name', $fn);
                $insert->bind(':middle_initial', $mi);
                $insert->bind(':full_name', $fullname);
                $insert->bind(':department', $dpt);
                $insert->bind(':branch', $brnch);
                $insert->bind(':position', $position);
                $insert->bind(':insert_date', date("Y-m-d"));

                if($insert->execute()){
                    echo " Successfully added";
                }else{
                    echo " problem occured on adding new employee";
                }



            }
            echo "<br>";
        }
    }

}
?>

<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-1">
        </div>
        <div class="col-8">
            <p><b class="text-danger">NOTE 1:</b> Check templete <a href="http://10.49.1.242:8012/SRS/updatetools/">Here</a> with name Headcount</p>
            <p><b class="text-danger">NOTE 2:</b> Upload name should be Headcount-(1st cell number)-(last cell number)</p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-1">
        </div>

        <input class="btn btn-info col-5" type="file" name="file" >

        <div class="col-1">
        </div>

        <input class="btn btn-success col-3" type="submit" name="test" value="Test" />

        <div class="col-2">
        </div>
    </div>
</form>


<form method="post">
    <table>
        <tr>
            <th>

            </th>
        </tr>
        <tr>
            <td>
                <button type="submit" name="generate_report">Get Information</button>
            </td>
        </tr>
    </table>

</form>
