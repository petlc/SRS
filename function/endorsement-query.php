<?php

$start=0;
$limit=10;

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $start=($id-1)*$limit;
}else{
    $id=1;
}

if(isset($_GET['endorse'])){
    $status              = $_GET['endorse'];
    $_SESSION['endorse'] = $_GET['endorse'];
}elseif(isset($_SESSION['endorse'])){
    $status             = $_SESSION['endorse'];
}else{
    $status             = "All";
}


switch($status){

        case"Assigned";
        case"Work in Progress";

        $querylist = "Select * from srvcrqst where ic_status ='$status' and assigned_to = '$fullname' and in_charge  = '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status ='$status' and assigned_to = '$fullname' and in_charge  = '$fullname' order by ic_id DESC ";

        break;

        case"Done";

        $querylist = "Select * from srvcrqst where ic_status ='$status' and user_approval IN('Completed', 'Rejected') and assigned_to = '$fullname' and in_charge  = '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status ='$status' and user_approval IN('Completed', 'Rejected') and assigned_to = '$fullname' and in_charge  = '$fullname' order by ic_id DESC ";

        break;

        case"Endorse to Checker";
        case"MIS Checker";
        case"Closed";

        $querylist = "Select * from srvcrqst where ic_status ='Done' and checker = '$fullname' and in_charge  = '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status ='Done' and checker = '$fullname' and in_charge  = '$fullname' order by ic_id DESC ";

        break;

        case"UserApproval";

        $querylist = "Select * from srvcrqst where ic_status ='Done' and user_approval = '' and assigned_to = '$fullname' and in_charge  != '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status ='Done' and user_approval = '' and assigned_to = '$fullname' and in_charge  != '$fullname' order by ic_id DESC ";

        break;

        ############## Not MIS ################################################################################

        case"For Checking";

        $querylist = "Select * from srvcrqst where ic_status ='$status' and ic_checker = '$fullname' and in_charge  = '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status ='$status' and ic_checker = '$fullname' and in_charge  = '$fullname' order by ic_id DESC ";

        break;

        case"For Approval";

        $querylist = "Select * from srvcrqst where ic_status ='$status' and ic_approver = '$fullname' and in_charge  = '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status ='$status' and ic_approver = '$fullname' and in_charge  = '$fullname' order by ic_id DESC ";

        break;

        default;

        $querylist = "Select * from srvcrqst where ic_status IN('Assigned', 'Work in Progress', 'Done') and assigned_to = '$fullname' and in_charge  = '$fullname' order by ic_id DESC LIMIT $start, $limit";

        $querypage = "Select * from srvcrqst where ic_status IN('Assigned', 'Work in Progress', 'Done') and assigned_to = '$fullname' and in_charge  = '$fullname' order by ic_id DESC ";

        break;
}

?>
