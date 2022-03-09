<?php
require_once 'function/core.php';

if(isset($_POST['login'])){
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$username     = filter_input(INPUT_POST, "username");
		$password     = filter_input(INPUT_POST, "password");
        $lastvisited  = filter_input(INPUT_POST, "lastvisited");
        //$accounts = new login();
        //echo $username;
		//echo $accounts->loginAccount($username, $password, $lastvisited);
        
        // Watanabe-san account
        if($username == "Y052231-admin"){
            $admin_Y052231 = $username;
            $username = "Y052231";
        }else{
            $username = $username;
        }
        
        $adServer = "ldap://petsvr1100.petcad1100:389";

        $ldaphost = "petsvr1100.petcad1100";  // your ldap servers
        $ldapport = 389;                 // your ldap server's port number


        $ldap = ldap_connect($adServer) or die("Could not connect to $ldaphost");
        $ldaprdn = 'petcad1100' . "\\" . $username;

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        
        /*
		$adServer = "ldap://petsvr1100.petcad1100:389";

        $ldap = ldap_connect($adServer);
        $ldaprdn = 'petcad1100' . "\\" . $username;

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        */
        

        //echo $ldap;

        if ($ldap) {

            $bind = @ldap_bind($ldap, $ldaprdn, $password);
            
            if ($bind) {
                $filter="(sAMAccountName=$username)";
                $result = ldap_search($ldap,"dc=petcad1100",$filter);
                ldap_sort($ldap,$result,"sn");
                $info = ldap_get_entries($ldap, $result);

                for ($i=0; $i<$info["count"]; $i++){

                    $cn					= $info[$i]["cn"][0];
                    $firstname 			= $info[$i]["givenname"][0];
                    $middlename 		= isset($info[$i]["initials"][0]);
                    $lastname 			= $info[$i]["sn"][0];
                    $ldap_displayname 	= $info[$i]["displayname"][0];
                    $account_stat		= $info[$i]["useraccountcontrol"][0];
                }

                

                    if (strpos($username, '-admin') !== false|| strpos($admin_Y052231, '-admin') !== false) {
                        // code...
                        if (strpos($username, '-') !== false)
                        {
                            $loginname = explode('-',$username);
                            
                            $loginname = $loginname[0];
                        }else{
                            
                            $loginname = $username;
                        }

                        $employee_query = new Employees();

                        $employee_query->query("SELECT emp_info.full_name, emp_info.department, emp_info.position, emp_srs.pet_id, GROUP_CONCAT(emp_srs.role) as role 
                        FROM emp_srs left join emp_info on emp_srs.pet_id = emp_info.pet_id 
                        where emp_info.pet_id=:pet_id");
                        $employee_query->bind(':pet_id', $loginname);
                        $employee_query->execute();

                        if($employee_query->rowCount() > 0){

                            $row = $employee_query->single();

                        //    $fullname      = "admin.".$row['full_name'];
                            $fullname      = "admin.".trim($row['full_name']);
                            $position      = $row['position'];
                            $department    = trim($row['department']);
                            $id            = $loginname;
                            echo $fullname." ".$row['full_name'];
                            $employee_query->query("Select role from emp_srs where pet_id=:pet_id");
                            $employee_query->bind(':pet_id', $username);
                            $employee_query->execute();
                            
                            $row = $employee_query->single();
                            
                            $role          = $row['role'];
                            

                            if($lastvisited = "/uals/login.php"){
                                header("Location:index.php");
                            }else{
                                header("Location:".$lastvisited);
                            }
                        }else{

                            echo"<script>
                                    alert('Your account is not register, please inform supervisor/manager to contact MIS');
                                    window.location.href = 'logout.php';
                                </script>";

                        }

                    }else{

                        $employee_query = new Employees();

                        $employee_query->query("SELECT emp_info.full_name, emp_info.department, emp_info.position, emp_srs.pet_id, GROUP_CONCAT(emp_srs.role) as role 
                        FROM emp_srs left join emp_info on emp_srs.pet_id = emp_info.pet_id 
                        where emp_info.pet_id=:pet_id");
                        $employee_query->bind(':pet_id', $username);
                        $employee_query->execute();

                        if($employee_query->rowCount() > 0){

                            $row = $employee_query->single();

                            $fullname      = $row['full_name'];
                            $role          = $row['role'];
                            $position      = $row['position'];
                            $department    = trim($row['department']);
                            $id            = $row['id'];

                            if($lastvisited = "/uals/login.php"){
                                header("Location:index.php");
                            }else{
                                header("Location:".$lastvisited);
                            }
                        }else{

                            echo"<script>
                                    alert('Your account is not register, please inform supervisor/manager to contact MIS');
                                    window.location.href = 'logout.php';
                                </script>";

                        }
                    }



                session_start();
                $_SESSION['login_user']     = $username;
                $_SESSION['fullname']       = $fullname;
                $_SESSION['firstname']      = $firstname;
                $_SESSION['middlename']     = $middlename;
                $_SESSION['lastname']       = $lastname;
                $_SESSION['displayname']    = $ldap_displayname;
                $_SESSION['department']     = $department;
                $_SESSION['position']       = $position;
                $_SESSION['role']           = $role;
                $_SESSION['account_status'] = $account_stat;
                $_SESSION['id']             = $id;

                $_SESSION['ldap'] = $ldap;
                $_SESSION['bind'] = $bind;
                //echo"<script>alert('$account_stat')</script>";
            
            }
            /*
            elseif ($username == "pet2069-admin") {

                if (strpos($username, '-admin') !== false|| strpos($admin_Y052231, '-admin') !== false) {
                    // code...
                    if (strpos($username, '-') !== false)
                    {
                        $loginname = explode('-',$username);
                        
                        $loginname = $loginname[0];
                    }else{
                        
                        $loginname = $username;
                    }
                }

                echo $loginname;
                $employee_query = new Employees();

                        $employee_query->query("SELECT emp_info.full_name, emp_info.department, emp_info.position, emp_srs.pet_id, GROUP_CONCAT(emp_srs.role) as role 
                        FROM emp_srs left join emp_info on emp_srs.pet_id = emp_info.pet_id 
                        where emp_info.pet_id=:pet_id");
                        $employee_query->bind(':pet_id', $loginname);
                        $employee_query->execute();

                        print_r($row = $employee_query->single());


            }
            */
            else {
                    echo"<script>alert('Invalid username or password2')</script>";
                    //$msg = "Invalid email address / password";
                    //echo $msg;
            }
            
            

        }else {
            echo"<script>alert('Invalid username or password1')</script>";
            //$msg = "Invalid email address / password";
            //echo $msg;
        }

	}else{
		echo"<script>alert('Invalid username or password0')</script>";
	}
}


require_once 'PHPMailer/class.phpmailer.php';

require_once 'function/config.php';
require_once 'function/email.php';
require_once 'function/work.log.request.php';
require_once 'function/create.request.php';
require_once 'function/stamp-on.php';
require_once 'function/update.request.php';



if(isset($_POST['generate_report'])){

    require_once 'function/report/report-query.php';
            /** PHPExcel */
        require_once 'PHPExcel.php';

        /** PHPExcel_Writer_Excel2007 */
        require_once 'PHPExcel/Writer/Excel2007.php';

        // Create new PHPExcel object
        //echo date('H:i:s') . " Create new PHPExcel object\n";
        $objPHPExcel = new PHPExcel();



        $header = '';
        $result ='';

        if(!empty($_POST['startdt2']) && !empty($_POST['enddt2'])){
            $start_date     = $_POST['startdt2'];
            $end_date       = $_POST['enddt2'];

            $mnth           = $_POST['mnth'];
            $ahead          = $_POST['ahead'];
            $ontime         = $_POST['ontime'];
            $delay          = $_POST['delay'];
            $totalDC        = $_POST['totalDC'];
            $wip            = $_POST['wip'];
            $assigned       = $_POST['assigned'];
            $nr             = $_POST['nr'];
            $totalRR        = $_POST['totalRR'];

            $totalRT        = $_POST['totalRT'];

            $mnhr_header    = array("Ahead of Time", "On Time", "Delay", "Total Request");
            $mnhr_details   = array($ahead, $ontime, $delay, $totalDC);
            $rmng_status    = array("Work in Progress", "Assigned", "New Request", "Total");
            $rmng_rqst      = array($wip, $assigned, $nr, $totalRR);

            $row = 1; // 1-based index
            $col = 0;
            $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
            $style = array('font' => array('size' => 10,'bold' => true));
            $objPHPExcel->getActiveSheet()->getStyle('A1:A13')->applyFromArray($style);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $mnth);
            $row++;

            for($mh=0;$mh<count($mnhr_header);$mh++){
                $col = 0;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $mnhr_header[$mh]);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $mnhr_details[$mh]);
                $row++;
            }$row++;

            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Ave. Respons Time");
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $totalRT);
            $row++;
            $row++;

            $cell = $row;

            $objPHPExcel->getActiveSheet()->mergeCells('A'.$cell.':B'.$cell);

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cell, "Remaining Request");
            $row++;

            for($rs=0;$rs<count($rmng_status);$rs++){
                $col = 0;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rmng_status[$rs]);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rmng_rqst[$rs]);
                $row++;
            }$row++;


            $get_dtls = "Select * From srvcrqst Where ic_rqst_date Between :start_date AND :end_date ORDER BY ic_rqst_date ASC";
            $get_print = $dbCon->prepare($get_dtls);
            $get_print->bindparam(':start_date', $start_date);
            $get_print->bindparam(':end_date', $end_date);
            $get_print->execute();
            echo"<table>";
            if($get_print->rowCount() > 0){
                
                $col = 0;
                $result = $dbCon->query('select * from srvcrqst limit 1');
                $fields = array_keys($result->fetch(PDO::FETCH_ASSOC));
                foreach($fields as $key=>$field) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
                        $col++;
                    }

                $row++;
                while($row_data = $get_print->fetch(PDO::FETCH_ASSOC)) {
                    $col = 0;
                    foreach($row_data as $key=>$value) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                        $col++;
                    }
                    $row++;
                }
            }else{
                echo"mali<br>";


            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $file = "generated report/".$start_date." to ".$end_date.".php";
            $date = date('m-d-Y');
            //echo $file;
            $objWriter->save(str_replace('.php', '.xlsx', $file));

            echo"<script>
                    alert('".$start_date." to ".$end_date."');
                    window.location.href = 'report.php';
                    window.location.href = 'generated report/".$start_date." to ".$end_date.".xlsx';
                </script>";

            /*
            ?>
            alert('".$ic_no."');
                    window.location.href = 'srs/generated report/<?php echo $start_date."to".$end_date ?>.xlsx';
            <a href='generated report/<?php echo $start_date."to".$end_date ?>.xlsx'>Download Report</a>
            <?php
            */
        }else{

            $months_list         = $_POST['months'];
            $ahead_list          = $_POST['ahead'];
            $ont_list            = $_POST['ont'];
            $dly_list            = $_POST['dly'];
            $tot_req_list        = $_POST['tot_req'];
            $responsetime_list   = $_POST['responsetime'];

            //print_r($months_list);

            //array_filter(explode(";",$officer_list));

            $style = array('font' => array('size' => 10,'bold' => true));
            $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->getStyle('A1:A10')->applyFromArray($style);

            $row = 1; // 1-based index
            $col = 1;
            for($monthco=0;$monthco<$months_list;$monthco++){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, substr($months[$monthco],0,3));
                $col++;
                //echo "<th>".substr($months[$monthco],0,3)."</th>" ;
            }
               $row++;
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Ahead of time");
            $col++;
            for($monthco=0;$monthco<$month_dates_no;$monthco++){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ahead_status_[$months[$monthco]."-Closed"]+$ahead_status_[$months[$monthco]."-Done"]);
                $col++;
                //echo "<th>".substr($months[$monthco],0,3)."</th>" ;
            }
                $row++;
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "On time");
            $col++;
            for($monthco=0;$monthco<$month_dates_no;$monthco++){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ontime_status_[$months[$monthco]."-Closed"]+$ontime_status_[$months[$monthco]."-Done"]);
                $col++;
                //echo "<th>".substr($months[$monthco],0,3)."</th>" ;
            }
               $row++;
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Delay");
            $col++;
            for($monthco=0;$monthco<$month_dates_no;$monthco++){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $delay_status_[$months[$monthco]."-Closed"]+$delay_status_[$months[$monthco]."-Done"]);
                $col++;
                //echo "<th>".substr($months[$monthco],0,3)."</th>" ;
            }
               $row++;
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Toral Request");
            $col++;
            for($monthco=0;$monthco<$month_dates_no;$monthco++){
                $ahead = $ahead_status_[$months[$monthco]."-Closed"]+$ahead_status_[$months[$monthco]."-Done"];
                $ont   = $ontime_status_[$months[$monthco]."-Closed"]+$ontime_status_[$months[$monthco]."-Done"];
                $dly   = $delay_status_[$months[$monthco]."-Closed"]+$delay_status_[$months[$monthco]."-Done"];
                $tot_req = $ahead+$ont+$dly;

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $tot_req);
                $col++;
                //echo "<th>".substr($months[$monthco],0,3)."</th>" ;
            }
            $row++;
            $row++;
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "Average");
            $col++;
            for($monthco=0;$monthco<$month_dates_no;$monthco++){

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $response_time_result[$months[$monthco]]);
                $col++;
                //echo "<th>".substr($months[$monthco],0,3)."</th>" ;
            }

            $row = 10;
            $col=0;
            $month_dates    = array("12-16;01-15","01-16;02-15","02-16;03-15","03-16;04-15","04-16;05-15","05-16;06-15","06-16;07-15","07-16;08-15","08-16;09-15","09-16;10-15","10-16;11-15","11-16;12-15");

            $result = $dbCon->query('select * from srvcrqst limit 1');
                    $fields = array_keys($result->fetch(PDO::FETCH_ASSOC));
                    foreach($fields as $key=>$field) {
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
                            $col++;
                        }
            $row++;
            foreach($month_dates as $dates){

                $date = explode(";",$dates);

                $year   = $_POST['year'];


                if($date[0] == "12-16"){
                    $start            = ($year-1)."-".$date[0];
                    $res            = "good";
                }else{
                   $start            = $year."-".$date[0];
                    $res            = "no good";
                }
                    $end            = $year."-".$date[1];

                //echo $start;

                $get_dtls = "Select * From srvcrqst Where ic_rqst_date Between :start_date AND :end_date ORDER BY ic_rqst_date ASC";
                $get_print = $dbCon->prepare($get_dtls);
                $get_print->bindparam(':start_date', $start);
                $get_print->bindparam(':end_date', $end);
                $get_print->execute();
                echo"<table>";
                if($get_print->rowCount() > 0){
                    //$row = 1; // 1-based index
                    $col = 0;
                    /*
                    $columnname = array("IC No", "Date Request", "Date Needed", "Reported By", "Derpartment", "Details", "Status", "Dprt. Checker","Dprt. Approver", "Date Acknowledge", "Date Done", "Man hour");
                    foreach($columnname as $key=>$column) {
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $column);
                            $col++;
                        }
                        */



                    while($row_data = $get_print->fetch(PDO::FETCH_ASSOC)) {
                        $col = 0;
                        foreach($row_data as $key=>$value) {
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                            $col++;
                        }
                        $row++;
                    }
                }

            }



            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $file = "generated report/".$_POST['year'].".php";
            $objWriter->save(str_replace('.php', '.xlsx', $file));
            echo"<script>
                    alert('".$_POST['year']."');
                    window.location.href = 'report.php';
                    window.location.href = 'generated report/".$_POST['year'].".xlsx';
                </script>";

        }
    }


if(isset($_POST['edit-role'])){

    if($_POST['edit-role'] == "edit-role"){

        if($_POST['pre-role'] == $_POST['new-role']){

             echo"<script>
                    alert('your previous role and new role are the same please choose properly');

                </script>";
        }else{

            $newrole = $_POST['new-role'];

            $petid    = $_POST['petid'];

            $update_role = new Report();

            $update_role->query("Update employees set role=:role where pet_id=:petid");
            $update_role->bind(':role',$newrole);
            $update_role->bind(':petid',$petid);
            $update_role->execute();

            echo"<script>
                    alert('".$_POST['new-role']."');

                </script>";
        }

    }

}

//Function Get Personnel Info

function getPersonnel($personnel){

	$getInfo = new Employees();

    $getInfo->query("Select * from emp_info where full_name=:full_name");
    $getInfo->bind(':full_name', $personnel);
    $getInfo->execute();

    if ($getInfo->rowCount() > 0) {
        // code...
        $emp_row = $getInfo->single();

        $firstname      = $emp_row['first_name'];
        $mid_ini        = $emp_row['middle_initial'];
        $lastname       = $emp_row['last_name'];
        $fullname       = $emp_row['full_name'];
        $department     = $emp_row['department'];
        $petid          = $emp_row['id'];

        $stmp_nm        = $firstname[0].".".$lastname;

		$info = array($petid, $firstname, $mid_ini, $lastname, $fullname, $department);

    }else{

		$info = array();

	}

	return $info;
}
?>
