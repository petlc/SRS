<?php
function reportMonthlyPrchs($start_date, $end_date, $prchs, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_rqst like '%$prchs%' and ic_site = '$site'";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_rqst like '%$prchs%'";
    }

    $monthly_prchs = new Report();

    $monthly_prchs->query($query);
    $monthly_prchs->bind(':start',$start_date );
    $monthly_prchs->bind(':end',$end_date );
    $monthly_prchs->execute();

    $row = $monthly_prchs->single();

    return $row['count(ic_id)'];
}

function reportMonthlySupport($start_date, $end_date, $site){

    if (!empty($site)) {
        // code...
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License' )";
    }else{
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License') ";
    }

    $monthly_prchs = new Report();

    $monthly_prchs->query($query);
    $monthly_prchs->bind(':start',$start_date );
    $monthly_prchs->bind(':end',$end_date );
    $monthly_prchs->execute();

    $row = $monthly_prchs->single();

    return $row['count(ic_id)'];
}


function reportMonthlyMIS($start_date, $end_date, $site){

    if (!empty($site)) {
        // code...
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_site = '$site'";
    }else{
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed')";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function reportMonthlyPrcss($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        //$query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License' )";
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        //$query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License') ";
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssSupport($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'Renewal License','License Renewal' ) and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and prcss_no like '%$prcss%' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'Renewal License', 'License Renewal') and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed')  ";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssSupportComplete($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License' )";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('Done', 'Closed') and prcss_no like '%$prcss%' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License') ";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssSupportNotComplete($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress') and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License' )";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress') and prcss_no like '%$prcss%' and ic_rqst not in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License') ";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssPurchase($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst in('Software Purchase', 'Hardware Purchase', 'Renewal License' ) and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed')";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and prcss_no like '%$prcss%' and ic_rqst in('Software Purchase', 'Hardware Purchase', 'Renewal License') and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed')";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssPurchaseComplete($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License' )";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('Done', 'Closed') and prcss_no like '%$prcss%' and ic_rqst in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License') ";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssPurchaseNotComplete($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress') and prcss_no like '%$prcss%' and ic_site = '$site' and ic_rqst in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License' )";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site' ";
    }else{
        $query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress') and prcss_no like '%$prcss%' and ic_rqst in('Software Purchase', 'Hardware Purchase', 'License Renewal', 'Renewal License') ";
        //$query = "Select count(ic_id) from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'  ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $row = $monthly_check->single();

    return $row['count(ic_id)'];
}

function reportMonthlyPrcssHrs($start_date, $end_date, $prcss, $site){

    if (!empty($site)) {
        // code...
        //$query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%' and ic_site = '$site'";
        $query = "Select ic_no, acknowledged_date, done_date from srvcrqst where ic_crtd_date between :start and :end and ic_status in ('Done', 'Closed') and ic_rqst not like '%Purchase%' and ic_rqst not like '%Renewal%' and ic_rqst not like '%Investment%' and prcss_no like '%$prcss%' and ic_site = '$site'";
    }else{
        //$query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status in('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no like '%$prcss%'";
        $query = "Select ic_no, acknowledged_date, done_date from srvcrqst where ic_crtd_date between :start and :end and ic_status in ('Done', 'Closed') and ic_rqst not like '%Purchase%' and ic_rqst not like '%Renewal%' and ic_rqst not like '%Investment%' and prcss_no like '%$prcss%'";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    if($monthly_check->rowCount() > 0){
        $row = $monthly_check->resultset();
        $total = $monthly_check->rowCount();

        for ($i=0; $i < $total; $i++) {
            // code...
            if ( $row[$i]['done_date'] == 0) {
                // code...
                $manhour[] = 0;
            }else{

                $datetime1 = $row[$i]['acknowledged_date'];
                $datetime2 = $row[$i]['done_date'];
                $date_create1 = date_create($datetime1);
                $date_create2 = date_create($datetime2);
                $interval = ($date_create2->getTimestamp() - $date_create1->getTimestamp())/3600;
                //echo substr($datetime1, 0,10);
                //echo $interval->format(' %h.%i');
                $difference = $interval;
                //echo $difference." ";

                if (substr($datetime1, 0,10) != substr($datetime2, 0,10)) {
                    // code...
                    $start = new DateTime(substr($datetime1, 0,10));
                    $end = new DateTime(substr($datetime2, 0,10));
                    //Define our holidays
                    //New Years Day
                    //Martin Luther King Day
                    $holidays = array(
                        '2017-08-21',
                    	'2017-08-27',
                    	'2017-11-01',
                    	'2017-11-02',
                    	'2017-11-30',
                    	'2017-12-25',
                    	'2017-12-26',
                    	'2017-12-27',
                    	'2017-12-28',
                    	'2017-12-29',
                    	'2018-01-01',
                    	'2018-02-16',
                    	'2018-03-29',
                    	'2018-03-30',
                    	'2018-04-09',
                    	'2018-05-01',
                    	'2018-06-12',
                    	'2018-08-21',
                    	'2018-08-27',
                    	'2018-11-01',
                    	'2018-11-02',
                    	'2018-11-30',
                    	'2018-12-24',
                    	'2018-12-25',
                    	'2018-12-26',
                    	'2018-12-27',
                    	'2018-12-28',
                    	'2018-12-31',
                    	'2019-01-01',
                    	'2018-02-05',
                    	'2019-02-25',
                    	'2019-04-09',
                    	'2019-04-18',
                    	'2019-04-19',
                    	'2019-05-01',
                    	'2020-01-01',
                    	'2020-02-16',
                    	'2020-03-29',
                    	'2020-03-30',
                    	'2020-04-09',
                    	'2020-05-01',
                    	'2020-06-12',
                    	'2020-08-21',
                    	'2020-08-27',
                    	'2020-11-01',
                    	'2020-11-02',
                    	'2020-11-30',
                    	'2020-12-24',
                    	'2020-12-25',
                    	'2020-12-26',
                    	'2020-12-27',
                    	'2020-12-28',
                    	'2020-12-31',
                    	'2021-01-01',
                    	'2021-02-16',
                    	'2021-03-29',
                    	'2021-03-30',
                    	'2021-04-09',
                    	'2021-05-01',
                    	'2021-06-12',
                    	'2021-08-21',
                    	'2021-08-27',
                    	'2021-11-01',
                    	'2021-11-02',
                    	'2021-11-30',
                    	'2021-12-24',
                    	'2021-12-25',
                    	'2021-12-26',
                    	'2021-12-27',
                    	'2021-12-28',
                    	'2021-12-31',

                    );
                    //Create a DatePeriod with date intervals of 1 day between start and end dates
                    $period = new DatePeriod( $start, new DateInterval( 'P1D' ), $end );

                    //Holds valid DateTime objects of valid dates
                    $days = array();
                    $offdays = array();
                    //iterate over the period by day
                    foreach( $period as $day )
                    {
                        //print_r($day);
                            //If the day of the week is not a weekend
                    	$dayOfWeek = $day->format( 'N' );

                    	if( $dayOfWeek < 6 ){
                                    //If the day of the week is not a pre-defined holiday
                    		$format = $day->format( 'Y-m-d' );
                    		if( false === in_array( $format, $holidays ) ){
                                            //Add the valid day to our days array
                                            //This could also just be a counter if that is all that is necessary
                                            //echo " ".$dayOfWeek."<br>";
                    			$days[] = $day;
                    		}else{
                                $offdays[] = $day;
                            }
                    	}else{
                            $format = $day->format( 'Y-m-d' );
                            $offdays[] = $day;
                        }
                    }
                    $rest_multiplier = count( $days );
                    //echo $rest_multiplier."<br>";
                    $off_count = count( $offdays );
                    //echo $off_count."<br>";
                    $rest = 9; // 9hrs off Work
                    //$difference = $rest_multiplier * 24;
                    $overall_rest = ($rest_multiplier * $rest)+($off_count * 24);
                    /*
                    $hrs_per_day = (24 * $rest_multiplier);
                    $total_hours  = (($hrs_per_day + $difference) - $overall_rest);
                    */
                    $total_hours  = ($difference - $overall_rest);
                    //echo $total_hours;
                    //$hour = (0.0625 * $total_hours);
                    //echo number_format((float)$hour, 2, '.', '');
                    $hour   =   $total_hours;
                }else{
                    //$hour = (0.0625 * $difference);
                    //echo number_format((float)$hour, 2, '.', '');
                    $hour   =   $difference;
                }
                //echo number_format((float)$hour, 2, '.', '')."<br>";
                $manhour[] = (number_format((float)$hour, 2, '.', ''));

            }

        }

        $overall_manhour = array_sum($manhour);

    }else{
        $overall_manhour = "0";
    }

    return $overall_manhour;
}

function reportMonthlyMISManhr($start_date, $end_date, $site){

    //echo $start_date;
    if (!empty($site)) {
        // code...
        $query = "Select ic_no, acknowledged_date, done_date from srvcrqst where ic_crtd_date between :start and :end and ic_status in ('Done', 'Closed') and ic_rqst not like '%Purchase%' and ic_rqst not like '%Renewal%' and ic_rqst not like '%Investment%' and ic_site = '$site'";

    }else{

        $query = "Select ic_no, acknowledged_date, done_date from srvcrqst where ic_crtd_date between :start and :end and ic_status in ('Done', 'Closed') and ic_rqst not like '%Purchase%' and ic_rqst not like '%Renewal%' and ic_rqst not like '%Investment%'";

    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    if($monthly_check->rowCount() > 0){
        $row = $monthly_check->resultset();
        $total = $monthly_check->rowCount();

        for ($i=0; $i < $total; $i++) {
            // code...
            if ( $row[$i]['done_date'] == 0) {
                // code...
                $manhour[] = 0;
            }else{

                $datetime1 = $row[$i]['acknowledged_date'];
                $datetime2 = $row[$i]['done_date'];
                $date_create1 = date_create($datetime1);
                $date_create2 = date_create($datetime2);
                $interval = ($date_create2->getTimestamp() - $date_create1->getTimestamp())/3600;
                //echo substr($datetime1, 0,10);
                //echo $interval->format(' %h.%i');
                $difference = $interval;
                //echo $difference." ";

                if (substr($datetime1, 0,10) != substr($datetime2, 0,10)) {
                    // code...
                    $start = new DateTime(substr($datetime1, 0,10));
                    $end = new DateTime(substr($datetime2, 0,10));
                    //Define our holidays
                    //New Years Day
                    //Martin Luther King Day
                    $holidays = array(
                        '2017-08-21',
                    	'2017-08-27',
                    	'2017-11-01',
                    	'2017-11-02',
                    	'2017-11-30',
                    	'2017-12-25',
                    	'2017-12-26',
                    	'2017-12-27',
                    	'2017-12-28',
                    	'2017-12-29',
                    	'2018-01-01',
                    	'2018-02-16',
                    	'2018-03-29',
                    	'2018-03-30',
                    	'2018-04-09',
                    	'2018-05-01',
                    	'2018-06-12',
                    	'2018-08-21',
                    	'2018-08-27',
                    	'2018-11-01',
                    	'2018-11-02',
                    	'2018-11-30',
                    	'2018-12-24',
                    	'2018-12-25',
                    	'2018-12-26',
                    	'2018-12-27',
                    	'2018-12-28',
                    	'2018-12-31',
                    	'2019-01-01',
                    	'2018-02-05',
                    	'2019-02-25',
                    	'2019-04-09',
                    	'2019-04-18',
                    	'2019-04-19',
                    	'2019-05-01',

                    );
                    //Create a DatePeriod with date intervals of 1 day between start and end dates
                    $period = new DatePeriod( $start, new DateInterval( 'P1D' ), $end );

                    //Holds valid DateTime objects of valid dates
                    $days = array();
                    $offdays = array();
                    //iterate over the period by day
                    foreach( $period as $day )
                    {
                        //print_r($day);
                            //If the day of the week is not a weekend
                    	$dayOfWeek = $day->format( 'N' );

                    	if( $dayOfWeek < 6 ){
                                    //If the day of the week is not a pre-defined holiday
                    		$format = $day->format( 'Y-m-d' );
                    		if( false === in_array( $format, $holidays ) ){
                                            //Add the valid day to our days array
                                            //This could also just be a counter if that is all that is necessary
                                            //echo " ".$dayOfWeek."<br>";
                    			$days[] = $day;
                    		}else{
                                $offdays[] = $day;
                            }
                    	}else{
                            $format = $day->format( 'Y-m-d' );
                            $offdays[] = $day;
                        }
                    }
                    $rest_multiplier = count( $days );
                    //echo $rest_multiplier."<br>";
                    $off_count = count( $offdays );
                    //echo $off_count."<br>";
                    $rest = 9; // 9hrs off Work
                    //$difference = $rest_multiplier * 24;
                    $overall_rest = ($rest_multiplier * $rest)+($off_count * 24);
                    /*
                    $hrs_per_day = (24 * $rest_multiplier);
                    $total_hours  = (($hrs_per_day + $difference) - $overall_rest);
                    */
                    $total_hours  = ($difference - $overall_rest);
                    //echo $total_hours;
                    //$hour = (0.0625 * $total_hours);
                    //echo number_format((float)$hour, 2, '.', '');
                    $hour   =   $total_hours;
                }else{
                    //$hour = (0.0625 * $difference);
                    //echo number_format((float)$hour, 2, '.', '');
                    $hour   =   $difference;
                }
                //echo number_format((float)$hour, 2, '.', '')."<br>";
                $manhour[] = (number_format((float)$hour, 2, '.', ''));

            }

        }

        $overall_manhour = array_sum($manhour);

    }else{
        $overall_manhour = "0";
    }

    return $overall_manhour;
}

function reportMonthlyMISStatus($start_date, $end_date, $status, $site){


    if (!empty($site)) {
        // code...
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status = :ic_status and ic_site = '$site'";
    }else{
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status = :ic_status";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->bind(':ic_status',$status );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function reportMonthlyMISStatusWoutPurchase($start_date, $end_date, $status, $site){


    if (!empty($site)) {
        // code...
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status = :ic_status and ic_site = '$site' and ic_rqst NOT LIKE '%Purchase%' and ic_rqst NOT LIKE '%Renewal%' and ic_rqst not like '%Investment%' ";
    }else{
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_status = :ic_status";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->bind(':ic_status',$status );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function reportMonthlyMISAhead($start_date, $end_date, $site){

    if (!empty($site)) {
        // code...
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date > done_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_site = '$site' and prcss_no NOT LIKE '%QA%'";
    }else{
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date > done_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function reportMonthlyMISOntime($start_date, $end_date, $site){

    if (!empty($site)) {
        // code...
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date = done_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_site = '$site'  and prcss_no NOT LIKE '%QA%'";
    }else{
        $query = "Select ic_id from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date = done_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}
function reportMonthlyMISDelay($start_date, $end_date, $site){

    if (!empty($site)) {
        // code...
        $query = "Select * from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date < done_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_site = '$site'  and prcss_no NOT LIKE '%QA%'";
    }else{
        $query = "Select * from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date < done_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}

function reportMonthlyPrcssDelay($start_date, $end_date, $prcss, $site){

    $current_date = date('y-m-d');

    if (!empty($site)) {
        // code...
        $query = "Select * from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date < :current_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_site = '$site' and prcss_no NOT LIKE '%QA%' and prcss_no like '%$prcss%'";
    }else{
        $query = "Select * from srvcrqst where ic_crtd_date between :start and :end and ic_rqst_date < :current_date and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and prcss_no NOT LIKE '%QA%' and prcss_no like '%$prcss%'";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->bind(':current_date',$current_date );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}


function reportMonthlyMISMembers($start_date, $end_date, $site){

    if (!empty($site)) {
        // code...
        $query = "Select assigned_to, COUNT(*) from srvcrqst where ic_crtd_date between :start and :end and assigned_to != '' and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') and ic_site = '$site' group by assigned_to";
    }else{
        $query = "Select assigned_to, COUNT(*) from srvcrqst where ic_crtd_date between :start and :end and assigned_to != '' and ic_status in ('New Request','Assigned', 'Work in Progress', 'Done', 'Closed') group by assigned_to ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->execute();

    $members = array();
    $member_count = $monthly_check->rowCount();
    $member_name  = $monthly_check->resultset();

    for ($i=0; $i < $member_count; $i++) {
        // code...
        $members[] = array($member_name[$i]['assigned_to'],$member_name[$i]['COUNT(*)']);
    }

    return $members;
}

function reportMonthlyMISMembersAssigned($start_date, $end_date, $name, $status, $site){

    if (!empty($site)) {
        // code...
        $query = "Select assigned_to from srvcrqst where ic_crtd_date between :start and :end and ic_status = :status and assigned_to = :assigned_to and ic_site = '$site' ";
    }else{
        $query = "Select assigned_to from srvcrqst where ic_crtd_date between :start and :end and ic_status = :status and assigned_to = :assigned_to ";
    }

    $monthly_check = new Report();

    $monthly_check->query($query);
    $monthly_check->bind(':start',$start_date );
    $monthly_check->bind(':end',$end_date );
    $monthly_check->bind(':assigned_to',$name );
    $monthly_check->bind(':status',$status );
    $monthly_check->execute();

    return $monthly_check->rowCount();
}


function getMembers($site){

    if (!empty($site)) {
        // code...

        if ($site == "HO") {
            // code...
            $site = "MNL";
        }else{
            $site = "ILO";
        }
        $query = "Select full_name from emp_info where department ='MIS' and branch = '$site'";
    }else{
        $query = "Select full_name from emp_info where department ='MIS'";
    }

    $get_members = new Employees();

    $get_members->query($query);
    $get_members->execute();

    $members = array();

    $row = $get_members->resultset();

    foreach ($row as $key => $value) {
        // code...
        $members[] = $value['full_name']."<br>";
    }

    return $members;

}

?>
