<?php
require_once 'db.connections.php';

$closed_null = new Update();

$closed_null->query("Select * from srvcrqst");
$closed_null->execute();

echo $closed_null->rowCount()."<br>";


if($closed_null->rowCount() > 0){
    $row=$closed_null->resultset();
    
    foreach($row as $rows){
    
    echo $rows['ic_id']." ".$rows['ic_no'].$rows['prcss_no']."<br>";
        
        $id = $rows['ic_id'];
        $ic = $rows['ic_no'];
        $pr = $rows['prcss_no'];
        
        $closed_null->query("insert into ic_2017 set srvc_rqst_id=:id, ic_no=:ic_no, prcss_no=:prcss_no ");
        $closed_null->bind(':id', $id);
        $closed_null->bind(':ic_no',$ic);
        $closed_null->bind(':prcss_no',$pr);
        $closed_null->execute();
    }
    /*
    while($row=$closed_null->resultset()){
        $this->ic_id = $row['ic_id'];
        
        $result_info .= $this->ic_id;
    }
    */
    //print_r($row);
    /*
    foreach($row as $rows){
        echo $rows['done_date']."-".$rows['ic_rqst_date']."<br>";
        
        $acknowledged_date  = $rows['done_date'];
        $done_date          = $rows['ic_rqst_date'];
        
        $date_time_plus_one     = strtotime($acknowledged_date . ' +8 hours');
        $excel_date_request     = floatval(25569 + $date_time_plus_one / 86400);
        $date_time_plus_two     = strtotime($done_date . ' +8 hours');
        $excel_date_done        = floatval(25569 + $date_time_plus_two / 86400);
        $response_time          = floatval(($excel_date_done - $excel_date_request) );
        $manhour                = number_format((float)$response_time, 2, '.', '');
        
        echo $manhour."<br>";
        
        $ic_no = $rows['ic_no'];
        
        $closed_null->query("Update srvcrqst set man_hour=:man_hour where ic_no=:ic_no ");
        $closed_null->bind(':man_hour', $manhour);
        $closed_null->bind(':ic_no',$ic_no);
        $closed_null->execute();
    }
    */
}




?>