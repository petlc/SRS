<?php
require_once 'function/function.php';
require_once 'restriction.php';
require_once 'function/misonly.php';
require_once 'function/requeststatus.php';
unset($_SESSION['endorse']);
unset($_SESSION['status']);
unset($_SESSION['search']);

//echo $role;
?>
<html>
    <head>
        <title>
            Service Request
        </title>
		<link rel="icon" type="image/ico" href="favicon.ico">
        <link rel="stylesheet" type="text/css"href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"href="css/all.css"/>
        <link rel="stylesheet" type="text/css"href="css/basic-needs.css"/>
        <link rel="stylesheet" type="text/css"href="css/jquery.simple-dtpicker.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/aui-min.js"></script>
        <script src="js/jquery.simple-dtpicker.js"></script>
        <script>
          var counter = 1;
          var limit = 10;
          function addInput(divName){
               if (counter == limit)  {
                    alert("You have reached the limit of adding " + counter + " inputs");
               }
               else {
                    var newdiv = document.createElement('div');
                    newdiv.innerHTML = "<td><input type='text' name='name'></td><td><input type='text' name='petid'></td><td><input type='text' name='position'></td><td><input type='text' name='group'></td> <td><input type='radio' name='date_change"+ counter +"' id='option' value='Add'></td> <td><input type='radio' name='date_change"+ counter +"' id='option' value='Edit'></td> <td><input type='radio' name='date_change"+ counter +"' id='option' value='Delete'></td> <td><input type='checkbox' class='radio' value='Windows' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='Email' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='SEINE2' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='CMMS' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='MDS' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='LOCO' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='RECO' name='isr"+ counter +"[]' /></td> <td><input type='checkbox' class='radio' value='TSO' name='isr"+ counter +"[]' /></td> ";
                    document.getElementById(divName).appendChild(newdiv);
                    counter++;
               }
          }
        </script>
        <style>
        .card-header{
            background-color: #3f72af;
            color: #dbe2ef;
        }
        </style>
    </head>
    <body>
        <?php

        include 'function/topbar.php';
         ?>
        <div class="container-fluid">

            <div class="row content">
                <div class="col-md-1">

                </div>
                <div class="col-lg-10 mb-3">

                </div>
                <div class="col-md-1">


                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update List</h4>
                        </div>
                        <div class="card-block">
                            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-8">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-1">
                                    </div>

                                    <input class="btn btn-info col-5" type="file" name="role" >

                                    <div class="col-1">
                                    </div>

                                    <input class="btn btn-success col-3" type="submit" name="update_role" value="Update" />

                                    <div class="col-2">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <form method="get">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fa fa-calendar" aria-hidden="true"></i> Check Request </h4>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">Month </label>
                                            <select class="form-control col-md-9" name="month">
                                                <option value=""></option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>

                                            <label class="col-md-3 col-form-label mt-3">Year </label>
                                            <select class="form-control col-md-9 mt-3" name="year">
                                                <option value=""></option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                            </select>

                                            <label class="col-md-3 col-form-label mt-3">Site </label>
                                            <select class="form-control col-md-9 mt-3" name="site" >
                                                <option value=""></option>
                                                <option value="HO">Head Office</option>
                                                <option value="BO">Branch Office</option>
                                            </select>

                                            <div class="col-md-3 mt-3">
                                            </div>
                                            <button type="submit" class="btn btn-success col-md-9 mt-3" name="get_report">Get Report</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-10">
                    <?php

                    if (!empty($_POST['update_done'])) {
                        // code...
                        $ref_no         = $_POST['update_done'];
                        $ack_date       = $_POST['ack_date'];
                        $new_done_date  = $_POST['new_done_date'];
                        echo $ref_no." ".$new_done_date;

                        //$datetime1 = "2017-10-09 12:28:00";
                        //$datetime2 = "2018-01-03 08:40:00";
                        $date_create1 = date_create($ack_date);
                        $date_create2 = date_create($new_done_date);
                        $interval = ($date_create2->getTimestamp() - $date_create1->getTimestamp())/3600;

                        $difference = $interval;
                        if (substr($ack_date, 0,10) != substr($new_done_date, 0,10)) {
                            // code...
                            $start = new DateTime(substr($ack_date, 0,10));
                            $end = new DateTime(substr($new_done_date, 0,10));
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
                            $hour = (0.0625 * $total_hours);
                        }else{
                            $hour = (0.0625 * $difference);
                        }

                        $mnhr = (number_format((float)$hour, 2, '.', ''));


                        $new_done_date = date_format($date_create2,"Y-m-d H:i:s");
                        $update_mnhr = new Report();

                        $update_mnhr->query("Update srvcrqst set man_hour=:man_hour where ic_no=:ic_no");
                        $update_mnhr->bind(':man_hour', $mnhr);
                        $update_mnhr->bind(':ic_no', $ref_no);
                        $update_mnhr->execute();


                        echo "<script> alert('".$mnhr."'); </script>";
                    }

                    if(isset($_GET['get_report'])){

                        $site = $_GET['site'];

                        if(!empty($_GET['year'])){
                            if (!empty($_GET['month'])) {

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


                                $query = "Select ic_no, ic_crtd_date, ic_rqst, ic_dtls, acknowledged_date, done_date from srvcrqst where ic_crtd_date between :start and :end and ic_status in ('Done', 'Closed') and ic_dtls not like '%Purchase%' and ic_dtls not like '%Renewal%' and man_hour > '1.25'";


                            }
                        }else{
                        }
                    }




                    ?>


                    </div>
                    <div class="col-md-1">

                    </div>


                    <div class="col-md-1">

                    </div>
                    <div class="col-md-10">
                        <?php


                        if (!empty($query)) {
                            // code...
                            $monthly_check = new Report();

                            $monthly_check->query($query);
                            $monthly_check->bind(':start',$start_date );
                            $monthly_check->bind(':end',$end_date );
                            $monthly_check->execute();

                            if ($monthly_check->rowCount() > 0) {
                                // code...
                                ?>
                                <div class="card">
                                    <div class="">

                                    </div>
                                    <div class="card-block">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Referrence No.</th>
                                                    <th>Request Date</th>
                                                    <th>Request</th>
                                                    <th>Details</th>
                                                    <th>Acknowledge Date</th>
                                                    <th>Done Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php

                                        $row = $monthly_check->resultset();

                                        foreach ($row as $row_info) {
                                            // code...
                                            $ref_no             = $row_info['ic_no'];
                                            $crtd_date          = $row_info['ic_crtd_date'];
                                            $rqst               = $row_info['ic_rqst'];
                                            $dtls               = $row_info['ic_dtls'];
                                            $acknowledged_date  = $row_info['acknowledged_date'];
                                            $done_date          = $row_info['done_date'];

                                            ?>
                                            <tr>
                                                <form class="" method="post">
                                                    <td><?php echo $ref_no; ?> <input type="hidden" name="refno" value="<?php echo $ref_no; ?>"> </td>
                                                    <td><?php echo $crtd_date; ?></td>
                                                    <td><?php echo $rqst; ?></td>
                                                    <td><?php echo substr($dtls,0, 50); ?></td>
                                                    <td><?php echo $acknowledged_date; ?> <input type="hidden" name="ack_date" value="<?php echo $acknowledged_date; ?>"></td>
                                                    <td> <input type="text" class="form-control adjustmets" name="new_done_date" value="<?php echo $done_date; ?>">
                                                         <input type="submit" name="update_done" value="<?php echo $ref_no; ?>"></td>

                                                </form>
                                            </tr>

                                            <?php
                                        }

                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php
                            }else{

                            }



                        }


                         ?>
                    </div>
                    <div class="col-md-1">

                    </div>
            </div>
            <!---
            <div class="row content">




                <div class="col-lg-1">

                </div>
                <div class="col-lg-10">
                    <div class="Card">
                        <div class="card-header">

                        </div>
                        <div class="card-block">
                            <form class=""  method="post">
                                <select class="col-4 form-control" name="search_department">
                                    <option value=""></option>
                                    <?php echo dprtmntList(); ?>
                                </select>
                                <?php

                                    include 'function/update.roles.php';

                                    function dprtmntList(){
                                        $view_dptlst = new Employees();

                                        $view_dptlst->query("Select department, count(*) from emp_info group by department");
                                        $view_dptlst->execute();

                                        $dptlst = "";
                                        $dptlst_cnt = $view_dptlst->rowCount();

                                        $rows = $view_dptlst->resultSet();
                                        $rows_count = count($rows);
                                        for ($i=0; $i < $rows_count; $i++) {
                                            // code...
                                            //print_r($rows[$i]);
                                            //echo $rows[$i]['department'];
                                            echo "<option value='".$rows[$i]['department']."'>".$rows[$i]['department']."</option>";
                                        }
                                    }
                                 ?>

                                 <button type="submit" class="btn" name="show_chckr_pprvr">Show</button>
                            </form>
                            <div class="row">


                                <?php

                                if(isset($_POST['show_chckr_pprvr'])){
                                    $srch_dprtmnt = $_POST['search_department'];

                                    $dprtmnt_chckr = new Employees();

                                    //$dprtmnt_chckr->query();

                                    if ($srch_dprtmnt == "SCD") {
                                        // code...
                                        $checker_query = "select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_srs.role like '%Checker%' and emp_srs.department like '%$srch_dprtmnt%' Union all select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_srs.pet_id='pet0226'";
                                    }else{
                                        $checker_query = "select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_srs.role like '%Checker%' and emp_srs.department like '%$srch_dprtmnt%' ";
                                    }

                                    $dprtmnt_chckr->query($checker_query);
                                    $dprtmnt_chckr->execute();
                                    ?>
                                    <div class=" col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Checker</h5>
                                            </div>
                                            <div class="card-block">
                                                <?php

                                                if($dprtmnt_chckr->rowCount() > 0){
                                                    $dprtmnt_chckr_rows = $dprtmnt_chckr->resultSet();
                                                    $dprtmnt_chckr_rows_count = count($dprtmnt_chckr_rows);
                                                    for ($d=0; $d < $dprtmnt_chckr_rows_count; $d++) {
                                                        // code...
                                                        //print_r($rows[$i]);
                                                        echo $dprtmnt_chckr_rows[$d]['full_name']."<br>";
                                                        //echo "<option value='".$rows[$d]['department']."'>".$rows[$d]['department']."</option>";
                                                    }
                                                }

                                                 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php


                                    $dprtmnt_pprvr = new Employees();

                                    $dprtmnt_pprvr->query("select emp_info.full_name, emp_info.pet_id, emp_srs.role, emp_srs.department from emp_info left JOIN emp_srs on emp_info.pet_id = emp_srs.pet_id where emp_srs.role like '%Approver%' and emp_srs.department like '%$srch_dprtmnt%' ");
                                    $dprtmnt_pprvr->execute();
                                    ?>
                                    <div class=" col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Approver</h5>
                                            </div>
                                            <div class="card-block">
                                                <?php

                                                if($dprtmnt_pprvr->rowCount() > 0){
                                                    $dprtmnt_pprvr_rows = $dprtmnt_pprvr->resultSet();
                                                    $dprtmnt_pprvr_rows_count = count($dprtmnt_pprvr_rows);
                                                    for ($d=0; $d < $dprtmnt_pprvr_rows_count; $d++) {
                                                        // code...
                                                        //print_r($rows[$i]);
                                                        echo $dprtmnt_pprvr_rows[$d]['full_name']."<br>";
                                                        //echo "<option value='".$rows[$d]['department']."'>".$rows[$d]['department']."</option>";
                                                    }
                                                }

                                                 ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }else{

                                }

                                ?>
                            </div>
                            <form class=""  method="post">
                                <label for="username">Username:</label> <input type="text" class="input" id="username" name="username">
                                <br><label for = "firstname">First Name:</label> <input class = "input" type ="text" id = "firstname" name="firstname" >
                                <br><label for="lastname">Last Name:</label> <input class="input" type ="text" id = "lastname" name="lastname">
                                <br><label>&nbsp</label><input type="submit" name="create_ldap" class="button">
                            </form>

                            <?php

                                if (isset($_POST['create_ldap'])) {
                                    // code...
                                    $cn = $_POST['username'];
                                    $givenName = $_POST['firstname'];
                                    $surname = $_POST['lastname'];
                                    echo "Adding user: $cn " . '<br>';

                                    $ds = ldap_connect("ldap://petsvr1100.petcad1100")or die ("Could not connect to LDAP Server");
                                    $ldaprdn = 'petcad1100' . "\\" . "pet1666-admin";

                                    if ($ds) {
                                        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
                                        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
                                        $r = ldap_bind($ds,$ldaprdn,"power@01");

                                        $info["cn"] = $cn;
                                        $info["sAMAccountName"] = $cn;
                                        $info["givenName"] = $givenName;
                                        $info["sn"] = $surname;
                                        $info["displayName"] = $givenName." ".$surname;
                                        $info["objectClass"] = "User";
                                        $info["userPassword"] = "User";
                                        //$info["userAccountControl"] = ($ac & ~2);
                                        $filter="(cn=$cn)";
                                        $sr = ldap_search($ds,"dc=petcad1100",$filter);

                                        if ($sr) {
                                            // code...
                                            $r = ldap_add($ds,"cn=$cn,OU=MIS,OU=Department,dc=petcad1100",$info);
                                        }else{
                                            echo "Meron na";
                                        }
                                        $info = ldap_get_entries($ds,$sr);






                                    echo $sr;
                                    /*
                                    echo "The user:<span class='result'> " . $info[0]["dn"] . "</span> has been created. <br>";
                                    */
                                    }
                                    ldap_close($ds);


                                }


                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                        <?php

                        if (isset($_POST['send_email'])) {
                            // code...
                            $to      = "willem.leonardo@ph.yazaki.com";
                           $subject = 'Email Test';
                           $message = '<html>
                                       <head>
                                       </head>
                                       <body>
                                       Hello MIS<br>
                                       <br>

                                       <br>
                                       Thank you,<br>
                                       </body>
                                       </html>';

                                   $headers='Content-type: text/html; charset=iso-8859-1' . "\r\n".
                                   "from: smb_srs.pet@ph.yazaki.com"."\n". //creating headers
                                   "reply-to: smb_srs.pet@ph.yazaki.com"."\n". //creating headers
                                   "X-Priority: 1\n". //headers for priority
                                   "Priority: Urgent\n". //headers for priority
                                   "Importance: high";
                                   mail($to, $subject, $message, $headers);

                                   echo"<script>
                                           alert('Sent Approved request to MIS');
                                           window.location.href = 'admin.php';
                                           </script>";


                        }

                         ?>
                </div>

            </div>
            -->
        </div>


        <div class="row navbar navbar-light red content footer">
            <div class="text-center">&copy; all rights reserved 2016</div>
        </div>
    </body>
    <script type="text/javascript">
        $(function(){
            $('.adjustmets').appendDtpicker({
                    "autodateOnStart": false,
                "dateFormat": "YYYY-MM-DD hh:mm",
                //"futureOnly": true,
                "minTime":"06:30",
                "maxTime":"21:30",
                "minDate":+5,
                "allowWdays": [1, 2, 3, 4, 5] // 0: Sun, 1: Mon, 2: Tue, 3: Wed, 4: Thr, 5: Fri, 6: Sat
            });
        });
    </script>
</html>
