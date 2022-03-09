<?php

include '../function/core.php';

$get_info = new Report();

$get_dtls = new Employees();

$get_info->query("Select ic_rqstr from srvcrqst where ic_rqstr_id = '' ");
$get_info->execute();


if ($get_info->rowCount() > 0) {
    // code...
    $row = $get_info->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_rqstr']." ";

        $fullname = $value['ic_rqstr'];

        $get_info->query("Select ic_rqstr_id from srvcrqst where ic_rqstr like '%$fullname%' and ic_rqstr_id != '' ");
        $get_info->execute();

        if ($get_info->rowCount() > 0) {
            // code...
            $emp_row = $get_info->resultset();

            foreach ($emp_row as $key => $val) {
                // code...

                echo $val['ic_rqstr_id']."<br>";

                $id = $val['ic_rqstr_id'];

                $get_info->query("Update srvcrqst set ic_rqstr_id = '$id' where ic_rqstr_id = '' and ic_rqstr like '%$fullname%'");
                $get_info->execute();
            }

        }else{

            echo " wala <br>";
        }
    }
}


 ?>
