<?php
ini_set('memory_limit', '1024M'); // or you could use 1G

include 'function/report/MIS/mis.report.query.php';

$months         = array("January","February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$month_dates    = array("12-16;01-15","01-16;02-15","02-16;03-15","03-16;04-15","04-16;05-15","05-16;06-15","06-16;07-15","07-16;08-15","08-16;09-15","09-16;10-15","10-16;11-15","11-16;12-15");

$status_list    = array('Newly Created', 'Not Approve', 'For Checking', 'For Approval', 'New Request', 'Assigned', 'Work in Progress', 'Done', 'Endorse to Checker', 'Closed', 'Cancelled');

$process_list   = array("CSR", "CPR", "DRR", "QA");


if(isset($_GET['get_report'])){

    $site = $_GET['site'];

    if(!empty($_GET['year'])){
        if (!empty($_GET['month']) && $_GET['month'] == "All" ) {
            // code...
            $year  = $_GET['year'];

            $date_infos = array();
            $dates_info = array();

            $status_infos = array();
            $statuses_info = array();

            $prcss_infos = array();
            $prcsses_info = array();

            $member_infos = array();
            $members_info = array();
            foreach ($month_dates as $key => $date_value) {
                // code...
                $dates = explode(";",$date_value);

                if ($dates[0] == "12-16") {
                    // code...
                    $prev       =$year - 1;
                    $start_date = $prev."-".$dates[0];
                }else{
                    $start_date = $year."-".$dates[0];
                }

                $end_date = $year."-".$dates[1];

                $monthly_done_report  = reportMonthlyMISStatus($start_date, $end_date,'Done', $site);
                $monthly_close_report  = reportMonthlyMISStatus($start_date, $end_date,'Closed', $site);

                $monthly_report  = reportMonthlyMIS($start_date, $end_date, $site);
                $monthly_manhour = reportMonthlyMISManhr($start_date, $end_date, $site);
                //echo $monthly_manhour;

                $monthly_ahead   = reportMonthlyMISAhead($start_date, $end_date, $site);
                $monthly_ontime  = reportMonthlyMISOntime($start_date, $end_date, $site);
                $monthly_delay   = reportMonthlyMISDelay($start_date, $end_date, $site);

                $monthly_csr_report  =  reportMonthlyPrcss($start_date, $end_date, 'CSR', $site);
                $monthly_cpr_report  =  reportMonthlyPrcss($start_date, $end_date, 'CPR', $site);
                $monthly_drr_report  =  reportMonthlyPrcss($start_date, $end_date, 'DRR', $site);
                $monthly_qa_report  =  reportMonthlyPrcss($start_date, $end_date, 'QA', $site);

                $monthly_stfwr_prchs_report  =  reportMonthlyPrchs($start_date, $end_date, 'Software Purchase', $site);
                $monthly_hrdwr_prchs_report  =  reportMonthlyPrchs($start_date, $end_date, 'Hardware Purchase', $site);
                $monthly_lcns_rnwl_report  =  reportMonthlyPrchs($start_date, $end_date, 'Renewal License', $site);

                $monthly_doneWoutPurchase_report  = reportMonthlyMISStatusWoutPurchase($start_date, $end_date,'Done', $site);
                $monthly_closeWoutPurchase_report  = reportMonthlyMISStatusWoutPurchase($start_date, $end_date,'Closed', $site);

                if ($monthly_report == 0) {
                    // code...
                    $date_infos    = array("No Data", "No Data", "No Data", "No Data", "No Data");
                    $status_infos    = array("No Data", "No Data", "No Data", "No Data", "No Data", "No Data");
                    $prcss_infos    = array("No Data", "No Data", "No Data", "No Data", "No Data");
                }else{

                    if (($monthly_done_report + $monthly_close_report) == 0) {
                        // code...
                        $monthly_response_time = "N/A";
                    }else{
                        $monthly_response_time =  $monthly_manhour;
                    }


                    $date_infos    = array($monthly_ahead, $monthly_ontime, $monthly_delay, $monthly_report, $monthly_response_time);

                    foreach ($status_list as $key => $value) {
                        // code...
                        $stats[$value] = reportMonthlyMISStatus($start_date, $end_date,$value, $site);
                        //echo $value." ".$stats[$value]."<br>";
                    }
                    
                    $status_infos   = array($stats['New Request'], $stats['Assigned'], $stats['Work in Progress'], $stats['Done'], $stats['Closed']);

                    $prcss_infos    = array($monthly_csr_report, $monthly_cpr_report, $monthly_drr_report, $monthly_qa_report);
                }

                $dates_info[]    = $date_infos;
                $statuses_info[] = $status_infos;
                $prcsses_info[]  = $prcss_infos;
                //$members_info[]  = $member_infos;
            }

            //print_r($dates_info);
        }elseif (!empty($_GET['month']) && $_GET['month'] != "All" ) {
            // code...
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

            if(!empty($_GET['member'])){
                $querylist = "";
                $member = $_GET['member'];

                $memberMonthlyAhead  = memberMonthlyAhead($start_date, $end_date, $member, $site);
                $memberMonthlyOntime = memberMonthlyOntime($start_date, $end_date, $member, $site);
                $memberMonthlyDelay  = memberMonthlyDelay($start_date, $end_date, $member, $site);

                $memberMonthlyManhr  = memberMonthlyManhr($start_date, $end_date, $member, $site);

                $querylist = "Select * from srvcrqst where ic_crtd_date between '$start_date' and '$end_date' and assigned_to = '$member' ";

                if (!empty($site)) {
                    // code...
                    $querylist .= "and ic_site = '$site'";
                }



                $status = "Report";
            }else{
                $monthly_csr_report  =  reportMonthlyPrcss($start_date, $end_date, 'CSR', $site);
                $monthly_cpr_report  =  reportMonthlyPrcss($start_date, $end_date, 'CPR', $site);
                $monthly_drr_report  =  reportMonthlyPrcss($start_date, $end_date, 'DRR', $site);
                $monthly_qa_report   =  reportMonthlyPrcss($start_date, $end_date, 'QA', $site);

                $monthly_csr_report_hrs  =  reportMonthlyPrcssHrs($start_date, $end_date, 'CSR', $site);
                $monthly_cpr_report_hrs  =  reportMonthlyPrcssHrs($start_date, $end_date, 'CPR', $site);
                $monthly_drr_report_hrs  =  reportMonthlyPrcssHrs($start_date, $end_date, 'DRR', $site);
                $monthly_qa_report_hrs   =  reportMonthlyPrcssHrs($start_date, $end_date, 'QA', $site);

                $monthly_csr_report_dly  =  reportMonthlyPrcssDelay($start_date, $end_date, 'CSR', $site);
                $monthly_cpr_report_dly  =  reportMonthlyPrcssDelay($start_date, $end_date, 'CPR', $site);
                $monthly_drr_report_dly  =  reportMonthlyPrcssDelay($start_date, $end_date, 'DRR', $site);

                $monthly_stfwr_prchs_report  =  reportMonthlyPrchs($start_date, $end_date, 'Software Purchase', $site);
                $monthly_hrdwr_prchs_report  =  reportMonthlyPrchs($start_date, $end_date, 'Hardware Purchase', $site);
                $monthly_lcns_rnwl_report    =  reportMonthlyPrchs($start_date, $end_date, 'Renewal License', $site);

                $monthly_done_report    = reportMonthlyMISStatus($start_date, $end_date,'Done', $site);
                $monthly_close_report   = reportMonthlyMISStatus($start_date, $end_date,'Closed', $site);
                $monthly_report         = reportMonthlyMIS($start_date, $end_date, $site);
                $monthly_manhour        = reportMonthlyMISManhr($start_date, $end_date, $site);
                //echo $start_date." ".$end_date." ".$monthly_manhour;

                // Previous Ave. Response Time
                //$monthly_response_time =  number_format(($monthly_manhour / ($monthly_done_report + $monthly_close_report)), 2, '.', '');

                //$monthly_response_time =number_format( $monthly_manhour, 2, '.', '');.
                $monthly_response_time = $monthly_manhour;

                $monthly_ahead   = reportMonthlyMISAhead($start_date, $end_date, $site);
                $monthly_ontime  = reportMonthlyMISOntime($start_date, $end_date, $site);
                $monthly_delay   = reportMonthlyMISDelay($start_date, $end_date, $site);
                //echo $monthly_report;

                $monthly_members = reportMonthlyMISMembers($start_date, $end_date, $site);
                //print_r($monthly_members);

                
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

                $monthly_cpr_percentage = round( ($monthly_cpr_report_Support_Completed / ($monthly_cpr_report_Support_Completed + $monthly_cpr_report_Support_Delay) ) * 100);
                $monthly_drr_percentage = round( ($monthly_drr_report_Support_Completed / ($monthly_drr_report_Support_Completed + $monthly_drr_report_Support_Delay) ) * 100);
                $monthly_qa_percentage = round( ($monthly_qa_report_Support_Completed / ($monthly_qa_report_Support_Completed + $monthly_qa_report_Support_Delay) ) * 100);

                $monthly_member_infos = array();
                $monthly_members_info = array();
                foreach ($monthly_members as $key => $name) {
                    // code...
                    $incharge   = $name[0];
                    $inchrg_cnt = $name[1];

                    $assigned[$incharge] = reportMonthlyMISMembersAssigned($start_date, $end_date, $incharge, 'Assigned',$site);
                    $wip[$incharge] = reportMonthlyMISMembersAssigned($start_date, $end_date, $incharge, 'Work in Progress', $site);
                    $done[$incharge] = reportMonthlyMISMembersAssigned($start_date, $end_date, $incharge, 'Done', $site);
                    $closed[$incharge] = reportMonthlyMISMembersAssigned($start_date, $end_date, $incharge, 'Closed', $site);

                    $monthly_member_infos = array($incharge, $assigned[$incharge], $wip[$incharge], $done[$incharge], $closed[$incharge], $inchrg_cnt);
                    $monthly_members_info[] = $monthly_member_infos;
                    //$monthly_members_info = array($incharge, $inchrg_cnt);
                }
                
                foreach ($status_list as $key => $value) {
                    // code...
                    $stats[$value] = reportMonthlyMISStatus($start_date, $end_date,$value, $site);
                    //echo $value." ".$stats[$value]."<br>";
                }
                
            }


        }
    }

}elseif(isset($_GET['get_stats'])){
    if(!empty($_GET['office']) && !empty($_GET['member']) && !empty($_GET['work_year'])){
        $office = $_GET['office'];

        if($office == "HO"){
            $department = "MIS";
        }elseif($office == "BO"){
            $department = "MIS (Iloilo)";
        }

        $member = "admin.".$_GET['member'];
        $workyear   = $_GET['work_year'];

        $overallstats   = memberOverallStats($member);

        $yearStats      = memberYearStats($workyear, $member);

        $status_list    = array('Newly Created', 'Not Approve', 'For Checking', 'For Approval', 'New Request', 'Assigned', 'Work in Progress', 'Done', 'Endorse to Checker', 'Closed', 'Cancelled');

        $status_stat    = array();

        foreach ($status_list as $key => $value) {
            // code...
            $stats[$value] = memberStats($workyear, $member, $office, $value);
        }

        $status = $workyear;
        $querylist = $querylist = "Select * from srvcrqst where assigned_to = '$member' and ic_crtd_date like '%$workyear%'";
    }
}


### Member Report

function memberOverallStats($member){

    $member_check = new Report();

    $member_check->query("Select * from srvcrqst where assigned_to = '$member' ");
    $member_check->execute();

    return $member_check->rowCount();

}

function memberYearStats($workyear, $member){

    $member_check = new Report();

    $member_check->query("Select * from srvcrqst where assigned_to = '$member' and ic_crtd_date like '%$workyear%' ");
    $member_check->execute();

    return $member_check->rowCount();

}


function memberStats($workyear, $member, $office, $status){

    $member_check = new Report();

    $member_check->query("Select * from srvcrqst where assigned_to = '$member' and ic_status = '$status' and ic_crtd_date like '%$workyear%'");
    $member_check->execute();

    return $member_check->rowCount();

}
function memberReport($start_date, $end_date, $member){

    $monthly_check = new Report();

    $monthly_check->query("Select * from srvcrqst where ic_crtd_date between :start and :end and assigned_to = :assigned_to");
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->bind(':assigned_to',$member );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function memberMonthlyAhead($start_date, $end_date, $member){

    $monthly_check = new Report();

    $monthly_check->query("Select * from srvcrqst where assigned_to = '$member' and ic_crtd_date between :start and :end and ic_crtd_date > done_date and ic_status not in ('Cancelled') ");
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function memberMonthlyOntime($start_date, $end_date, $member){

    $monthly_check = new Report();

    $monthly_check->query("Select * from srvcrqst where assigned_to = '$member' and ic_crtd_date between :start and :end and ic_crtd_date = done_date and ic_status not in ('Cancelled')");
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}
function memberMonthlyDelay($start_date, $end_date, $member){

    $monthly_check = new Report();

    $monthly_check->query("Select * from srvcrqst where assigned_to = '$member' and ic_crtd_date between :start and :end and ic_crtd_date < done_date and ic_status not in ('Cancelled')");
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function memberMonthlyManhr($start_date, $end_date, $member){

    $monthly_check = new Report();

    $monthly_check->query("Select acknowledged_date, done_date from srvcrqst where assigned_to = '$member' and ic_crtd_date between :start and :end and ic_status in ('Done', 'Closed') and ic_dtls not like '%Purchase%' and ic_dtls not like '%Renewal%'");
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    if($monthly_check->rowCount() > 0){
        $row = $monthly_check->resultset();
        $total = $monthly_check->rowCount();

        for ($i=0; $i < $total; $i++) {
            // code...
            //echo (float)$row[$i]['done_date'] - (float)$row[$i]['ic_rqst_date'] ."<br>";
            //$date_time_plus_one     = strtotime($row[$i]['ic_crtd_date'] . ' +8 hours');
            /*
            $date_time_plus_one     = strtotime($row[$i]['acknowledged_date'] . ' +8 hours');
            $excel_date_request     = floatval(25569 + $date_time_plus_one / 86400);
            $date_time_plus_two     = strtotime($row[$i]['done_date'] . ' +8 hours');
            $excel_date_done        = floatval(25569 + $date_time_plus_two / 86400);
            $response_time          = floatval(($excel_date_done - $excel_date_request) );
            $manhour[]              = number_format((float)$response_time, 2, '.', '');


            $date_time_plus_one     = strtotime($row[$i]['acknowledged_date']);
            $excel_date_request     = floatval($date_time_plus_one / 3600);
            $date_time_plus_two     = strtotime($row[$i]['done_date']);
            $excel_date_done        = floatval($date_time_plus_two / 3600);
            $response_time          = floatval(($excel_date_done - $excel_date_request) );
            $manhour[]              = number_format((float)$response_time, 2, '.', '');
            //echo $row[$i]['prcss_no']." ".$manhour."<br>";
            */

            if ( $row[$i]['done_date'] == 0) {
                // code...
                $manhour[] = 0;
            }else{

                $manhour = manHour($row[$i]['acknowledged_date'], $row[$i]['done_date'], "Manhour");
               

            }
        }

        $overall_manhour = array_sum($manhour);
    }else{
        $overall_manhour = "No Data";
    }

    return $overall_manhour;
}

?>
