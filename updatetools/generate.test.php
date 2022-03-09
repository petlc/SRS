<?php
require_once 'db.connections.php';

$months         = array(
    "12-16;01-15"=>"January",
    "01-16;02-15"=>"February",
    "02-16;03-15"=>"March",
    "03-16;04-15"=>"April",
    "04-16;05-15"=>"May",
    "05-16;06-15"=>"June",
    "06-16;07-15"=>"July",
    "07-16;08-15"=>"August",
    "08-16;09-15"=>"September",
    "09-16;10-15"=>"October",
    "10-16;11-15"=>"November",
    "11-16;12-15"=>"December");

$month_dates    = array("12-16;01-15","01-16;02-15","02-16;03-15","03-16;04-15","04-16;05-15","05-16;06-15","06-16;07-15","07-16;08-15","08-16;09-15","09-16;10-15","10-16;11-15","11-16;12-15");

$status_list    = array('Newly Created', 'Not Approve', 'For Checking', 'For Approval', 'New Request', 'Assigned', 'Work in Progress', 'Done', 'MIS Checker', 'Closed', 'Cancelled');

$process_list   = array("CSR", "CPR", "DRR", "QA");

$response_val   = array("Ahead of Time", "On Time", "Delay", "Cancelled");

$get_emp        = new Update();

$get_emp->query("Select full_name from employees where department like '%MIS%'");
$get_emp->execute();

$mis_emp = array();
foreach($get_emp->resultSet() as $emp){
    $mis_emp[] = $emp['full_name'];
}

$_POST['month'] = "February";
$_POST['year']  = "2018";


if(!empty($_POST['month']) && !empty($_POST['year'])){
    
    $month          = $_POST['month'];
    
    $date           = array_search($month, $months);

    $year           = $_POST['year'];
    $dates          = explode(";",$date);
    
    if($dates[0] == "12-16"){
        $start            = ($year-1)."-".$dates[0];
        $res            = "good";
    }else{
        $start            = $year."-".$dates[0]; 
        $res            = "no good";
    }
    $end            = $year."-".$dates[1];
    
    echo $month."<br>";
    
    $status_overall_count     = array();
    $status_mnhr_count        = array();
    
    foreach($status_list as $stats){

        $stats_response[$stats] = StatusResponse($start,$end,$stats);
        echo $stats.": ".count($stats_response[$stats][0])."<br>";
        //print_r($stats_response[$stats][0]);
        
        $cnt_delay          = array();
        $cnt_ontime         = array();
        $cnt_ahead          = array();
        $cnt_mnhr           = array();
        $per_status_count   = array();
        
        $prsnl_cnt_status   = array();
        $prsnl_ahead        = array();
        $prsnl_ontime       = array();
        $prsnl_delay        = array();
        
        foreach($stats_response[$stats][0] as $info){
            //echo count($info)."<br>";
            //echo $info[0]."<br>";
            
            switch($info[0]){
                    
                case"Ahead of Time":
                    
                    $cnt_ahead[]    = $info[3];
                    $prsnl_ahead[]  = $info[2];
                    
                    break;
                    
                case"On Time":
                    
                    $cnt_ontime[]   = $info[3];
                    $prsnl_ontime[] = $info[2];
                    
                    break;
                    
                case"Delay":
                    
                    $cnt_delay[]    = $info[3];
                    $prsnl_delay[]  = $info[2];
                    break;
            }
            
            $cnt_mnhr[]         = $info[1];
            $prsnl_cnt_status[] = $info[2];
            
            
        }
        
        $prsnl_cnt_info = array_count_values($prsnl_cnt_status);
        $status_mnhr_count[] =  array_sum($cnt_mnhr);
        
        $prsnl_ahead_info = array_count_values($prsnl_ahead);
        $prsnl_ontime_info = array_count_values($prsnl_ontime);
        $prsnl_delay_info = array_count_values($prsnl_delay);
        
        switch($stats){
                
            case"Assigned":
                echo "--Ahead of Time ".count($cnt_ahead)."<br>";
                foreach($mis_emp as $emp){
                    if(!empty($prsnl_ahead_info[$emp])){
                        echo "--*".$emp." ".$prsnl_ahead_info[$emp]."<br>";
                    }
                }
                
                echo "--On Time ".count($cnt_ontime)."<br>";
                foreach($mis_emp as $emp){
                    if(!empty($prsnl_ontime_info[$emp])){
                        echo "--*".$emp." ".$prsnl_ontime_info[$emp]."<br>";
                    }
                }
                
                echo "--No Action ".count($cnt_delay)."<br>";
                foreach($mis_emp as $emp){
                    if(!empty($prsnl_delay_info[$emp])){
                        echo "--*".$emp." ".$prsnl_delay_info[$emp]."<br>";
                    }
                }
                
                break;
                
             case"Work in Progress":
                echo "--Ahead of Time ".count($cnt_ahead)."<br>";
                foreach($mis_emp as $emp){
                    if(!empty($prsnl_ahead_info[$emp])){
                        echo "--*".$emp." ".$prsnl_ahead_info[$emp]."<br>";
                    }
                }
                echo "--On Time ".count($cnt_ontime)."<br>";
                foreach($mis_emp as $emp){
                    if(!empty($prsnl_ontime_info[$emp])){
                        echo "--*".$emp." ".$prsnl_ontime_info[$emp]."<br>";
                    }
                }
                echo "--Pending ".count($cnt_delay)."<br>";
                foreach($mis_emp as $emp){
                    if(!empty($prsnl_delay_info[$emp])){
                        echo "--*".$emp." ".$prsnl_delay_info[$emp]."<br>";
                    }
                }
                break;
                
            case"Newly Created":
            case"Not Approve":
            case"For Checking":
            case"For Approval":
                
                break;
                
            default:
                echo "--Ahead of Time ".count($cnt_ahead)."<br>";
                echo "--On Time ".count($cnt_ontime)."<br>";
                echo "--Delay ".count($cnt_delay)."<br>";
                
                break;
        }
        
        $status_overall_count[] = count($stats_response[$stats][0]);
        $per_status_count[]     = array_sum($status_mnhr_count);
        
        
    }
    $overall_hours   = array_sum($per_status_count);
    $overall_request = array_sum($status_overall_count);
    echo "Total Request: ".$overall_request."<br>";
    echo $overall_hours/$overall_request;
    
    echo "<br><br>";
    
    foreach($mis_emp as $emp){
        
        echo $emp."<br>";
        
        foreach($status_list as $stats){
            
            $info[$emp][$stats] = AssignedStatus($start,$end,$stats,$emp);
            
            //print_r($info[$emp][$stats][1]);
            echo $stats." : ".$info[$emp][$stats][0]."<br>";
            //print_r($info[$emp][$stats][3]);
            //echo "<br>";
        }
        echo "<br>";
    }
    
}elseif(!empty($_POST['year'])){
    
    $year           = $_POST['year'];
     
    
    $month_names = array("January","February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    
    for($m=0;$m < count($month_names); $m++){
        
        $date           = array_search($month_names[$m], $months);
        
        $dates          = explode(";",$date);
    
        if($dates[0] == "12-16"){
            $start            = ($year-1)."-".$dates[0];
            $res            = "good";
        }else{
            $start            = $year."-".$dates[0]; 
            $res            = "no good";
        }
        $end            = $year."-".$dates[1];
        
        echo $month_names[$m]."<br>";
        echo $start." ".$end."<br>"; 
        
        //echo $month."<br>";
    
        $status_overall_count = array();
        $per_status_count     = array();
           
        $monthly_ahead        = array();
        $status_ahead         = array();
        
        $monthly_ontime       = array();
        $status_ontime        = array();
        
        $monthly_delay        = array();
        $status_delay         = array();

        $cnt_delay          = array();
        $cnt_ontime         = array();
        $cnt_ahead          = array();
        $cnt_mnhr           = array();
        $per_status_count   = array();
        
        foreach($status_list as $stats){

            $stats_response[$stats] = StatusResponse($start,$end,$stats);
            $per_status_count[]     = count($stats_response[$stats][0]);
            //echo $stats.": ".count($stats_response[$stats][0])."<br>";
            //print_r($stats_response[$stats][0]);
            
            foreach($stats_response[$stats][0] as $info){
            //echo count($info)."<br>";
            //echo $info[0]."<br>";
            
                switch($info[0]){

                    case"Ahead of Time":

                        $cnt_ahead[]    = $info[3];
                        $prsnl_ahead[]  = $info[2];

                        break;

                    case"On Time":

                        $cnt_ontime[]   = $info[3];
                        $prsnl_ontime[] = $info[2];

                        break;

                    case"Delay":

                        $cnt_delay[]    = $info[3];
                        $prsnl_delay[]  = $info[2];
                        break;
                }
            
                $cnt_mnhr[]         = $info[1];
                $prsnl_cnt_status[] = $info[2];


            }
            
            /*
            //print_r($assigned_response);
            $response_count = array_count_values($stats_response[$stats][1]);

            if(empty($response_count['Ahead of Time'])){

            }else{
                //echo "--Ahead: ".$response_count['Ahead of Time']."<br>";
                $status_ahead[]         = $response_count['Ahead of Time']; 
            }

            if(empty($response_count['On Time'])){

            }else{
                //echo "--OnTime: ".$response_count['On Time']."<br>";
                $status_ontime[]        = $response_count['On Time'];
            }

            if(empty($response_count['Delay'])){

            }else{

                if($stats == "Assigned"){
                    $title = "--No Action: ";
                }elseif($stats == "Work in Progress"){
                    $title = "--Pending : ";
                }else{
                    $title = "--Delay: ";
                }
                //echo $title.$response_count['Delay']."<br>";
                $status_delay[]         = $response_count['Delay'];
            }
            //$status_ahead[]         = $response_count['Ahead of Time'];
            $status_overall_count[] = $stats_response[$stats][0];
            $per_status_count[]     = array_sum($stats_response[$stats][2]);
            */
        }
        /*
        echo count($cnt_ahead);
        $status_ahead[] = $cnt_ahead;
        $monthly_ahead[]   = array_sum($status_ahead);
        echo "Monthly Ahead ".array_sum($status_ahead)."<br>";
        
        $monthly_ontime[]   = array_sum($status_ontime);
        echo "Monthly Ontime ".array_sum($status_ontime)."<br>";
        
        $monthly_delay[]   = array_sum($status_delay);
        echo "Monthly Delay ".array_sum($status_delay)."<br>";
        
        $overall_hours   = array_sum($per_status_count);
        $overall_request = array_sum($status_overall_count);
        echo "Total Request: ".$overall_request."<br>";
        */
        
        echo "Monthly Ahead ".count($cnt_ahead)."<br>";
        echo "Monthly Ontime ".count($cnt_ontime)."<br>";
        echo "Monthly Ontime ".count($cnt_delay)."<br>";
        
        $overall_hours   = array_sum($cnt_mnhr);
        $overall_request = array_sum($per_status_count);
        echo "Total Request: ".$overall_request."<br>";
        if($overall_request == "0"){
            echo "No advance data for now <br>";
        }else{
            
        echo "Total Manhour: ".$overall_hours/$overall_request."<br>";
        }
        
    }
    
}

function requestInfo($start,$end){
    
    $get_info   = new Update();

    $get_info->query("Select ic_no, prcss_no, ic_status, ic_crtd_date, ic_rqst_date, assigned_to, done_date from srvcrqst where ic_crtd_date between '$start' and '$end' ");
    $get_info->execute();
    
    $count = $get_info->rowCount();
    
    $info       = array();
    $hour       = array();
    $assigned   = array();
    
    foreach($get_info->resultset() as $rows){
        $ic_no    = $rows['ic_no'];
        $status   = $rows['ic_status']; 
        $assigned = $rows['assigned_to'];
        $created  = $rows['ic_crtd_date'];
        $request  = $rows['ic_rqst_date'];
        $done     = $rows['done_date'];
        $prcss    = $rows['prcss_no'];
        
        $info[] = $ic_no."/".$status."/".$assigned."/".$created."/".$request."/".$done."/".$prcss;
    }
    
    return $info;
}

function StatusResponse($start,$end,$status){
    
    $get_info   = new Update();

    $get_info->query("Select ic_no, prcss_no, ic_status, ic_crtd_date, ic_rqst_date, assigned_to, done_date from srvcrqst where ic_crtd_date between '$start' and '$end' and ic_status='$status' ");
    $get_info->execute();
    
    $count = $get_info->rowCount();
    
    //$info       = array();
    //$hour       = array();
    //$assigned   = array();
    //$ic_no      = array();
    $full_info  = array();
    foreach($get_info->resultset() as $rows){
        $ic_no  = $rows['ic_no'];
        $status   = $rows['ic_status']; 
        $assigned= $rows['assigned_to'];
        $created  = $rows['ic_crtd_date'];
        $request  = $rows['ic_rqst_date'];
        $done     = $rows['done_date'];
        $today    = date('Y-m-d H:i');
        $prcss    = $rows['prcss_no'];
        $prcss_dtls  = array_filter(explode("-",$prcss));
            
        //echo $prcss;
        
        switch($status){
                    
            case"Assigned":
                
                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($request,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($created,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;
                    }

                break;

            case"Work in Progress":

                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($request,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($created,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;
                    }

                    break;

            case"Done":
            case"Closed":

                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($request,$done);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($created,$done);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;
                }

                break;

            default:
                
                $response_time = "0";
                
                $response_val  = $status;

                //$info[]= $response_val;

                break;


        }
        
        //$get_info->query("Update srvcrqst set response='$response_val' where ic_no ='$ic_no'");
        //$get_info->execute();
        //$info[] = $response_val;
        //$hour[] = $response_time;
        $full_info[] = array($response_val,$response_time,$assigned,$ic_no);
    }
    
    return array($full_info);
}

function AssignedStatus($start,$end,$status,$assigned){
    
    $get_info   = new Update();

    $get_info->query("Select ic_no, prcss_no, ic_status, ic_crtd_date, ic_rqst_date, assigned_to, done_date from srvcrqst where ic_crtd_date between '$start' and '$end' and ic_status='$status' and assigned_to='$assigned' ");
    $get_info->execute();
    
    $count = $get_info->rowCount();
    
    $info       = array();
    $hour       = array();
    $assigned   = array();
    $ic_no      = array();
    
    foreach($get_info->resultset() as $rows){
        $ic_no[]  = $rows['ic_no'];
        $status   = $rows['ic_status']; 
        $assigned[]= $rows['assigned_to'];
        $created  = $rows['ic_crtd_date'];
        $request  = $rows['ic_rqst_date'];
        $done     = $rows['done_date'];
        $today    = date('Y-m-d H:i');
        $prcss    = $rows['prcss_no'];
        $prcss_dtls  = array_filter(explode("-",$prcss));
            
        //echo $prcss;
        
        switch($status){
                    
            case"Assigned":
                
                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($request,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($created,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;
                    }

                break;

            case"Work in Progress":

                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($request,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($created,$today);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;
                    }

                    break;

            case"Done":
            case"Closed":

                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($request,$done);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($created,$done);

                        $response_val  = responseVal($response_time);

                        //$info[]= $response_val;

                        break;
                }

                break;

            default:
                
                $response_time = "0";
                
                $response_val  = $status;

                //$info[]= $response_val;

                break;


        }
        
        //$get_info->query("Update srvcrqst set response='$response_val' where ic_no ='$ic_no'");
        //$get_info->execute();
        $info[] = $response_val;
        $hour[] = $response_time;
    }
    
    return array($count,$info,$hour,$ic_no);
}

function MonthlyResponse($start, $end, $response){
    
    $get_info   = new Update();

    $get_info->query("Select response from srvcrqst where ic_crtd_date between '$start' and '$end' and response = '$response' ");
    $get_info->execute();
    return $get_info->rowCount();
    /*
    foreach($get_info->resultset() as $rows){
        $ic_no    = $rows['ic_no'];
        $status   = $rows['ic_status']; 
        $assigned = $rows['assigned_to'];
        $created  = $rows['ic_crtd_date'];
        $request  = $rows['ic_rqst_date'];
        $done     = $rows['done_date'];
        $today    = date('Y-m-d H:i');
        $prcss    = $rows['prcss_no'];
        $prcss_dtls  = array_filter(explode("-",$prcss));
            
        //echo $prcss;
        
        switch($status){
                    
            case"Assigned":
                $response_time = timeCalc($created,$today);

                $response_val  = responseVal($response_time);

                $info[]= $response_val;

                break;

            case"Work in Progress":

                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($created,$today);

                        $response_val  = responseVal($response_time);

                        $info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($request,$today);

                        $response_val  = responseVal($response_time);

                        $info[]= $response_val;

                        break;
                    }

                    break;

            case"Done":
            case"Closed":

                switch($prcss_dtls[0]){

                    case"QA":
                    case"CSR":    

                        $response_time = timeCalc($created,$done);

                        $response_val  = responseVal($response_time);

                        $info[]= $response_val;

                        break;

                    case"CPR":
                    case"DRR":

                        $response_time = timeCalc($request,$done);

                        $response_val  = responseVal($response_time);

                        $info[]= $response_val;

                        break;
                }

                break;

            default:

                $response_val  = $status;

                $info[]= $response_val;

                break;


        }
        
        //$get_info->query("Update srvcrqst set response='$response_val' where ic_no ='$ic_no'");
        //$get_info->execute();
        
    }*/
}

function responseInfo($status, $created, $request, $done, $prcss){
    $today    = date('Y-m-d H:i');
    
    switch($status){
                    
        case"Assigned":
                
            switch($prcss){

                case"QA":
                case"CSR":    

                    $response_time = timeCalc($request,$today);

                    $response_val  = responseVal($response_time);

                    //$info[]= $response_val;

                    break;

                case"CPR":
                case"DRR":

                    $response_time = timeCalc($created,$today);

                    $response_val  = responseVal($response_time);

                    //$info[]= $response_val;

                    break;
            }

            break;

        case"Work in Progress":

            switch($prcss){

                case"QA":
                case"CSR":    

                    $response_time = timeCalc($request,$today);

                    $response_val  = responseVal($response_time);

                    //$info[]= $response_val;

                    break;

                case"CPR":
                case"DRR":

                    $response_time = timeCalc($created,$today);

                    $response_val  = responseVal($response_time);

                    //$info[]= $response_val;

                    break;
            }

            break;

        case"Done":
        case"Closed":

            switch($prcss){

                case"QA":
                case"CSR":    

                    $response_time = timeCalc($request,$done);

                    $response_val  = responseVal($response_time);

                    //$info[]= $response_val;

                    break;

                case"CPR":
                case"DRR":

                    $response_time = timeCalc($created,$done);

                    $response_val  = responseVal($response_time);

                    //$info[]= $response_val;

                    break;
            }

            break;

        default:
                
            $response_time = "0";
                
            $response_val  = $status;

            //$info[]= $response_val;

            break;


    }
    
    return array($response_time, $response_val);
}


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
?>