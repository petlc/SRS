<?php

$personnel_list = array();

$checker_avail = new Employees();
/*
if ($department == "SCD") {
    // code...
    $checker_query = "select

            emp_info.full_name,
            emp_info.pet_id,
            emp_email.email_account,
            emp_srs.role,
            emp_srs.department
            from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_srs.role ='Checker' and emp_srs.department like '%$department%' Union all select emp_info.full_name, emp_info.pet_id, emp_email.email_account, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_srs.pet_id IN ('pet0226', 'pet0472')";
}else{
    $checker_query = "select emp_info.full_name, emp_info.pet_id, emp_email.email_account, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_srs.role like '%Checker%' and emp_srs.department like '%$department%' ";
}
*/
 $checker_query = "select emp_info.full_name, emp_info.pet_id, emp_email.email_account, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_srs.role = 'Checker' and emp_srs.department = '$department' ";
$checker_avail->query($checker_query);
$checker_avail->execute();

$approver_avail = new Employees();

$approver_avail->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_srs.department = '$department' and emp_srs.role = 'Approver' ");
$approver_avail->execute();

/*

Roles
1 = Member
2 = Checker
3 = Approver

*/

?>
