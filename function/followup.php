<?php

include 'core.php';

$followup = new Report();

$ic_no = "IC-2327-18";

$followup->query("Select * from srvcrqst where ic_no = :ic ");
$followup->bind(':ic',$ic_no);
$followup->execute();

echo $followup->rowCount();

if ($followup->rowCount() > 0) {
    // code...
    $row = $followup->single();

    $status   = $row['ic_status'];
    $approver = $row['ic_approver'];
    $personnel = $row['ic_checker'];
    /*
    foreach ($row as $key => $value) {
        // code...
        $status   = $value['ic_status'];
        $approver = $value['ic_approver'];
    }
    */

    echo $approver;

    if ($status = "For Approval" and !empty($approver)) {
        // code...

        $get_email = new Employees();

        $get_email->query("Select emp_info.full_name, emp_email.email_account from emp_info left join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.full_name = :approver");
        $get_email->bind(':approver',$approver);
        $get_email->execute();

        if ($get_email->rowCount() > 0) {
            // code...
            $email_row = $get_email->single();

            $checker_email = $email_row['email_account'];

            $checker    = array_filter(explode(" ",$approver));

            $to      = $checker_email;
            $subject = 'Service Request '.$ic_no." ".$status;
            $message = '<html>
                        <head>
                        </head>
                        <body>
                        Hello '.$checker[0].'<br>
                        <br>
                        '.$personnel.' endorse this request to you <a href="10.49.1.242:8012/srs/view.php?ic='.$ic_no.'">'.$ic_no.'</a> , For your Approval<br>
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
                    mail($to, $subject, $message, $headers);

            echo"<script>
                    alert('Sent Request to your Approver');
                    window.location.href = 'view.php?ic=".$ic_no."';
                    </script>";
        }




    }
}

 ?>
