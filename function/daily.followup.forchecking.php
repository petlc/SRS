<?php

require_once 'core.php';
ini_set('max_execution_time', 300);
$get_done = new Report();

$get_done->query("SELECT * FROM srvcrqst where ic_status = 'For Checking' and prcss_no not LIKE '%QA%'");
//$get_done->query("Select * from srvcrqst where ic_no = 'IC-1184-18'");
$get_done->execute();

if ($get_done->rowCount() > 0) {
    // code...
    $row        = $get_done->resultset();
    $rows_count = count($row);

    for ($a=0; $a < $rows_count; $a++) {
        // code...
        //echo $row[$a]['prcss_no']." ".$row[$a]['ic_status'];

        $requestor  = $row[$a]['ic_rqstr'];
        $petid      = $row[$a]['ic_rqstr_id'];
        $department = $row[$a]['ic_rqstr_dprtmnt'];
        $personnel  = $row[$a]['assigned_to'];
        $ic_no      = $row[$a]['ic_no'];
        $prcss_no   = $row[$a]['prcss_no'];
        $status     = $row[$a]['ic_status'];

        //$checker    = $row[$a]['ic_checker'];
        $checker = $row[$a]['ic_checker'];

        $get_checker_email = new Employees();

        //$get_checker_email->query("select emp_info.full_name, emp_info.pet_id, emp_email.email_account, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_srs.role ='Checker' and emp_srs.department like '%$department%' ");
        $get_checker_email->query("select emp_info.full_name, emp_info.pet_id, emp_email.email_account, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.full_name = '$checker' ");
        $get_checker_email->execute();

        //echo $get_checker_email->rowCount();

        if ( $get_checker_email->rowCount() > 0) {
            // code...
            $emailr = $get_checker_email->single();
            //echo $emailr['email_account'];
            $checker       = $emailr['full_name'];
            $checker_email = $emailr['email_account'];

            if (!empty($emailr['email_account'])) {
                // code...
                echo $checker." ".$emailr['email_account']."<br>";
                //echo NotifyPersonnel($personnel, $ic_no, $status);
                echo NotifyChecker($checker,$checker_email, $ic_no, $prcss_no, $status);
            }else{
                echo $checker." "."<br>";
            }
        }


    }

}else{

}



function NotifyChecker($checker, $checker_email, $ic_no, $prcss_no, $status){


    $to      = $checker_email;
    $subject = 'Follow up '.$ic_no." ".$status;
    $message = '<html>
                <head>
                </head>
                <body>
                Hello '.$checker.'<br>
                <br>
                Good day,<br>
                <br>
                In behalf of the requestor of this request <a href="10.49.1.242:8012/srs/view.php?ic='.$ic_no.'">'.$ic_no.'</a>, We would like to follow up your decision to this request to proceed to the next step and to meet the date needed. <br>
                <br>
                Thank you,<br>
                Service Request
                </body>
                </html>';

    $headers='Content-type: text/html; charset=iso-8859-1' . "\r\n".
    "from: smb_srs.pet@ph.yazaki.com"."\n". //creating headers
    "reply-to: smb_srs.pet@ph.yazaki.com"."\n". //creating headers
    "X-Priority: 1\n". //headers for priority
    "Priority: Urgent\n". //headers for priority
    "Importance: high";

    if(mail($to, $subject, $message, $headers)){
        /*
        return"<script>
                alert('Sent email to ".$personnel." for verification');
            </script>";
        */
        return "Sent email to $checker for verification<br>";
    }else{
        /*
        return"<script>
                alert('Email not sent');
            </script>";
        */
        return "Email not sent<br>";
    }

}

?>
