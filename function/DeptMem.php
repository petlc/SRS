<?php


$account_query = new Employees();

$account_query->query("Select emp_info.id, emp_info.pet_id, emp_info.position, emp_info.full_name, emp_info.department from emp_info where emp_info.department='MIS' and emp_info.full_name NOT LIKE '%admin.%'");
$account_query->execute();

$mis_members = $account_query->resultset();
/*
echo "<pre>";

print_r($mis_members);

/*
$account_query->query("Select emp_info.id, emp_info.position, emp_info.full_name, emp_srs.role, emp_info.department from emp_info LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_info.department='MIS' and emp_info.full_name NOT LIKE '%admin.%'");
$account_query->execute();
*/


function getInfo($pet_id)
{

    $get_info = new Employees();
    //echo  $_POST['loginas'];
    $get_info->query("Select 
                    emp_info.pet_id, 
                    emp_info.last_name, 
                    emp_info.first_name, 
                    emp_info.middle_initial, 
                    emp_info.position, 
                    emp_info.full_name, 
                    emp_info.department, 
                    emp_info.branch, 
                    emp_srs.role 
                    FROM emp_info LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_info.pet_id like '%".$pet_id."%'");
    
    $get_info->execute();

    return $get_info->resultset();
}

function addAdmin($data)
{
   /*
    echo "<pre>";
    print_r($_POST);
    */
    $set_info = new Employees();

    $set_info->query('INSERT into emp_info (pet_id, last_name, first_name, middle_initial, full_name, department, branch) VALUES
                        (:pet_id, :last_name, :first_name, :middle_initial, :full_name, :department, :branch)');
    $set_info->bind(':pet_id',$_POST['pet_id']);
    $set_info->bind(':last_name',$_POST['last_name']);
    $set_info->bind(':first_name',$_POST['first_name']);
    $set_info->bind(':middle_initial',$_POST['middle_initial']);
    $set_info->bind(':full_name',$_POST['full_name']);
    $set_info->bind(':department',$_POST['department']);
    $set_info->bind(':branch',$_POST['branch']);
    $set_info->execute();

    $set_info->query('INSERT into emp_srs (pet_id, role, department) VALUES (:pet_id, :role, :department)');
    $set_info->bind(':pet_id',$_POST['pet_id']);
    $set_info->bind(':role',$_POST['role']);
    $set_info->bind(':department',$_POST['department']);
    $set_info->execute();

}

if (!empty($_POST)) {
    # code...

    addAdmin($_POST);

    ?>

    <div class="row mt-5">

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="alert alert-success" role="alert">
                Successfully Registered!
            </div>
        </div>
        <div class="col-md-3"></div>

    </div>
    <?php
}
?>
