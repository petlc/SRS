<?php

function memberHO(){
    $ho_member = new Employees();

    $ho_member->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info Inner JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id INNER join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.department = 'MIS' and emp_info.branch = 'MNL'");
    $ho_member->execute();

    $name = "";

    if($ho_member->rowCount() > 0){
        $ho_mem   = $ho_member->resultset();
        $ho_count = $ho_member->rowCount();

        for ($i=0; $i < $ho_count; $i++) {
            // code...
            //$name .= $ho_mem[$i]['full_name'];

            $name .= "<option value='".$ho_mem[$i]['full_name']."'>".$ho_mem[$i]['full_name']."</option>";
        }

        echo $name;

    }
}

function memberBO(){
    $ho_member = new Employees();

    $ho_member->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info Inner JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id INNER join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.department = 'MIS' and emp_info.branch = 'ILO' ");
    $ho_member->execute();

    $name = "";

    if($ho_member->rowCount() > 0){
        $ho_mem   = $ho_member->resultset();
        $ho_count = $ho_member->rowCount();

        for ($i=0; $i < $ho_count; $i++) {
            // code...
            //$name .= $ho_mem[$i]['full_name'];

            $name .= "<option value='".$ho_mem[$i]['full_name']."'>".$ho_mem[$i]['full_name']."</option>";
        }

        echo $name;

    }
}


?>
