<?php

$status_list    = array('Newly Created', 'Not Approve', 'For Checking', 'For Approval', 'New Request', 'Assigned', 'Work in Progress', 'Done', 'MIS Checker', 'Closed', 'Cancelled');

$status_no      = count($status_list);

$process_list   = array("CSR", "CPR", "DRR", "QA");
$process_no     = count($process_list);

for($i=0;$i<$status_no;$i++){
    $status_info = explode(",",$status_list[$i]);
    $requestStats = new requestStatus();
    $requestStats->status($status_info[0]);
    $status_list[$status_info[0]] = $requestStats->queryno;
    //echo $status_info[0];

    for($a=0;$a<$process_no;$a++){
        $process_info = explode(",",$process_list[$a]);

        $endorseStatus = new requestStatus();

        $endorseStatus->ahead($status_info[0],$process_info[0]);

        $process_list[$status_info[0].$process_info[0]."ahead"]=$endorseStatus->queryno;

        $endorseStatus->ontime($status_info[0],$process_info[0]);

        $process_list[$status_info[0].$process_info[0]."ontime"]=$endorseStatus->queryno;

        $endorseStatus->delay($status_info[0],$process_info[0]);

        $process_list[$status_info[0].$process_info[0]."delay"]=$endorseStatus->queryno;


    }
}

$newRequest    = $status_list["New Request"];


$endorseStatus = new endorsedRequest();
$endorseStatus->status("Assigned", $fullname);
$my_assigned   = $endorseStatus->queryno;

$endorseStatus->status("Work in Progress", $fullname);
$my_WiP        = $endorseStatus->queryno;

$endorseStatus->status("Done", $fullname);
$my_done   = $endorseStatus->queryno;

$endorseStatus->misChecker("Endorse to Checker", $fullname);
$my_Checking   = $endorseStatus->queryno;

$endorseStatus->misChecker("Endorse to Approver", $fullname);
$my_Approval  = $endorseStatus->queryno;

$endorseStatus->forChecking("For Checking", $fullname);
$for_Checking   = $endorseStatus->queryno;

$endorseStatus->forApproval("For Approval", $fullname);
$for_Approval   = $endorseStatus->queryno;
/*
echo $status_list["New Request"]."<br>";
echo $process_list["New RequestCSRahead"]."<br>";
echo $process_list["New RequestCSRontime"]."<br>";
echo $process_list["New RequestCSRdelay"]."<br>";

*/


$query = "Select assigned_to, COUNT(*) from srvcrqst where assigned_to != '' and ic_status in ('Assigned', 'Work in Progress') group by assigned_to ";
$monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->execute();
     
    $members = $monthly_check->resultset();
    //echo "<pre>";
    //print_r($members);
?>
