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

    $get_emp        = new Employees();

    $get_emp->query("
    select emp_info.full_name, emp_info.pet_id, emp_email.email_account From emp_info 
    LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id LEFT JOIN emp_email on emp_info.pet_id = emp_email.email_pet_id  
    where emp_srs.department like '%MIS' and emp_srs.role in ( 'Checker')
    ");
    $get_emp->execute();
    
    $email_cc = "";
    foreach($get_emp->resultSet() as $emp_cc){
        $email_cc .= $emp_cc['email_account'].";";
    
    }
    
    
    $get_emp->query("
    select emp_info.full_name, emp_info.pet_id, emp_email.email_account From emp_info 
    LEFT JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id LEFT JOIN emp_email on emp_info.pet_id = emp_email.email_pet_id  
    where emp_srs.department like '%MIS' and emp_srs.role in ( 'Approver')");
    $get_emp->execute();
    
    $mis_emp = array();

    $email = "";
    foreach($get_emp->resultSet() as $emp){
    
        $name   = $emp['full_name'];
        $email  .= $emp['email_account'].";";
        
    
    
    }

    Generate($email,$email_cc);


function Generate($email,$email_cc)
{

    
    $objPHPExcel = new PHPExcel();

    echo $email. "<br>";
    echo $email_cc. "<br>";

    echo $_GET['month'] = date('F');
    echo $_GET['year'] = date('Y');
    
    $month = $_GET['month'];
    $year  = $_GET['year'];

    switch ($month) {
        case 'January':
            // code...
            $prev       =  $year - 1;
            $start_date = "$prev-12-16";
            $end_date   = "$year-01-15";
            break;
        case 'February':
            // code...
            $start_date = "$year-01-16";
            $end_date   = "$year-02-15";
            break;
        case 'March':
            // code...
            $start_date = "$year-02-16";
            $end_date   = "$year-03-15";
            break;
        case 'April':
            // code...
            $start_date = "$year-03-16";
            $end_date   = "$year-04-15";
            break;
        case 'May':
            // code...
            $start_date = "$year-04-16";
            $end_date   = "$year-05-15";
            break;
        case 'June':
            // code...
            $start_date = "$year-05-16";
            $end_date   = "$year-06-15";
            break;
        case 'July':
            // code...
            $start_date = "$year-06-16";
            $end_date   = "$year-07-15";
            break;
        case 'August':
            // code...
            $start_date = "$year-07-16";
            $end_date   = "$year-08-15";
            break;
        case 'September':
            // code...
            $start_date = "$year-08-16";
            $end_date   = "$year-09-15";
            break;
        case 'October':
            // code...
            $start_date = "$year-09-16";
            $end_date   = "$year-10-15";
            break;
        case 'November':
            // code...
            $start_date = "$year-10-16";
            $end_date   = "$year-11-15";
            break;
        case 'December':
            // code...
            $start_date = "$year-11-16";
            $end_date   = "$year-12-15";
            break;
        default:
            // code...
            $start_date = "$year-12-16";
            $end_date   = "$year-01-15";
            break;
    }

    $sites = array('HO','BO');

    include '../function/report/MIS/mis.report.query.php';

    foreach ($sites as $site) {
        # code...
        $monthly_csr_report_Support_Total  =  reportMonthlyPrcssSupport($start_date, $end_date, 'CSR', $site);
        $monthly_csr_report_Support_Completed  =  reportMonthlyPrcssSupportComplete($start_date, $end_date, 'CSR', $site);
        $monthly_csr_report_Support_Delay  =  reportMonthlyPrcssSupportNotComplete($start_date, $end_date, 'CSR', $site);
        $monthly_csr_report_Support_wip = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'CSR', $site, 'Work in Progress');
        $monthly_csr_report_Support_assigned = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'CSR', $site, 'Assigned');
        $monthly_csr_report_Support_nr = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'CSR', $site, 'New Request');

        $monthly_csr_report_Purchase_Total  =  reportMonthlyPrcssPurchase($start_date, $end_date, 'CSR', $site);
        $monthly_csr_report_Purchase_Completed   =  reportMonthlyPrcssPurchaseComplete($start_date, $end_date, 'CSR', $site);
        $monthly_csr_report_Purchase_Delay   =  reportMonthlyPrcssPurchaseNotComplete($start_date, $end_date, 'CSR', $site);
        $monthly_csr_report_Purchase_wip = reportMonthlyPrcssPurchaseStatus($start_date, $end_date, 'CSR', $site, 'Work in Progress');
        $monthly_csr_report_Purchase_assigned = reportMonthlyPrcssPurchaseStatus($start_date, $end_date, 'CSR', $site, 'Assigned');
        $monthly_csr_report_Purchase_nr = reportMonthlyPrcssPurchaseStatus($start_date, $end_date, 'CSR', $site, 'New Request');
        
        $monthly_cpr_report_Support_Total  =  reportMonthlyPrcssSupport($start_date, $end_date, 'CPR', $site);
        $monthly_cpr_report_Support_Completed  =  reportMonthlyPrcssSupportComplete($start_date, $end_date, 'CPR', $site);
        $monthly_cpr_report_Support_Delay  =  reportMonthlyPrcssSupportNotComplete($start_date, $end_date, 'CPR', $site);
        $monthly_cpr_report_Support_wip = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'CPR', $site, 'Work in Progress');
        $monthly_cpr_report_Support_assigned = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'CPR', $site, 'Assigned');
        $monthly_cpr_report_Support_nr = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'CPR', $site, 'New Request');
    
        $monthly_drr_report_Support_Total  =  reportMonthlyPrcssSupport($start_date, $end_date, 'DRR', $site);
        $monthly_drr_report_Support_Completed  =  reportMonthlyPrcssSupportComplete($start_date, $end_date, 'DRR', $site);
        $monthly_drr_report_Support_Delay  =  reportMonthlyPrcssSupportNotComplete($start_date, $end_date, 'DRR', $site);
        $monthly_drr_report_Support_wip = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'DRR', $site, 'Work in Progress');
        $monthly_drr_report_Support_assigned = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'DRR', $site, 'Assigned');
        $monthly_drr_report_Support_nr = reportMonthlyPrcssSupportStatus($start_date, $end_date, 'DRR', $site, 'New Request');

        $monthly_qa_report_Support_Total  =  reportMonthlyPrcssSupport($start_date, $end_date, 'QA', $site);
        $monthly_qa_report_Support_Completed  =  reportMonthlyPrcssSupportComplete($start_date, $end_date, 'QA', $site);
        $monthly_qa_report_Support_Delay  =  reportMonthlyPrcssSupportNotComplete($start_date, $end_date, 'QA', $site);

        $monthly_csr_completed = $monthly_csr_report_Support_Completed + $monthly_csr_report_Purchase_Completed;
        $monthly_csr_delay = $monthly_csr_report_Support_Delay + $monthly_csr_report_Purchase_Delay;
        $monthly_csr_total = $monthly_csr_completed + $monthly_csr_delay;
        $monthly_csr_percentage = round( ($monthly_csr_completed / $monthly_csr_total) * 100);


        if ($monthly_csr_completed) {
            # code...
            
            $monthly_csr_percentage = round( ($monthly_csr_completed / $monthly_csr_total) * 100);

        }else {
            # code...
            
            $monthly_csr_percentage = 0;

        }

        if ($monthly_cpr_report_Support_Completed) {
            # code...
            $monthly_cpr_percentage = round( ($monthly_cpr_report_Support_Completed / ($monthly_cpr_report_Support_Completed + $monthly_cpr_report_Support_Delay) ) * 100);
        }else {
            # code...
            $monthly_cpr_percentage = 0;
        }

        if ($monthly_drr_report_Support_Completed) {
            # code...
            $monthly_drr_percentage = round( ($monthly_drr_report_Support_Completed / ($monthly_drr_report_Support_Completed + $monthly_drr_report_Support_Delay) ) * 100);
        
        }else {
            # code...
            $monthly_drr_percentage = 0;
        }

        if ($monthly_qa_report_Support_Completed) {
            # code...
            $monthly_qa_percentage = round( ($monthly_qa_report_Support_Completed / ($monthly_qa_report_Support_Completed + $monthly_qa_report_Support_Delay) ) * 100);

        }else {
            # code...
            $monthly_qa_percentage = 0;
        }
        
        $objPHPExcel = PHPExcel_IOFactory::load("../updatetools/SRS Month Report Template.xlsx");
        
        $row = 3;
        $col = 4;
        /*
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
        */
        //$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
        $style = array('font' => array('size' => 12,'bold' => true),
                    'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF66')),
                    'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                    );

        $bold = array('font' => array('size' => 12,'bold' => true));

        //$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle('E3:F3')->applyFromArray($bold);

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $site." ".$month." ".$year);
        $row++;

        $col = 4;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total Receive Request");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Completed Request");
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CSR");
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Support");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Completed);
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Purchase");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Purchase_Total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Purchase_Completed);
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CPR");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Completed);
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "DRR");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Completed);
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "QA");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Completed);
        $row++;

        $col = 3;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Total + $monthly_csr_report_Purchase_Total + $monthly_cpr_report_Support_Total + $monthly_drr_report_Support_Total + $monthly_qa_report_Support_Total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Completed + $monthly_csr_report_Purchase_Completed + $monthly_cpr_report_Support_Completed + $monthly_drr_report_Support_Completed + $monthly_qa_report_Support_Completed);
        $row++;

        $row++;
        $row++;
        $row++;
        $row++;
        /*
        $col = 2;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Completed");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Delay");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Complete Percentage");
        $col++;
        */
        $row++;

        $col = 1;
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CSR");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_completed);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_percentage);
        $col++;
        $row++;

        $col = 1;
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CPR");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Completed);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Completed + $monthly_cpr_report_Support_Delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_percentage);
        $col++;
        $row++;

        $col = 1;
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "DRR");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Completed);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Completed + $monthly_drr_report_Support_Delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_percentage);
        $col++;
        $row++;

        $col = 1;
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "QA");
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Completed);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Completed + $monthly_qa_report_Support_Delay);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_percentage);
        $col++;
        $row++;

        $row++;

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

        
        $file = "../generated report/report-".$year."-".$month."-".$site.".php";

        $filename = str_replace('.php', '.xlsx', $file);
        if (file_exists($filename)) {
            unlink($filename) or die("Couldn't delete file");
        }
        clearstatcache();
        $objWriter->save(str_replace('.php', '.xlsx', $file));

        $mail = new PHPMailer();

        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = "10.194.23.193";  // specify main and backup server
        $mail->SMTPAuth = false;     // turn on SMTP authentication

        //$email = "willem.leonardo@ph.yazaki.com;"."aaron.sarreal@ph.yazaki.com;";

        $email_to = explode(";",$email);
        $emails_cc = explode(";",$email_cc);

        $mail->From = "smb_srs.pet@ph.yazaki.com";
        $mail->FromName = "[SRS Report]";
        //$mail->AddAddress("willem.leonardo@ph.yazaki.com, aaron.sarreal@ph.yazaki.com");
        foreach($email_to as $e_to){
            $mail->AddAddress($e_to);
        }

        
        foreach($emails_cc as $e_cc){
            $mail->addCC($e_cc);
        }
        
        $mail->AddReplyTo("smb_srs.pet@ph.yazaki.com", "Information");

        $mail->WordWrap = 50;                                       // set word wrap to 50 characters
        $mail->AddAttachment($filename);                            // add attachments
        $mail->IsHTML(true);                                        // set email format to HTML


        $mail->Subject = "[SRS] Monthly Report ".date("F-Y");
        $mail->Body    = "Good day,<br>
                            <br>
                            Please see attached file for the Monthly Report of ".$site." for ".date("F-Y")."<br>
                            <br>Thank you,<br>
                        <b>S</b>ervice <b>R</b>equest <b>S</b>ystem";
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

        if(!$mail->Send()){
           return "Message could not be sent.";
           return "Mailer Error: " . $mail->ErrorInfo;
           exit;
        }

    }


}