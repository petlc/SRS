<?php

// Define configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "service_request");

define("DB_HOST_emp", "10.49.5.235:3306");
define("DB_USER_emp", "root1");
define("DB_PASS_emp", "");
define("DB_NAME_emp", "pet_employees");
/*
define("DB_HOST_emp", "localhost");
define("DB_USER_emp", "root");
define("DB_PASS_emp", "");
define("DB_NAME_emp", "pet_employees");
*/
$host       = 'localhost';
$username   = 'root';
$password   = '';
$dbName     = 'service_request';
//$dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
try{
    $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
}catch(PDOException $e){
    echo $e->getMessage();
}


$host1       = '10.49.5.235:3306';
$dbName1     = 'pet_employees';
$username1   = 'root1';
/*
$host1       = 'localhost';
$dbName1     = 'pet_employees';
$username1   = 'root';
/*
$host1       = 'localhost';
$username1   = 'root';
$dbName1     = 'service_request';
*/

//$dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
try{
 $dbCon1 = new PDO("mysql:host=".$host1.";dbname=".$dbName1, $username1, $password);
}
catch(PDOException $e){
 echo $e->getMessage();
}



class request{

    public function createRequest($requestor_id, $requestor_name, $requestor_dpt, $created_date, $request_date, $process, $details, $tmp_path, $file_name){
        global $dbCon;

        $ic_year    = "ic_".date("Y");

        $create_ic  = $dbCon->prepare("Insert into $ic_year (ic_no, prcss_no)Values('', '')");
        $create_ic->execute();

        $ic_id = $dbCon->lastInsertId();
        $autoinc = sprintf("%04d",$ic_id);
        $ic_no=  "IC-". $autoinc . date("-".'y');


        $update_query = $dbCon->prepare("update $ic_year set ic_no = :ic_no, prcss_no = :prcss_no where srvc_rqst_id =:ic_id");
        $update_query->bindparam(':ic_no',$ic_no);
        $update_query->bindparam(':ic_id',$ic_id);
        $update_query->bindparam(':prcss_no',$process);

        $update_query->execute();

        $status = "Newly Created";

        if(!empty($file_name)){
            $dir_name = "attachments/".$ic_no;
            if(file_exists($dir_name)){

            }else{
                mkdir("$dir_name");
                $uploads_dir = "$dir_name";

                $upload_file = "";
                foreach($file_name as $key=>$val ){
                    $upload_file_path = $tmp_path[$key];
                    $upload_file_name = $file_name[$key];
                    move_uploaded_file($upload_file_path, "$uploads_dir/$upload_file_name");
                    $upload_file .= $uploads_dir."/".$upload_file_name.",";
                }


            }
        }else{

            $upload_file = "No attached file";

        }


        $create_query = $dbCon->prepare("Insert into srvcrqst (ic_no, ic_rqstr_id, ic_rqstr, ic_rqstr_dprtmnt, ic_crtd_date, ic_rqst_date, prcss_no, ic_dtls, ic_attachment, ic_status)VALUES(:ic_no, :ic_rqstr_id, :ic_rqstr, :ic_rqstr_dprtmnt, :ic_crtd_date, :ic_rqst_date, :prcss_no, :ic_dtls, :ic_attachment, :status)");
        $create_query->bindparam(':ic_rqstr_id',$requestor_id);
        $create_query->bindparam(':ic_rqstr',$requestor_name);
        $create_query->bindparam(':ic_rqstr_dprtmnt',$requestor_dpt);
        $create_query->bindparam(':ic_crtd_date',$created_date);
        $create_query->bindparam(':ic_rqst_date',$request_date);
        $create_query->bindparam(':prcss_no',$process);
        $create_query->bindparam(':ic_dtls',$details);
        $create_query->bindparam(':ic_attachment',$upload_file);
        $create_query->bindparam(':status',$status);
        $create_query->bindparam(':ic_no',$ic_no);
        $create_query->execute();

        //$ic_no = $dbCon->lastInsertId();

        $this->ic_no = $ic_no;

        return $this->ic_no;

        /*
        echo"<script>
                alert('".$ic_no."');
                window.location.href = 'index.php';
                </script>";
        */
    }





    public function statusUpdate($ic_no, $prcss, $status, $date_log, $checker){
        global $dbCon;

        $ic_year    = "ic_".date("Y");


        switch($status){

            case "Work in Progress";
                $wip = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, acknowledged_date=:acknowledged_date where ic_no=:ic_no ");
                $wip->bindparam(':ic_status', $status);
                $wip->bindparam(':acknowledged_date', $date_log);
                $wip->bindparam(':ic_no',$ic_no);
                $wip->execute();
            break;

            case "Done";

                //$user_approval = "Completed"; // remove after the tutorial to employees
                $user_approval = "";
                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, checker=:checker, done_date=:done_date, user_approval=:user_approval where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':done_date', $date_log);
                $update_status->bindparam(':user_approval', $user_approval);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
                /*
                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, checker=:checker, done_date=:done_date where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':done_date', $date_log);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
                */
            break;

            case "Endorse to Checker";

                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, checker=:checker, done_date=:done_date where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':done_date', $date_log);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;

            case "Closed";

                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();


                $get_manhr  = $dbCon->prepare("Select * from srvcrqst where ic_no = :ic_no");
                $get_manhr->bindparam(':ic_no',$ic_no);
                $get_manhr->execute();

                if($get_manhr->rowCount() > 0){
                    while($row=$get_manhr->FETCH(PDO::FETCH_ASSOC)){

                        $acknowledged_date      = $row['acknowledged_date'];
                        $done_date              = $row['done_date'];

                    }
                }

                $date_time_plus_one     = strtotime($acknowledged_date . ' +8 hours');
                $excel_date_request     = floatval(25569 + $date_time_plus_one / 86400);
                $date_time_plus_two     = strtotime($done_date . ' +8 hours');
                $excel_date_done        = floatval(25569 + $date_time_plus_two / 86400);
                $response_time          = floatval(($excel_date_done - $excel_date_request) );
                $manhour                = number_format((float)$response_time, 2, '.', '');

                $update_status = $dbCon->prepare("Update srvcrqst set man_hour=:man_hour where ic_no=:ic_no ");
                $update_status->bindparam(':man_hour', $manhour);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();

            break;


            case "For Checking";

                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, ic_checker=:checker where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;

            case "Not Approve";

                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, ic_approver=:checker where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;

            case "For Approval";

                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status, ic_approver=:checker where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;

            case "New Request";

                $update_status = $dbCon->prepare("Update srvcrqst set ic_status=:ic_status where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();



            break;

            case "Rejected";

                $reject = "Work in Progress";

                $update_status = $dbCon->prepare("Update srvcrqst set user_approval=:ic_status, ic_status=:ic_wip where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':ic_wip', $reject);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;
            case "Completed";
                $update_status = $dbCon->prepare("Update srvcrqst set user_approval=:ic_status where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;
            case "Cancelled";
                $update_status = $dbCon->prepare("Update srvcrqst set user_approval=:ic_status, ic_status=:ic_status where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;

            case "MIS Checker";

                $update_status = $dbCon->prepare("Update srvcrqst set checker=:checker, ic_status=:ic_status where ic_no=:ic_no ");
                $update_status->bindparam(':ic_status', $status);
                $update_status->bindparam(':checker', $checker);
                $update_status->bindparam(':ic_no',$ic_no);
                $update_status->execute();
            break;

        }



    }


    public function editRequest($ic_no, $prcss, $request_date, $request_dtls, $tmp_path, $file_name){
        global $dbCon;

        $ic_year = "ic_".date("Y");

        if(!empty($file_name)){
            $dir_name = "attachments/".$ic_no;
            if(file_exists($dir_name)){
                $uploads_dir = "$dir_name";

                $upload_file = "";
                foreach($file_name as $key=>$val ){
                    $upload_file_path = $tmp_path[$key];
                    $upload_file_name = $file_name[$key];
                    move_uploaded_file($upload_file_path, "$uploads_dir/$upload_file_name");
                    $upload_file .= $uploads_dir."/".$upload_file_name.",";
                }
            }else{
                mkdir("$dir_name");
                $uploads_dir = "$dir_name";

                $upload_file = "";
                foreach($file_name as $key=>$val ){
                    $upload_file_path = $tmp_path[$key];
                    $upload_file_name = $file_name[$key];
                    move_uploaded_file($upload_file_path, "$uploads_dir/$upload_file_name");
                    $upload_file .= $uploads_dir."/".$upload_file_name.",";
                }
            }
        }else{

            $upload_file = "No attached file";

        }

        $edit_query     = $dbCon->prepare("Update srvcrqst set ic_rqst_date=:ic_rqst_date, ic_dtls=:ic_dtls, ic_attachment=:ic_attachment where ic_no=:ic_no");
        $edit_query->bindparam(':ic_no',$ic_no);
        $edit_query->bindparam(':ic_rqst_date',$request_date);
        $edit_query->bindparam(':ic_dtls',$request_dtls);
        $edit_query->bindparam(':ic_attachment',$upload_file);



        $edit_query->execute();

        echo"<script>
                    alert('Done');
                    window.location.back;
                </script>";

    }

    public function search($look_for,$prcss){
        global $dbCon;

        $ic_year    = "ic_".date("Y");

        $search_query = $dbCon->prepare("Select * from srvcrqst where (ic_no like :look_for or ic_dtls like :look_for) and prcss_no like :prcss");

        $look_for   = "%".$look_for."%";
        $prcss      = "%".$prcss."%";

        //echo $prcss;

        $search_query->bindparam(':look_for', $look_for);
        $search_query->bindparam(':prcss', $prcss);
        $search_query->execute();

        $this->srch_query = $search_query->rowCount();

    }
}


class workLog {

    public function addWorklog($ic_no, $date_log, $status, $update_message, $personnel, $endorse_to){
        global $dbCon;

        $add_query  = $dbCon->prepare("Insert into wrklg (ic_id, wrklg_date, wrklg_status, wrklg_dtls, wrklg_personnel, endorse_to)VALUES(:ic_id, :wrklg_date, :wrklg_status, :wrklg_dtls, :wrklg_personnel, :endorse_to)");
        $add_query->bindparam(':ic_id',$ic_no);
        $add_query->bindparam(':wrklg_date',$date_log);
        $add_query->bindparam(':wrklg_status',$status);
        $add_query->bindparam(':wrklg_dtls',$update_message);
        $add_query->bindparam(':wrklg_personnel',$personnel);
        $add_query->bindparam(':endorse_to',$endorse_to);
        $add_query->execute();


    }

    public function viewWorklogOld($ic_no){
        global $dbCon;

        $view_query = $dbCon->prepare("Select * from wrklg where ic_id=:ic_id order by wrklg_id DESC");
        $view_query->bindparam(':ic_id', $ic_no);
        $view_query->execute();

        $worklog = "";
        if($view_query->rowCount() > 0){

            while($row = $view_query->FETCH(PDO::FETCH_ASSOC)){
                if(!empty($row['wrklg_status'])){
                    $this->wrklg_status       = $row['wrklg_status'];
                }else{
                    $this->wrklg_status       = "No Status yet";
                }

                if(!empty($row['wrklg_dtls'])){
                    $this->wrklg_dtls         =   $row['wrklg_dtls'];
                }else{
                    $this->wrklg_dtls         = "No Status yet";
                }

                $this->wrklg_date         =   $row['wrklg_date'];;

                $this->wrklg_personnel    =   $row['wrklg_personnel'];

                $this->endorse_to         =   $row['endorse_to'];

                $worklog .= $this->wrklg_date."~".$this->wrklg_status."~".$this->wrklg_dtls."~".$this->wrklg_personnel."~".$this->endorse_to.";";
            }

            $this->worklog = $worklog;
        }else{
            $this->worklog = "";
        }

    }

}

class requestStatus{

    public function status($status){
        global $dbCon;

        $ic_year    = "ic_".date("Y");

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status");
        $view_query->bindparam(':ic_status',$status);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();
    }

    public function ahead($status,$prcss){
        global $dbCon;

        $ic_year    = "ic_".date("Y");
        $date_now   = date('y-m-d');

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and prcss_no like '%$prcss%' and ic_rqst_date > '$date_now'");
        $view_query->bindparam(':ic_status',$status);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();
    }

    public function ontime($status,$prcss){
        global $dbCon;

        $ic_year    = "ic_".date("Y");
        $date_now   = date('y-m-d');

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and prcss_no like '%$prcss%' and ic_rqst_date = $date_now");
        $view_query->bindparam(':ic_status',$status);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();
    }

    public function delay($status,$prcss){
        global $dbCon;

        $ic_year    = "ic_".date("Y");
        $date_now   = date('y-m-d');

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and prcss_no like '%$prcss%' and ic_rqst_date < '$date_now'");
        $view_query->bindparam(':ic_status',$status);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();
    }

    public function prcssStatus($status,$prcss){
        global $dbCon;

        $ic_year    = "ic_".date("Y");
        $date_now   = date('y-m-d');

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and prcss_no like '%$prcss%'");
        $view_query->bindparam(':ic_status',$status);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();

    }

    public function dstnctRqst($status,$prcss){
        global $dbCon;

        $view_query = $dbCon->prepare("Select distinct(ic_rqst) as Request , count(ic_rqst) as Count from srvcrqst where  prcss_no like '%$prcss%' and ic_status = :ic_status group by ic_rqst order by count desc");
        $view_query->bindparam(':ic_status',$status);
        $view_query->execute();

        if ($view_query->rowCount() > 0) {
            // code...
            $rqst       = array();

            for ($i=0; $i < $view_query->rowCount(); $i++) {
                // code...
                $row = $view_query->FETCH(PDO::FETCH_ASSOC);
                $rqst[] = array($row['Request'], $row['Count']);


            }


        }else{
            $rqst = 0;
        }
        $this->queryno = $rqst;
    }

}

class endorsedRequest{

    public function status($status, $personnel){
        global $dbCon;


        $ic_year    = "ic_".date("Y");
        switch($status){
          case "Done":
          $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and user_approval IN('Completed','Rejected') and assigned_to = :assigned_to order by ic_rqst_date DESC");
          break;

          default:
          $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and assigned_to = :assigned_to order by ic_rqst_date DESC");
          break;
        }

        $view_query->bindparam(':ic_status',$status);
        $view_query->bindparam(':assigned_to',$personnel);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();

    }
    public function misChecker($status, $personnel){
        global $dbCon;

        $ic_year    = "ic_".date("Y");

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and checker = :checker order by ic_rqst_date DESC");
        $view_query->bindparam(':ic_status',$status);
        $view_query->bindparam(':checker',$personnel);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();

    }
    public function forChecking($status, $personnel){
        global $dbCon;

        $ic_year    = "ic_".date("Y");

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and ic_checker = :checker order by ic_rqst_date DESC");
        $view_query->bindparam(':ic_status',$status);
        $view_query->bindparam(':checker',$personnel);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();

    }
    public function forApproval($status, $personnel){
        global $dbCon;

        $ic_year    = "ic_".date("Y");

        $view_query = $dbCon->prepare("Select * from srvcrqst where ic_status = :ic_status and ic_approver = :checker order by ic_rqst_date DESC");
        $view_query->bindparam(':ic_status',$status);
        $view_query->bindparam(':checker',$personnel);
        $view_query->execute();

        $this->queryno = $view_query->rowCount();

    }
}

class Report{

    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;

    private $dbh;
    private $error;

    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            //$this->dbh->exec("SET NAMES 'utf8';");
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }



    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null){

        if (is_null($type)) {
          switch (true) {
            case is_int($value):
              $type = PDO::PARAM_INT;
              break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
              break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
            default:
              $type = PDO::PARAM_STR;
          }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

}

class Employees{

    private $host      = DB_HOST_emp;
    private $user      = DB_USER_emp;
    private $pass      = DB_PASS_emp;
    private $dbname    = DB_NAME_emp;

    private $dbh;
    private $error;

    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }



    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null){

        if (is_null($type)) {
          switch (true) {
            case is_int($value):
              $type = PDO::PARAM_INT;
              break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
              break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
            default:
              $type = PDO::PARAM_STR;
          }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

}

?>
