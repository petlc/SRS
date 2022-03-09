<?php
require_once 'db.connections.php';

$update = new Update();

$update->query("Select pet_id, department from emp_info");
$update->execute();

if($update->resultset() > 0){
    $row      = $update->resultset();
    $rowcount = count($update->resultset());

    for($a=0;$a<$rowcount;$a++){
        $petid     = $row[$a]['pet_id'];
        $dept       = $row[$a]['department'];

        $update->query("Select pet_id from emp_srs where pet_id=:pet_id");
        $update->bind(':pet_id',$petid);
        $update->execute();

        if ($update->rowCount() > 0) {
            // code...
            $update->query("Update emp_srs set department=:position where pet_id=:id");
            $update->bind(':position', $dept);
            $update->bind(':id',$petid);
            if($update->execute() > 0){
                echo $petid." department transfered <br>";
            }else{
                echo $petid." unable to transfer <br>";
            }
        }else{

            $id = substr( $petid, 3, 7);
            $role = "Member";
            $update->query("Insert into emp_srs(srs_id, pet_id, role, department)values(:srs_id, :pet_id, :role, :department)");
            $update->bind(':srs_id',$id);
            $update->bind(':pet_id',$petid);
            $update->bind(':role',$role);
            $update->bind(':department',$dept);
            if($update->execute() > 0){
                echo $petid." Insert Member done <br>";
            }else{
                echo $petid." unable to insert <br>";
            }

        }

    }

}

?>
