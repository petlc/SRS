<?php
require_once 'function/core.php';
include 'PHPExcel/IOFactory.php';

if(isset($_POST['update_role'])){
    if (!empty($_FILES['role'])) {

        $file_name  =   $_FILES['role']['name'];
        $file_tmp   =   $_FILES['role']['tmp_name'];

        $date_registered    = date('Y-m-d');

        $inputFileType = PHPExcel_IOFactory::identify($file_tmp);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($file_tmp);

        $data   =   $objPHPExcel->getSheetNames();

        //print_r($data);

        $sheet = $objPHPExcel->getSheet(0);
        $highestColumn  =   $sheet->getHighestColumn();
        $highestRow     =   $sheet->getHighestRow();

        //print_r($highestColumn);

        $workingsheet   =   $objPHPExcel->setActiveSheetIndex(0)->calculateWorksheetDimension();

        //echo $workingsheet;

        $data = array(1,$objPHPExcel->getActiveSheet()->rangeToArray($workingsheet));
        $row = count($data[1]);
        echo $row."<br>";
        $xlsdata = array();
        if($data[0]==1){

            $xlsdata = $data[1];

            for($a=0;$a < $row;$a++){
                if($a > 6){
                    if (!empty($xlsdata[$a][1])) {
                        // code...

                        if (strlen($xlsdata[$a][1]) <= 4) {
                            // code...
                            $idNo       = sprintf("%04d",$xlsdata[$a][1]);
                            $petid     = "pet".$idNo;
                        }else{
                            $petid = $xlsdata[$a][1];
                        }

                        if (empty($xlsdata[$a][3])) {
                            // code...
                            $role  = $xlsdata[$a][7];
                            $email = $xlsdata[$a][8];
                            $dept  = $xlsdata[$a][9];
                        }else{
                            $role  = $xlsdata[$a][3];
                            $email = $xlsdata[$a][4];
                            $dept  = $xlsdata[$a][5];
                        }

                        $role_result = UpdateRole($petid, $role, $dept);
                        $email_result = updateEmail($petid, $role, $dept, $email);

                        if ($role_result == "Account is not Available") {
                            // code...
                            $results = $role_result;
                        }else{
                            $results = $role_result.", ".$email_result;
                        }

                        echo $petid." ".$role." ".$dept." ".$results." <br>";


                    }else{
                        break;
                    }

                }
            }
        }
    }
}


function UpdateRole($petid, $new_role, $dept){

    $check_role = new Employees();

    $check_role->query("Select * from emp_srs where pet_id=:pet_id");
    $check_role->bind(":pet_id",$petid);
    $check_role->execute();

    if ($check_role->rowCount() > 0) {
        // code...
        $row = $check_role->single();
        $pet_id = $row['pet_id'];
        $role   = $row['role'];
        $dprt   = $row['department'];

        if (strpos($dprt, $dept)!== false) {
            // code...

            if($role !== $new_role){
                $update_role = new Employees();
                $update_role->query("Update emp_srs set role=:new_role where pet_id=:pet_id");
                $update_role->bind(':pet_id',$pet_id);
                $update_role->bind(':new_role',$new_role);
                $update_role->execute();

                $result = "New Role is set";

            }else{

                $result = "Already Added";
            }

        }else{

            $new_dprt = $dprt.", ".$dept;

            $add_dept = new Employees();
            $add_dept->query("Update emp_srs set department=:department, role=:new_role where pet_id=:pet_id");
            $add_dept->bind(':department', $new_dprt);
            $add_dept->bind(':pet_id',$pet_id);
            $add_dept->bind(':new_role',$new_role);
            $add_dept->execute();

            if ($add_dept->execute() > 0) {
                // code...
                $result = "Done Newly Added department";
            }else{
                $result = "Problem Occured";
            }
        }

    }else{
        
        $result = "Account is not Available";
    }

    return $result;

}

function updateEmail($petid, $new_role, $dept, $email){

    $check_email = new Employees();

    $check_email->query("Select * from emp_email where email_account=:email_account ");
    $check_email->bind('email_account',$email);
    $check_email->execute();

    if ($check_email->rowCount() > 0) {
        // code...
        $row_email      = $check_email->single();
        $email_id       = $row_email['email_id'];
        $email_pet_id   = $row_email['email_pet_id'];
        $email          = $row_email['email_account'];

        if (strpos($email_pet_id, $petid)!== false) {
            $result = "Already Added email handler";
        }else{
            $new_handler = $email_pet_id.", ".$petid;
            $add_email_handler = new Employees();
            $add_email_handler->query("Update emp_email set email_pet_id=:email_pet_id where email_account=:email_account");
            $add_email_handler->bind('email_pet_id',$new_handler);
            $add_email_handler->bind('email_account',$email);
            $add_email_handler->execute();

            if ($add_email_handler->execute() > 0) {
                // code...
                $result = "Done Additional handler";
            }else{
                $result = "Problem Occured";
            }
        }


    }else{
        $result = "Email is not Available";
    }

    return $result;
}


?>
