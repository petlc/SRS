<?php
$row = 1;
$col = 0;

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
$style = array('font' => array('size' => 12,'bold' => true),
               'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF66')),
               'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            );

$bold = array('font' => array('size' => 12,'bold' => true));

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($bold);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $site." ".$month." ".$year);
$row++;

$col = 2;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total Receive Request");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Completed Request");
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CSR");
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Support");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Total);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Completed);
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Purchase");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Purchase_Total);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Purchase_Completed);
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CPR");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Total);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_Support_Completed);
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "DRR");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Total);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_Support_Completed);
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "QA");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Total);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_Support_Completed);
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Total + $monthly_csr_report_Purchase_Total + $monthly_cpr_report_Support_Total + $monthly_drr_report_Support_Total + $monthly_qa_report_Support_Total);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_Support_Completed + $monthly_csr_report_Purchase_Completed + $monthly_cpr_report_Support_Completed + $monthly_drr_report_Support_Completed + $monthly_qa_report_Support_Completed);
$row++;

$row++;

$col = 2;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Completed");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Delay");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Complete Percentage");
$col++;
$row++;

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CSR");
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
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CPR");
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
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "DRR");
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
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "QA");
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
/*
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Response");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Ahead of Time");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $monthly_ahead);
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "On Time");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_ontime);
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Delay");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_delay);
$row++;
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Ave. Response Time");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_response_time);
$row++;

*/
//  Request list

//$row = 2;
/*
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Status");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Request");
$row++;
*/
/*
$col = 3;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Newly Created");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Newly Created']);
$row++;

$col = 3;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Not Approve");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Not Approve']);
$row++;

$col = 3;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "For Checking");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['For Checking']);
$row++;

$col = 3;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "For Approval");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['For Approval']);
$row++;
*/

/*
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "New Request");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['New Request']);
$row++;

$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Assigned");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Assigned']);
$row++;

$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Work in Progress");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Work in Progress']);
$row++;

$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Done");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Done']);
$row++;

$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Endorse to Checker");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Endorse to Checker']);
$row++;

$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Closed");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Closed']);
$row++;
*/

/*
$col = 3;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Cancelled");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $stats['Cancelled']);
$row++;
*/

/*
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total Received Request");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,  $monthly_report);
$row++;

$row++;
$objPHPExcel->getActiveSheet()->getStyle('A11:F11')->applyFromArray($bold);


$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Process");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Hours");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Delay");
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CSR");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_hrs);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_csr_report_dly);
$row++;
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "CPR");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_hrs);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_cpr_report_dly);
$row++;
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "DRR");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_hrs);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_drr_report_dly);
$row++;
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "QA");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report);
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_qa_report_hrs);
$row++;

//$row = 11;

$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Purchase");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Count");
$row++;
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Software");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_stfwr_prchs_report);
$row++;
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Hardware");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_hrdwr_prchs_report);
$row++;
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Renewal");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $monthly_lcns_rnwl_report);
$row++;
*/


$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A17:F17');
$style = array('font' => array('size' => 12,'bold' => true),
               'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF66')),
               'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            );
$objPHPExcel->getActiveSheet()->getStyle('A17:G17')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A18:G18')->applyFromArray($bold);
$row = 17;
$col = 0;


$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "
Members with Request and Status count info");
$col++;
$row++;

$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Name");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Assigned");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Work in Progress");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Done");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Closed");
$col++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total");
$col++;
$row++;

$total  =   array();
foreach ($monthly_members_info as $key => $value) {

    $col = 0;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[0]);
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[1]);
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[2]);
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[3]);
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[4]);
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value[5]);
    $col++;
    $row++;
    $total[] = $value[5];
}
$col = 0;
$style = array('font' => array('size' => 12,'bold' => true),
               'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF66')),
               'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            );
$objPHPExcel->getActiveSheet()->getStyle("A$row:E$row")->applyFromArray($style);

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$row:E$row");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Total");
$col++;
$col = 5;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, array_sum($total));


$row++;
$row++;
$col = 0;
$objPHPExcel->getActiveSheet()->getStyle("A$row:E$row")->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$row:M$row");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Request Details");

$row++;
$get_dtls = new Report();

if (!empty($site)) {
    // code...
    $query = "Select * From srvcrqst Where ic_crtd_date Between :start_date AND :end_date and ic_site = '$site' and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ORDER BY ic_crtd_date ASC";
}elseif (!empty($member)) {
    // code...
    $query = "Select * From srvcrqst Where ic_crtd_date Between :start_date AND :end_date and and assigned_to = '$member' and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ORDER BY ic_crtd_date ASC";
}else{
    $query = "Select * From srvcrqst Where ic_crtd_date Between :start_date AND :end_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ORDER BY ic_crtd_date ASC";
}

$get_dtls->query($query);
$get_dtls->bind(':start_date', $start_date);
$get_dtls->bind(':end_date', $end_date);
$get_dtls->execute();

if($get_dtls->rowCount() > 0){
    //$row = 1; // 1-based index
    $col = 0;
    /*
    $columnname = array("IC No", "Date Request", "Date Needed", "Reported By", "Derpartment", "Details", "Status", "Dprt. Checker","Dprt. Approver", "Date Acknowledge", "Date Done", "Man hour");
    foreach($columnname as $key=>$column) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $column);
            $col++;
        }
        */

    /*
    while($row_data = $get_dtls->single()) {
        print_r($row_data);

        $col = 0;
        foreach($row_data as $key=>$value) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
            $col++;
        }
        $row++;

    }
    */
    $objPHPExcel->getActiveSheet()->getStyle($col.":".$row)->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "IC No.");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Reference No.");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Requestor");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Department");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Site");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Request date");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Request needed/occur");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Status");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Request");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Details");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Acknowledge Date");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Date Receive");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Date Done");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "In Charge");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Man Hour");
    $col++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Response");
    $col++;
    $row++;

    $row_data   = $get_dtls->resultset();
    $row_count  = $get_dtls->rowCount();

    for ($i=0; $i < $row_count; $i++) {
        $col = 0;
        //echo $row_data[$i]['prcss_no']."<br>";
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_no']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['prcss_no']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_rqstr']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_rqstr_dprtmnt']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_site']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_crtd_date']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_rqst_date']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_status']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_rqst']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['ic_dtls']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['acknowledged_date']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['received_date']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['done_date']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['assigned_to']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['man_hour']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $row_data[$i]['response']);
        $col++;
        $row++;
    }

}



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

if (!empty($site)) {
    
    $file = "generated report/report-".$year."-".$month."-".$site.".php";

}else{

    $file = "generated report/report-".$year."-".$month.".php";

}

$filename = str_replace('.php', '.xlsx', $file);
if (file_exists($filename)) {
    unlink($filename) or die("Couldn't delete file");
}
clearstatcache();
$objWriter->save(str_replace('.php', '.xlsx', $file));


?>
