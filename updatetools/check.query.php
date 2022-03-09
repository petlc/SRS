<?php

require_once 'db.connections.php';

$months         = array("January","February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$month_dates    = array("12-16;01-15","01-16;02-15","02-16;03-15","03-16;04-15","04-16;05-15","05-16;06-15","06-16;07-15","07-16;08-15","08-16;09-15","09-16;10-15","10-16;11-15","11-16;12-15");

$status_list    = array('Newly Created', 'Not Approve', 'For Checking', 'For Approval', 'New Request', 'Assigned', 'Work in Progress', 'Done', 'MIS Checker', 'Closed');

$process_list   = array("CSR", "CPR", "DRR", "QA");

$get_info   = new Update();

$get_info->query("Select * from srvcrqst where ic_crtd_date between '2017-12-16' and '2018-01-15'  ");
$get_info->execute();

//$get_info->query("Select * from srvcrqst where ic_crtd_date between '2018-01-16' and '2018-02-15'");
//$get_info->execute();

$csr_time           = "";
$csr_count          = "";
$csr_delay          = "";
$csr_ontime         = "";
$csr_ahead          = "";
$csr_assigned       = "";
$csr_workinprogress = "";
$csr_newrequest     = "";
        
$cpr_time           = "";
$cpr_count          = "";
$cpr_delay          = "";
$cpr_ontime         = "";
$cpr_ahead          = "";
$cpr_assigned       = "";
$cpr_workinprogress = "";
$cpr_newrequest     = "";

$drr_time           = "";
$drr_count          = "";
$drr_delay          = "";
$drr_ontime         = "";
$drr_ahead          = "";
$drr_assigned       = "";
$drr_workinprogress = "";
$drr_newrequest     = "";

$qa_time            = "";
$qa_count           = "";
$qa_delay           = "";
$qa_ontime          = "";
$qa_ahead           = "";
$qa_assigned        = "";
$qa_workinprogress  = "";
$qa_newrequest      = "";

$assigned = "";
$workinprogress = "";
$newrequest = "";
$other_status = "";

$date_now      = date('Y-m-d');

echo $get_info->rowCount()."<br>";

foreach( $get_info->resultset() as $row){
    
    $prcss  = array_filter(explode("-",$row['prcss_no']));
    //echo $row['prcss_no']." ".$row['ic_status']." ";
    
    switch($prcss[0]){
            
        case "CSR":
            
            switch($row['ic_status']){
                    
                case "Assigned":
                    /*
                    $response_time = timeCalc($row['ic_rqst_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    */
                    //echo  $date_now." - ".$row['ic_rqst_date']." ".$response_time." ".$response_val;
                    
                    $csr_assigned .= "1,";
                    
                    break;
                case "Work in Progress":
                    /*
                    $response_time = timeCalc($row['ic_rqst_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_rqst_date']." ".$response_time." ".$response_val;
                    */
                    $csr_workinprogress .= "1,";
                    
                    break;
                
                case "Done":
                case "Closed":
                    
                    $response_time = timeCalc($row['ic_rqst_date'],$row['done_date']);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $row['done_date']." - ".$row['ic_rqst_date']." ".$response_time." ".$response_val;
                    
                    switch($response_val){

                        case "Delay":

                            $csr_delay .= $row['prcss_no'].",";

                            break;

                        case "Ahead of Time":

                            $csr_ahead .= $row['prcss_no'].",";

                            break;

                        case "On Time":

                            $csr_ontime .= $row['prcss_no'].",";

                            break;


                    }
            
                    $csr_time .= $response_time.",";
                    $csr_count .= $row['prcss_no'].",";
            
                    
                    break;
                    
                default:
                    
                    //echo $row['ic_status'];
                    $other_status .= "1,";
                    
                    break;
            }
            
            break;
            
        case "CPR":
            
            switch($row['ic_status']){    
                
                case "Assigned":
                    /*
                    $response_time = timeCalc($row['ic_crtd_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    */
                    $cpr_assigned .= "1,";
                    
                    break;
                case "Work in Progress":
                    /*
                    $response_time = timeCalc($row['ic_crtd_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    */
                    $cpr_workinprogress .= "1,";
                    
                    break;
                
                case "Done":
                case "Closed":
                    
                    $response_time = timeCalc($row['ic_crtd_date'],$row['done_date']);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $row['done_date']." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    switch($response_val){
                    
                        case "Delay":

                            $cpr_delay .= $row['prcss_no'].",";

                            break;

                        case "Ahead of Time":

                            $cpr_ahead .= $row['prcss_no'].",";

                            break;

                        case "On Time":

                            $cpr_ontime .= $row['prcss_no'].",";

                            break;


                    }
                    $cpr_time .= $response_time.",";
                    $cpr_count .= $row['prcss_no'].",";
                    break;
                    
                default:
                    
                    //echo $row['ic_status'];
                    $other_status .= "1,";
                    
                    break;
            }
            
            
            
            
            break;
            
        case "DRR":
            
            switch($row['ic_status']){    
                
                case "Assigned": 
                    /*
                    $response_time = timeCalc($row['ic_crtd_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    */
                    $drr_assigned .= "1,";
                    
                    break;
                case "Work in Progress":
                    /*
                    $response_time = timeCalc($row['ic_crtd_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    */
                    $drr_workinprogress .= "1,";
                    
                    break;
                
                case "Done":
                case "Closed":
                    
                    $response_time = timeCalc($row['ic_crtd_date'],$row['done_date']);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $row['done_date']." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                     switch($response_val){
                    
                        case "Delay":

                            $drr_delay .= $row['prcss_no'].",";

                            break;

                        case "Ahead of Time":

                            $drr_ahead .= $row['prcss_no'].",";

                            break;

                        case "On Time":

                            $drr_ontime .= $row['prcss_no'].",";

                            break;


                    }
                    
                    $drr_time .= $response_time.",";
                    $drr_count .= $row['prcss_no'].",";
                    
                    break;
                    
                default:
                    
                    //echo $row['ic_status'];
                    $other_status .= "1,";
                    
                    break;
            }
            
           
            
            
            
            break;
            
        case "QA":
            
            switch($row['ic_status']){    
                
                case "Assigned":
                    /*
                    $response_time = timeCalc($row['ic_crtd_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    */
                    $qa_assigned .= "1,";
                    
                    break;
                case "Work in Progress":
                    /*
                    $response_time = timeCalc($row['ic_crtd_date'],$date_now);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $date_now." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    */
                    $qa_workinprogress .= "1,";
                    
                    break;
                
                case "Done":
                case "Closed":
                    
                    $response_time = timeCalc($row['ic_crtd_date'],$row['done_date']);
                    
                    $response_val  = responseVal($response_time);
                    
                    //echo  $row['done_date']." - ".$row['ic_crtd_date']." ".$response_time." ".$response_val;
                    switch($response_val){
                    
                        case "Delay":

                            $qa_delay .= $row['prcss_no'].",";

                            break;

                        case "Ahead of Time":

                            $qa_ahead .= $row['prcss_no'].",";

                            break;

                        case "On Time":

                            $qa_ontime .= $row['prcss_no'].",";

                            break;


                    }
                    
                    $qa_time .= $response_time.",";
                    $qa_count .= $row['prcss_no'].",";
                    
                    break;
                    
                default:
                    
                    //echo $row['ic_status'];
                    $other_status .= "1,";
                    
                    break;
            }
            
            
            
            
            
            break;
            
    }
    
    //echo "<br>";
}

####### CSR count info #######

$csr_overall_assigned       = count(array_filter(explode(",",$csr_assigned)));
$csr_overall_workinprogress = count(array_filter(explode(",",$csr_workinprogress)));

$csr_overall_req            = count(array_filter(explode(",",$csr_count)));
$csr_overall_delay          = count(array_filter(explode(",",$csr_delay)));
$csr_overall_ahead          = count(array_filter(explode(",",$csr_ahead)));
$csr_overall_ontime         = count(array_filter(explode(",",$csr_ontime)));
$csr_overall_response       = array_sum(array_filter(explode(",",$csr_time)))/$csr_overall_req;

####### CPR count info #######

$cpr_overall_assigned       = count(array_filter(explode(",",$cpr_assigned)));
$cpr_overall_workinprogress = count(array_filter(explode(",",$cpr_workinprogress)));

$cpr_overall_req            = count(array_filter(explode(",",$cpr_count)));
$cpr_overall_delay          = count(array_filter(explode(",",$cpr_delay)));
$cpr_overall_ahead          = count(array_filter(explode(",",$cpr_ahead)));
$cpr_overall_ontime         = count(array_filter(explode(",",$cpr_ontime)));
$cpr_overall_response       = array_sum(array_filter(explode(",",$cpr_time)))/$cpr_overall_req;

####### DRR count info #######

$drr_overall_assigned       = count(array_filter(explode(",",$drr_assigned)));
$drr_overall_workinprogress = count(array_filter(explode(",",$drr_workinprogress)));

$drr_overall_req            = count(array_filter(explode(",",$drr_count)));
$drr_overall_delay          = count(array_filter(explode(",",$drr_delay)));
$drr_overall_ahead          = count(array_filter(explode(",",$drr_ahead)));
$drr_overall_ontime         = count(array_filter(explode(",",$drr_ontime)));
$drr_overall_response       = array_sum(array_filter(explode(",",$drr_time)))/$drr_overall_req;

####### DRR count info #######

$qa_overall_assigned       = count(array_filter(explode(",",$qa_assigned)));
$qa_overall_workinprogress = count(array_filter(explode(",",$qa_workinprogress)));

$qa_overall_req             = count(array_filter(explode(",",$qa_count)));
$qa_overall_delay           = count(array_filter(explode(",",$qa_delay)));
$qa_overall_ahead           = count(array_filter(explode(",",$qa_ahead)));
$qa_overall_ontime          = count(array_filter(explode(",",$qa_ontime)));
$qa_overall_response        = array_sum(array_filter(explode(",",$qa_time)))/$qa_overall_req;

####### Other Request count info ####### 

$other_request_overall      =   count(array_filter(explode(",",$other_status)));


####### Response Count ########

$assigned_overall           = ($csr_overall_assigned + $cpr_overall_assigned + $drr_overall_assigned + $qa_overall_assigned);
$workinprogress_overall     = ($csr_overall_workinprogress + $cpr_overall_workinprogress + $drr_overall_workinprogress + $qa_overall_workinprogress);

$delay_overall              = ($csr_overall_delay + $cpr_overall_delay + $drr_overall_delay + $qa_overall_delay);
$ahead_overall              = ($csr_overall_ahead + $cpr_overall_ahead + $drr_overall_ahead + $qa_overall_ahead);
$ontime_overall             = ($csr_overall_ontime + $cpr_overall_ontime + $drr_overall_ontime + $qa_overall_ontime);

$overall_response_time = ($csr_overall_response + $cpr_overall_response + $drr_overall_response + $qa_overall_response);
$overall_request       = ($csr_overall_req + $cpr_overall_req + $drr_overall_req + $qa_overall_req);
$overall_manhour       = $overall_response_time/$overall_request;

echo "CSR Total Request ".$csr_overall_req."<br>";
echo "CSR Delay ".$csr_overall_delay."<br>";
echo "CSR Ahead of Time ".$csr_overall_ahead."<br>";
echo "CSR On Time ".$csr_overall_ontime."<br>";
echo "CSR Response Time ".$csr_overall_response."<br>";

echo "CPR Total Request ".$cpr_overall_req."<br>";
echo "CPR Delay ".$cpr_overall_delay."<br>";
echo "CPR Ahead of Time ".$cpr_overall_ahead."<br>";
echo "CPR On Time ".$cpr_overall_ontime."<br>";
echo "CPR Response Time ".$cpr_overall_response."<br>";

echo "DRR Total Request ".$drr_overall_req."<br>";
echo "DRR Delay ".$drr_overall_delay."<br>";
echo "DRR Ahead of Time ".$drr_overall_ahead."<br>";
echo "DRR On Time ".$drr_overall_ontime."<br>";
echo "DRR Response Time ".$drr_overall_response."<br>";

echo "QA Total Request ".$qa_overall_req."<br>";
echo "QA Delay ".$qa_overall_delay."<br>";
echo "QA Ahead of Time ".$qa_overall_ahead."<br>";
echo "QA On Time ".$qa_overall_ontime."<br>";
echo "QA Response Time ".$qa_overall_response."<br>";

echo "Other Request ".$other_request_overall."<br>";
echo "Assigned ".$assigned_overall."<br> Work in Progress ".$workinprogress_overall."<br>";
echo "Delay ".$delay_overall."<br> Ahead of Time ".$ahead_overall."<br> On Time ".$ontime_overall."<br> Total Manhour ".$overall_manhour;


/*
$exp_assigned   = array_filter(explode(",",$assigned));
echo "Assigned: ".count($exp_assigned)."<br>";
$exp_workinprogress   = array_filter(explode(",",$workinprogress));
echo "Work in Progress: ".count($exp_workinprogress)."<br>";
$csr_time = array_filter(explode(",",$csr_time));

$cpr_time = array_filter(explode(",",$cpr_time));
echo (array_sum($csr_time) + array_sum($cpr_time))/$get_info->rowCount();

*/


function timeCalc($start, $end){
    
    $start_date                 = strtotime($start . ' +8 hours');
    $start_date_converted       = floatval(25569 + $start_date / 86400);
    
    $end_date                   = strtotime($end . ' +8 hours');
    $end_date_converted         = floatval(25569 + $end_date / 86400);
    
    $response_time              = floatval(($end_date_converted - $start_date_converted));
    $response_time_converted    = number_format((float)$response_time, 2, '.', '');
    
    return $response_time_converted;
}

function responseVal($response_time){
    
    switch(true){
            
        case $response_time > 1.25:
            
            $response = "Delay";
            
            break;
            
        case $response_time < 1.25:
            
            $response = "Ahead of Time";
            
            break;
            
        default:
            
            $response = "On Time";
            
            break;
    }
    
    return $response;
    
}

$wop = array("members-wop", "wop-wop");

print_r(array_count_values($wop));

echo array_search("wop", $wop);

?>