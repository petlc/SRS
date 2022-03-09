<?php
require_once '../function/core.php';
ini_set('max_execution_time', 600); //300 seconds = 5 minutes

$incharge = new Report();

/*
$incharge->query("Select ic_no, ic_status, ic_rqstr, ic_checker, ic_approver, assigned_to from srvcrqst where ic_status = 'New Created' ");
$incharge->execute();

echo $incharge->rowCount()." Newly Created <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['ic_rqstr']."<br>";
    }
}
*/

/*
$incharge->query("Select ic_no, ic_status, ic_checker, ic_approver, assigned_to, in_charge from srvcrqst where ic_status = 'For Checking' ");
$incharge->execute();

echo $incharge->rowCount()." Checker <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['in_charge']."<br>";

        $checker = $value['ic_checker'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set in_charge = '$checker' where ic_no = '$ic_no'");
        $incharge->execute();
    }
}
*/

/*
$incharge->query("Select ic_no, ic_status, ic_checker, ic_approver, assigned_to, in_charge from srvcrqst where ic_status = 'For Approval' ");
$incharge->execute();

echo $incharge->rowCount()." Approver <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['ic_approver']." - ". $value['in_charge']."<br>";
        $approver = $value['ic_approver'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set in_charge = '$approver' where ic_no = '$ic_no'");
        $incharge->execute();
    }
}
*/


/*
$incharge->query("Select ic_no, ic_status, ic_checker, ic_approver, assigned_to, in_charge from srvcrqst where ic_status = 'Assigned' ");
$incharge->execute();

echo $incharge->rowCount()." Assigned <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['assigned_to']." - ". $value['in_charge']."<br>";
        $assigned = $value['assigned_to'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set in_charge = '$assigned' where ic_no = '$ic_no'");
        $incharge->execute();


    }
}
*/

/*
$incharge->query("Select ic_no, ic_status, ic_rqstr, ic_checker, ic_approver, assigned_to, in_charge from srvcrqst where ic_status = 'Done' and user_approval =''  ");
$incharge->execute();

echo $incharge->rowCount()." Requestor <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['ic_rqstr']." - ". $value['in_charge']."<br>";

        $rqstr = $value['ic_rqstr'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set in_charge = '$rqstr' where ic_no = '$ic_no'");
        $incharge->execute();
    }
}
*/

/*
$incharge->query("Select ic_no, ic_status, ic_rqstr, ic_checker, ic_approver, assigned_to, in_charge from srvcrqst where ic_status = 'Done' and user_approval !=''  ");
$incharge->execute();

echo $incharge->rowCount()." Done Assigned <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['assigned_to']." - ". $value['in_charge']."<br>";
        $assigned = $value['assigned_to'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set in_charge = '$assigned' where ic_no = '$ic_no'");
        $incharge->execute();
    }
}
*/

/*
$incharge->query("Select ic_no, ic_status, ic_rqstr, ic_checker, ic_approver, assigned_to, in_charge, checker from srvcrqst where ic_status = 'Endorse to Checker' and user_approval !=''  ");
$incharge->execute();

echo $incharge->rowCount()." Done Checker <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['checker']." - ". $value['in_charge']."<br>";
        $checker = $value['checker'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set in_charge = '$checker' where ic_no = '$ic_no'");
        $incharge->execute();

    }
}
*/


$incharge->query("Select ic_no, ic_status, ic_rqstr, ic_checker, ic_approver, assigned_to, in_charge, checker from srvcrqst where ic_status = 'Endorse to Checker' and user_approval !=''  ");
$incharge->execute();

echo $incharge->rowCount()." endorsed to MIS Checker <br>";

if ($incharge->rowCount() > 0) {
    // code...

    $row = $incharge->resultset();

    foreach ($row as $key => $value) {
        // code...

        echo $value['ic_no']." - ". $value['checker']." - ". $value['in_charge']."<br>";
        $checker = $value['checker'];
        $ic_no   = $value['ic_no'];

        $incharge->query("Update srvcrqst set ic_status = 'Done' where ic_no = '$ic_no'");
        $incharge->execute();

    }
}



?>
