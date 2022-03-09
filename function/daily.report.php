<?php

    /** PHPExcel */
    include '../PHPExcel.php';

    /** PHPExcel_Writer_Excel2007 */
    include '../PHPExcel/Writer/Excel2007.php';

    // Create new PHPExcel object
    //echo date('H:i:s') . " Create new PHPExcel object\n";
    $objPHPExcel = new PHPExcel();

    require_once 'core.php';
    $generate = new Report();

    $date_now = date('Y-m-d');

    $generate->query("Select prcss_no, ic_rqstr, ic_rqst_date, assigned_to, ic_dtls, ic_status from srvcrqst where ic_status not in ('Done', 'Closed', 'Cancelled', 'Cancelled by User', 'Rejected') and '$date_now'>ic_rqst_date and '$date_now'> ic_crtd_date");
    $generate->execute();

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
    $rowCount = $generate->rowCount();
    $info = $generate->resultset();


    for($a=0;$a<$rowCount;$a++){
        //echo $info[$a]['prcss_no']."<br>";
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
    $row++;
    //echo $rowCount;
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $date = date('m-d-Y');
    $file = "../generated report/Pending for ".$date.".php";
    //echo $file;
    $objWriter->save(str_replace('.php', '.xlsx', $file));
    $filename = str_replace('.php', '.xlsx', $file);
    $filerename = str_replace('..', 'http://10.49.1.242:8012/SRS', $filename);

    $get_email = new Employees();

    $get_email->query("Select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_email.email_account From emp_info Inner JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id INNER join emp_email on emp_info.pet_id = emp_email.email_pet_id where emp_info.department = 'MIS' ");
    $get_email->execute();

    $emailCount = $get_email->rowCount();
    $emails     = $get_email->resultset();

    $email_info = "";

    for($e=0;$e<$emailCount;$e++){
        $email_info .= $emails[$e]['email_account']."; ";

        //echo $emails[$e]['email'];
    }
    //echo $email_info;
    //print_r($email_info);

    $mis_email = "smb_mis.pet@ph.yazaki.com";

            $to      = $email_info;
            $subject = '[SRS]Daily Pending Reminders';
            $message = '<html>
                        <head>
                        </head>
                        <body>
                        <b>ATTN:</b> MIS<br>
                        <br>
                        This is to remind members to update the progress of open Service Requests.<br>
                        <br>
                        <b> -  Close the ticket if the request is completed.</b><br>
                        <b> -  Record the new date of deadline on the worklog of each request if the End user agreed with this.</b><br>
                        <b> -  Record change of in-charge in case you will endorse it.</b><br>
                        <b> -  Record actions done / actions to be done on the worklog for Service Desks reference.</b><br>
                        <br>
                        Click this <a href="'.$filerename.'">Report for today </a> for reference.
                        <br>
                        <br>
                        Thank you,<br>
                        <b>S</b>ervice <b>R</b>equest <b>S</b>ystem
                        </body>
                        </html>';

                     $headers='Content-type: text/html; charset=iso-8859-1' . "\r\n".
                     "from: smb_mis.pet@ph.yazaki.com"."\n". //creating headers
                     "reply-to: smb_mis.pet@ph.yazaki.com"."\n". //creating headers
                     "X-Priority: 1\n". //headers for priority
                     "Priority: Urgent\n". //headers for priority
                     "Importance: high";
                    mail($to, $subject, $message, $headers);

?>
