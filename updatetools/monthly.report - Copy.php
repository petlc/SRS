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

    //echo $email. "<br>";
    //echo $email_cc. "<br>";

    echo $_GET['month'] = date('F');
    echo $_GET['year'] = date('Y');
    echo "<br>";
    
    $current_month = $_GET['month'];
    $year  = $_GET['year'];

    $months         = array("July", "August", "September", "October", "November", "December", "January","February","March", "April", "May", "June");
     
    $sites = array('HO','BO');

    include '../function/report/MIS/mis.report.query.php';
    
    $row = 1;
    $col = 0;

    foreach ($sites as $site) {
        # code...
       
        //echo $site."<br>";

        foreach ($months as $month) {
            # code...

            echo $site." ".$current_month." ".$month."<br>";

            $dates = setDate($month);
            
            $start_date = $dates['start_date'];
            $end_date   = $dates['end_date'];
            

            //echo "<pre>";
            //print_r($dates);
            
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

            
            $monthly_indirect  =  reportMonthlyIndirect($start_date, $end_date, 'CPR', $site);
            
            echo "<pre>";
            print_r($monthly_indirect);
            
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
            
            //$objPHPExcel = PHPExcel_IOFactory::load("../updatetools/SRS Month Report Template.xlsx");
            
            
            //$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
            $style = array('font' => array('size' => 12,'bold' => true),
                        'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF66')),
                        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                        );

            $bold = array('font' => array('size' => 12,'bold' => true));

            //$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle("A$row:H$row")->applyFromArray($style);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$row:H$row");

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $site." ".$month." ".$start_date." to ".$end_date);
            $row++;

            $row++;
            
            $objPHPExcel->getActiveSheet()->getStyle("A$row:H$row")->applyFromArray($bold);

            $col = 1;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "New Request");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Assigned");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Work in Progress");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Completed");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Complete Percentage");
            $col++;
            
            $row++;

            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CSR");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_nr + $monthly_csr_report_Purchase_nr);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_assigned + $monthly_csr_report_Purchase_assigned);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_wip + $monthly_csr_report_Purchase_wip);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_completed);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_total);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_percentage);
            $col++;
            $row++;

            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CPR");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_nr);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_assigned);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_wip);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Completed);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Completed + $monthly_cpr_report_Support_Delay);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_percentage);
            $col++;
            $row++;

            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "DRR");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_nr);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_assigned);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_wip);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Completed);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Completed + $monthly_drr_report_Support_Delay);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_percentage);
            $col++;
            $row++;

            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "QA");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "N/A");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "N/A");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "N/A");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Completed);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Completed + $monthly_qa_report_Support_Delay);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_percentage);
            $col++;
            $row++;

            $row++;

            
            /*

            if (!empty($monthly_indirect)) {
                # code...
                $col = 0;
                $objPHPExcel->getActiveSheet()->getStyle("A$row:H$row")->applyFromArray($bold);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Indirect Report");
                $row++;

                
                $col = 0;
                $objPHPExcel->getActiveSheet()->getStyle("A$row:H$row")->applyFromArray($bold);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Request");
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
                $col++;
                $row++;

                foreach ($monthly_indirect as $indirect_data ) {
                    # code...
                    
                    $col = 0;
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $indirect_data['ic_rqst']);
                    $col++;
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $indirect_data['count']);
                    $col++;
                    $row++;
                }
            }

            */
            
            $row++;
            
            if ($current_month == $month) {
                # code...
                $row = 1;       
                $col = 0;
                break;
            }else {
                # code...                
                $col = 0;
            }

            //sleep(10);
        
        }
        
        
        
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
        $mail->AddAddress("aaron.sarreal@ph.yazaki.com");
		$mail->AddAddress("emiliano.mendoza@ph.yazaki.com");
        $mail->AddAddress("troy.gatchalian@ph.yazaki.com");
        $mail->AddAddress("francisco.javines@ph.yazaki.com");
		$mail->addCC("smb_srs.pet@ph.yazaki.com");
        foreach($email_to as $e_to){
            //$mail->AddAddress($e_to);
        }

        
        foreach($emails_cc as $e_cc){
          //  $mail->addCC($e_cc);
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



function setDate($month){

    $current_year = date('Y');
    
    switch ($month) {

        case 'July':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-06-16";
            $end_date   = "$prev-07-15";
            break;
        case 'August':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-07-16";
            $end_date   = "$prev-08-15";
            break;
        case 'September':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-08-16";
            $end_date   = "$prev-09-15";
            break;
        case 'October':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-09-16";
            $end_date   = "$prev-10-15";
            break;
        case 'November':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-10-16";
            $end_date   = "$prev-11-15";
            break;
        case 'December':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-11-16";
            $end_date   = "$prev-12-15";
            break;

        case 'January':
            // code...
            $prev       =  $current_year - 1;
            $start_date = "$prev-12-16";
            $end_date   = "$current_year-01-15";
            break;
        case 'February':
            // code...
            $start_date = "$current_year-01-16";
            $end_date   = "$current_year-02-15";
            break;
        case 'March':
            // code...
            $start_date = "$current_year-02-16";
            $end_date   = "$current_year-03-15";
            break;
        case 'April':
            // code...
            $start_date = "$current_year-03-16";
            $end_date   = "$current_year-04-15";
            break;
        case 'May':
            // code...
            $start_date = "$current_year-04-16";
            $end_date   = "$current_year-05-15";
            break;
        case 'June':
            // code...
            $start_date = "$current_year-05-16";
            $end_date   = "$current_year-06-15";
            break;
        
    }
    
    
    $dates = ([
        'start_date' => $start_date,
        'end_date' => $end_date
    ]);
    
    return $dates;
}