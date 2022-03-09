<?php
ini_set('max_execution_time', 900);
include '../function/core.php';

$get_req = new Report();

$get_req->query("Select ic_id, received_by, assigned_to, checker from srvcrqst where assigned_to != ' '");
$get_req->execute();

if ($get_req->rowCount() > 0) {
    // code...
    $row = $get_req->resultset();

    foreach ($row as $key => $value) {
        // code...
        $checker        = $value['checker'];
        $assignee       = $value['assigned_to'];
        $id             = $value['ic_id'];
        $received_by    = $value['received_by'];

        $new_name       = "admin.$assignee";
        $new_chckr      = "admin.$checker";
        $new_received   = "admin.$received_by";
        if (strpos($assignee, 'admin.') !== false) {

            echo "meron na <br>";
        }else{
            $get_req->query("Update srvcrqst set assigned_to = '$new_name' where ic_id = '$id'");
            $get_req->execute();

            echo "admin.$assignee <br>";
        }

        if (strpos($checker, 'admin.') !== false) {

            echo "meron na <br>";
        }else{
            $get_req->query("Update srvcrqst set checker = '$new_chckr' where ic_id = '$id'");
            $get_req->execute();

            echo "admin.$checker <br>";
        }

        if (strpos($received_by, 'admin.') !== false) {

            echo "meron na <br>";
        }else{
            $get_req->query("Update srvcrqst set received_by = '$new_received' where ic_id = '$id'");
            $get_req->execute();

            echo "admin.$received_by <br>";
        }

    }
}

?>
