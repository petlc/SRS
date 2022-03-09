<?php

/** PHPExcel */
include '../PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include '../PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

require_once 'db.connections.php';
//$generate = new Report();

include '../PHPMailer/class.PHPMailer.php';
    //require("class.PHPMailer.php");

    //

$get_emp        = new Employees();

$get_emp->query("
select emp_info.full_name, emp_info.pet_id, emp_email.email_account From emp_info 
LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id LEFT JOIN emp_email on emp_info.pet_id = emp_email.email_pet_id  
where emp_srs.department like '%MIS' and emp_srs.role in ('Checker', 'Approver')
");
$get_emp->execute();

$email_cc = "";
foreach($get_emp->resultSet() as $emp_cc){
    $email_cc .= $emp_cc['email_account'].";";

}


$get_emp->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info 
LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id LEFT JOIN emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.pet_id LIKE '%-admin%'");
$get_emp->execute();

$mis_emp = array();
foreach($get_emp->resultSet() as $emp){

    $name   = $emp['full_name'];
    $email  = $emp['email_account'];
    
    Generate($name,$email,$email_cc);


}


function Generate($name,$email,$email_cc){
    
    $objPHPExcel = new PHPExcel();

    $generate        = new Update();

    $date_now = date('Y-m-d');

    $generate->query("Select prcss_no, ic_rqstr, ic_rqst_date, assigned_to, ic_dtls, ic_status from srvcrqst where ic_status not in ('Done', 'Closed', 'Cancelled', 'Cancelled by User', 'Rejected') and assigned_to='$name' and in_charge='$name' and '$date_now'>ic_rqst_date and '$date_now'> ic_crtd_date ");
    $generate->execute();

    $rowCount = $generate->rowCount();
    $info = $generate->resultset();

    if($rowCount > 0){
        //echo $name."<br>";
        $row = 1; // 1-based index
        $col = 0;
        $style = array('font' => array('size' => 12,'bold' => true),
                       'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF66')),
                       'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                    );
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);

        $header = array("Control No", "Requested by", "Date Needed", "MIS in Charge", "Details", "Status", "Remarks");
        foreach($header as $headername){
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $headername);
            $col++;
        }


        $row++;
        for($a=0;$a<$rowCount;$a++){

            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $info[$a]['prcss_no']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $info[$a]['ic_rqstr']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $info[$a]['ic_rqst_date']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $info[$a]['assigned_to']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $info[$a]['ic_dtls']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $info[$a]['ic_status']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Delay");
            $row++;

        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $date = date('m-d-Y');
        $file = "../generated report/Pending ".$name." ".$date.".php";
        $filename = str_replace('.php', '.xlsx', $file);
        $objWriter->save(str_replace('.php', '.xlsx', $file));

        $name = explode(" ",$name);
        
        $mail = new PHPMailer();

        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = "10.194.23.193";  // specify main and backup server
        $mail->SMTPAuth = false;     // turn on SMTP authentication

        $emails_cc = explode(";",$email_cc);

        $mail->From = "smb_srs.pet@ph.yazaki.com";
        $mail->FromName = "[SRS Reminder]";
        $mail->AddAddress($email);
        
        foreach($emails_cc as $e_cc){
            $mail->addCC($e_cc);
        }
        /*
        $mail->addCC("willem.leonardo@ph.yazaki.com");
        $mail->addCC("aaron.sarreal@ph.yazaki.com");
        */
        $mail->AddReplyTo("smb_srs.pet@ph.yazaki.com", "Information");

        $mail->WordWrap = 50;                                       // set word wrap to 50 characters
        $mail->AddAttachment($filename);                            // add attachments
        $mail->IsHTML(true);                                        // set email format to HTML


        $mail->Subject = "[SRS] Pending for ".$name[0]." ".date("H:i");
        $mail->Body    = "Hello ".$name[0].",<br>
                            <br>
                            Please see attached file for the list of your pending assigned request as of ".date("Y-m-d H:i")."<br>
                            <br>Thank you,<br>
                        <b>S</b>ervice <b>R</b>equest <b>S</b>ystem";
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

        if(!$mail->Send()){
           return "Message could not be sent.";
           return "Mailer Error: " . $mail->ErrorInfo;
           exit;
        }

        //echo "Message has been sent";
    }
}

function sendReminders($name,$file){}



?>
