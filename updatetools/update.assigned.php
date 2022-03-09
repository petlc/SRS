<?php
require_once 'db.connections.php';

$assigned = new Update();

$assigned->query("select * from srvcrqst where assigned_date = '0000-00-00 00:00:00'");
$assigned->execute();

foreach($assigned->resultset() as $row){
    
    $assigned_date = $row['ic_crtd_date'];
    $ic_no         = $row['ic_no'];
    
    $assigned->query("Update srvcrqst set assigned_date='$assigned_date' where ic_no='$ic_no'");
    $assigned->execute();
    
    
}

echo $assigned->rowCount();



?>
