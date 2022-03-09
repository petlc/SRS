<?php
require_once '../function/core.php';
ini_set('max_execution_time', 600); //300 seconds = 5 minutes
$closed_null = new Report();

$start_date     = "2020-06-16";
$end_date      = "2021-02-15";

//$closed_null->query("Select * from srvcrqst where ic_crtd_date like '%2018-%' and ic_status in ('Done','Closed') ");
$closed_null->query("Select * from srvcrqst where ic_crtd_date between :start and :end and ic_status in ('Done','Closed')  and ic_rqst not like '%Purchase%' and ic_rqst not like '%Renewal%'");
$closed_null->bind(':start',$start_date );
$closed_null->bind(':end',$end_date );
$closed_null->execute();

echo $closed_null->rowCount()."<br>";



if($closed_null->rowCount() > 0){
    $row = $closed_null->resultset();
    $total = $closed_null->rowCount();
    

    for ($i=0; $i < $total; $i++) {
        // code...
        if ($row[$i]['ic_num_affected'] == " " | $row[$i]['ic_num_affected'] == 0) {
            # code...
            $affected_num  = 1;
        }else {
            # code...
            $affected_num    = $row[$i]['ic_num_affected'];
        }

        if ( $row[$i]['done_date'] == 0) {
            // code...
            $manhour[] = 0;
            $manhours = 0;
            echo $row[$i]['done_date']." ";
        }else{
			if(strpos( $row[$i]['prcss_no'], "CPR" ) !== false)
			{

				 $datetime1 = $row[$i]['ic_rqst_date'];
                 $datetime2 = $row[$i]['done_date'];
                 
			}else{
            
                $datetime1 = $row[$i]['acknowledged_date'];
                $datetime2 = $row[$i]['done_date'];
                
			}
           
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
                    '2019-06-12',
                    '2019-08-12',
                    '2019-08-21',
                    '2019-08-26',

                    '2020-01-01',
                    '2020-02-05',
                    '2020-02-25',
                    '2020-04-09',
                    '2020-04-18',
                    '2020-04-19',
                    '2020-05-01',
                    '2020-06-12',
                    '2020-08-21',
                    '2020-08-26',
                    '2020-11-01',
                    '2020-12-23',
                    '2020-12-24',
                    '2020-12-25',
                    '2020-12-26',
                    '2020-12-27',
                    '2020-12-30',
                    '2020-12-31',

                    '2021-01-01',
                    '2021-02-12', 
                    '2021-02-25',
                    '2021-04-01',
                    '2021-04-02',
                    '2021-04-09',
                    '2021-05-01',
                    '2021-06-12',
                    '2021-08-21',
                    '2021-08-26',
                    '2021-11-01',
                    '2021-12-23',
                    '2021-12-24',
                    '2021-12-25',
                    '2021-12-26',
                    '2021-12-27',
                    '2021-12-30',
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
            $manhour[]  = (number_format((float)$hour, 2, '.', ''));

            $manhours    = (number_format((float)$hour, 2, '.', ''));
        }

        switch(true)
            {

                    case $manhours > 30:

                    $response = "Delay";

                    break;

                    case $manhours == 30:

                    $response = "On Time";

                    break;

                    case $manhours < 30:

                    $response = "Ahead of Time";

                    break;

            }

            if (strpos( $row[$i]['prcss_no'], "CPR" ) !== false || strpos( $row[$i]['prcss_no'], "DRR" ) !== false) {
                # code...
                $response = "Down Time";
            }

            if (strpos($row[$i]['prcss_no'], "CPR" ) !== false) {
                //CPR manhour (Downtime * Affected User/s)
                $manhours = $manhours * $affected_num;
            }


        $ic_no = $row[$i]['ic_no'];

        echo $ic_no." | ".$row[$i]['prcss_no']." | ".$manhours." | ".$response."<br>";
        
        $closed_null->query("Update srvcrqst set man_hour=:man_hour, response=:response where ic_no=:ic_no ");
        $closed_null->bind(':response', $response);
        $closed_null->bind(':man_hour', $manhours);
        $closed_null->bind(':ic_no',$ic_no);
        $closed_null->execute();
        
    }
    //print_r($manhour);
    $overall_manhour = array_sum($manhour);


}else{
    $overall_manhour = "0";
}



?>
