<?php

require_once 'core.php';
ini_set('max_execution_time', 300);
$get_done = new Report();

$get_done->query("SELECT * FROM srvcrqst where ic_status = 'Done' and user_approval = '' and prcss_no not LIKE '%QA%'");
//$get_done->query("Select * from srvcrqst where ic_no = 'IC-1184-18'");
$get_done->execute();

if ($get_done->rowCount() > 0) {
    // code...
    $row        = $get_done->resultset();
    $rows_count = count($row);

    for ($a=0; $a < $rows_count; $a++) {
        // code...
        echo $row[$a]['ic_rqstr']." ".$row[$a]['ic_rqstr_id']." ".$row[$a]['ic_no']." ";

        $requestor  = $row[$a]['ic_rqstr'];
        $petid      = $row[$a]['ic_rqstr_id'];
        $department = $row[$a]['ic_rqstr_dprtmnt'];
        $personnel  = $row[$a]['assigned_to'];
        $ic_no      = $row[$a]['ic_no'];
        $prcss_no   = $row[$a]['prcss_no'];
        $status     = $row[$a]['ic_status'];


        $get_email = new Employees();

        $get_email->query("Select email_account from emp_email where email_pet_id like '%$petid%'");
        $get_email->execute();

        if ($get_email->rowCount() > 0) {
            // code...
            $email_info = $get_email->single();

            echo $email_info['email_account']."<br>";

            $requestor_email = $email_info['email_account'];

            $to      = $requestor_email;
            $subject = 'Follow up '.$prcss_no." ".$status;
            $message = '<html>
                        <head>
                        </head>
                        <body>
                        Hello '.$requestor.'<br>
                        <br>
                        Good day,<br>
                        <br>
                        We would like follow up verification of your done request by '.$personnel.' of MIS is now done with reference no. <a href="10.49.1.242:8012/srs/view.php?ic='.$ic_no.'">'.$ic_no.'</a>. <br>
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
                echo"<script>
                        alert('Sent email to ".$requestor." for verification');
                    </script>";
                */

                echo "Sent email to $requestor for verification $ic_no<br>";
            } else { 
                /*
                echo"<script>
                        alert('Email not sent');
                    </script>";
                */
                echo "Email not sent $ic_no<br>";
            }


        }elseif(!empty($row[$a]['ic_checker'])){

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
                $chckr  =   $emailr['full_name'];
                $requestor_email = $emailr['email_account'];

                if (empty($emailr['email_account'])) {
                    // code...
                    echo NotifyPersonnel($personnel, $ic_no, $prcss_no, $status);
                }else{
                    //echo $emailr['email_account'];

                    $to      = $requestor_email;
                    $subject = 'Follow up '.$prcss_no." ".$status;
                    $message = '<html>
                                <head>
                                </head>
                                <body>
                                Hello '.$chckr.'<br>
                                <br>
                                Good day,<br>
                                <br>
                                We would like ask your assistance to follow up your member '.$requestor.' to complete or have feedback to his/her request that resolved by '.$personnel.' of MIS with reference no. <a href="10.49.1.242:8012/srs/view.php?ic='.$ic_no.'">'.$prcss_no.'</a>. <br>
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
                        echo"<script>
                                alert('Sent email to ".$requestor." Checker for follow up and verification');
                            </script>";
                        */
                        echo "Sent email to $requestor Checker for follow up and verification<br>";
                    }else{
                        /*
                        echo"<script>
                                alert('Email not sent');
                            </script>";
                        */
                        echo "Email not sent $ic_no<br>";
                    }

                }
            }
        }else{

            echo NotifyPersonnel($personnel, $ic_no, $prcss_no, $status);
            echo "<br>";
        }

    }

}else{

}



function NotifyPersonnel($personnel, $ic_no, $prcss_no, $status){

    $personnel = str_replace('admin.','',$personnel);

    $personnel_email = new Employees();

    $personnel_email->query("select emp_info.full_name, emp_info.pet_id, emp_email.email_account, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.full_name = '$personnel' ");
    $personnel_email->execute();

    //return $personnel_email->rowCount();

    if ($personnel_email->rowCount() > 0) {
        // code....
        $prsnnl_info = $personnel_email->single();

        $prsnnl_email = $prsnnl_info['email_account'];

    }

    $to      = $prsnnl_email;
    $subject = 'Follow up '.$prcss_no." ".$status;
    $message = '<html>
                <head>
                </head>
                <body>
                Hello '.$personnel.'<br>
                <br>
                Good day,<br>
                <br>
                The requestor of this request <a href="10.49.1.242:8012/srs/view.php?ic='.$ic_no.'">'.$prcss_no.'</a> do not have email to notify please call them on their local to request confirmation of their done request. <br>
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
        return "Sent email to $personnel for verification<br>";
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
