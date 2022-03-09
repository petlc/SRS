<?php
require_once 'db.connections.php';

$closed_null = new Update();

$closed_null->query("Select * from srvcrqst where done_date ='1970-01-01 08:00:00'");
$closed_null->execute();

echo $closed_null->rowCount();


if($closed_null->rowCount() > 0){
    $row=$closed_null->resultset();
    /*
    while($row=$closed_null->resultset()){
        $this->ic_id = $row['ic_id'];
        
        $result_info .= $this->ic_id;
    }
    */
    //print_r($row);
    foreach($row as $rows){
        echo $rows['ic_id']." ". $rows['assigned_date']."<br>";
        
        $update_closed = new Update();
        
        $update_closed->query("Update srvcrqst set done_date=:done_date where ic_id=:ic_id");
        $update_closed->bind(':done_date', $rows['acknowledged_date']);
        $update_closed->bind(':ic_id', $rows['ic_id']);
        $update_closed->execute();
        
    }
    
}




?>