<?php

//echo $fullname;

function misAdmins(){
    $mis_query = new Employees();
    $accounts = '';
    $mis_query->query("Select emp_info.id, emp_info.position, emp_info.full_name, emp_info.department from emp_info where emp_info.department='MIS'");
    $mis_query->execute();
    if($mis_query->rowCount() > 0){
        $row = $mis_query->resultset();
        foreach ($row as $key => $value) {
            // code...
            $admin = $value['full_name'];
            //$value['full_name']."<br>";
            $accounts .= "<option value='".$value['full_name']."'>".$admin."</option>";
        }
    }
    return $accounts;
}


function petAccounts(){
    $pet_query = new Employees();
    $accounts = '';
    $pet_query->query("Select emp_info.id, emp_info.position, emp_info.full_name, emp_srs.role, emp_info.department from emp_info LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id ");
    $pet_query->execute();
    if($pet_query->rowCount() > 0){
        $row = $pet_query->resultset();
        foreach ($row as $key => $value) {
            // code...
            //$value['full_name']."<br>";
            $accounts .= "<option value='".$value['full_name']."'>".$value['full_name']."</option>";
        }
    }

    return $accounts;
}


if (isset($_POST['login_as_mis'])) {
    // code...
    $name = $_POST['loginas'];
    $account_query = new Employees();
    //echo  $_POST['loginas'];
    $account_query->query("Select emp_info.pet_id, emp_info.position, emp_info.full_name, emp_info.department from emp_info where emp_info.full_name=:name");
    $account_query->bind(':name', $name);
    $account_query->execute();

    if ($account_query->rowCount() > 0) {
        // code...
        $emp_info = $account_query->single();
        //$_SESSION['login_user']     = $username;
        //$_SESSION['login_pass']     = $password;
        $_SESSION['fullname']       = $emp_info['full_name'];
        $_SESSION['department']     = $emp_info['department'];
        $_SESSION['position']       = $emp_info['position'];
        
        $username                   = $emp_info['pet_id'];
        $fullname                   = $emp_info['full_name'];
        $department                 = $emp_info['department'];
        $position                   = $emp_info['position'];
        
        $employee_query = new Employees();
        $employee_query->query("Select role from emp_srs where pet_id=:pet_id");
        $employee_query->bind(':pet_id', $username);
        $employee_query->execute();
                        
        $row = $employee_query->single();
                        
        
        $_SESSION['role']           = $row['role'];

        
        $role           = $row['role'];

        //echo $fullname;
    }
}

if (isset($_POST['login_as_pet'])) {
    // code...
    $name = $_POST['loginas'];
    $account_query = new Employees();
    //echo  $_POST['loginas'];
    $names = explode(' - ',$name);

    /*
    $account_query->query("SELECT emp_info.full_name, emp_info.department, emp_info.position, emp_srs.pet_id, GROUP_CONCAT(emp_srs.role) as role 
                FROM emp_srs left join emp_info on emp_srs.pet_id = emp_info.pet_id 
                where emp_info.full_name=:name");
                */
    
    $account_query->query("Select emp_info.id, emp_info.position, emp_info.full_name, emp_srs.role, emp_info.department from emp_info LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_info.full_name=:name");
    $account_query->bind(':name', $names[0]);
    $account_query->execute();

    if ($account_query->rowCount() > 0) {
        // code...
        $emp_info = $account_query->single();


        //$_SESSION['login_user']     = $username;
        //$_SESSION['login_pass']     = $password;
        $_SESSION['fullname']       = $emp_info['full_name'];
        $_SESSION['department']     = $emp_info['department'];
        $_SESSION['position']       = $emp_info['position'];
        $_SESSION['role']           = $emp_info['role'];

        $fullname        = $emp_info['full_name'];
        $department     = $emp_info['department'];
        $position       = $emp_info['position'];
        $role           = $emp_info['role'];

    }
}

/*
$user_check     = $_SESSION['login_user'];
$sam            = $_SESSION['login_user'];
//$pass_check     = $_SESSION['login_pass'];
$fullname       = $_SESSION['fullname'];
$firstname      = $_SESSION['firstname'];
$middlename     = $_SESSION['middlename'];
$lastname       = $_SESSION['lastname'];
$department     = $_SESSION['department'];
$position       = $_SESSION['position'];
$role           = $_SESSION['role'];
$id             = $_SESSION['id'] ;
$account_stat   = $_SESSION['account_status'];
*/

if ($sam == "pet1666-admin" || $sam == "pet1886-admin") {
    // code...
    ?>

    <div class="col-md-12">
        <form class="form-control" method="post">
            <div class="row">
                <div class="col-md-5">
                    <select class="form-control" name="loginas">
                        <option value=""></option>
                        <?php
                            $mis_accounts = misAdmins();
                            print_r($mis_accounts);
                         ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" name="login_as_mis" class="btn btn-success">Login AS</button>
                </div>
            </div>
        </form>
    </div>
    <?php
}elseif ($sam == "pet1666" || $sam == "pet1886") {
    // code...
    ?>
    <div class="col-md-12">
        <form class="form-control" method="post">
            <div class="row">
                <div class="col-5">
                    <input type="text" name="loginas" value="" class="form-control loginas">
                </div>
                <div class="col-5">
                    <button type="submit" name="login_as_pet" class="btn btn-success">Login AS</button>
                </div>
            </div>
            <!---
            <select class="" name="loginas">
                <option value=""></option>
                <?php
                    $pet_accounts = petAccounts();
                    print_r($pet_accounts);
                 ?>
            </select>
            -->
        </form>
    </div>
<?php
}


 ?>
