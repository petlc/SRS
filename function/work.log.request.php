<?php

if(isset($_POST['submit_worklog'])){

    $ic_no                  = $_POST['ic_no'];
    $prcss                  = $_POST['prcss'];
    $personnel              = $_POST['personnel'];
    $status                 = $_POST['status'];
    $date_log               = $_POST['date_log'];
    $worklog_message        = $_POST['worklog_message'];

    addWorklog($ic_no, $date_log, $status, $worklog_message, $personnel,"");
    //addWorklog($ic_no, $date_log, $status, $worklog_message, $personnel, "");
}



function addWorklog($ic_no, $date_log, $status, $update_message, $personnel, $endorse_to){

    $add_log = new Report();

    $add_log->query("Insert into wrklg (ic_id, wrklg_date, wrklg_status, wrklg_dtls, wrklg_personnel, endorse_to)VALUES(:ic_id, :wrklg_date, :wrklg_status, :wrklg_dtls, :wrklg_personnel, :endorse_to)");
    $add_log->bind(':ic_id',$ic_no);
    $add_log->bind(':wrklg_date',$date_log);
    $add_log->bind(':wrklg_status',$status);
    $add_log->bind(':wrklg_dtls',$update_message);
    $add_log->bind(':wrklg_personnel',$personnel);
    $add_log->bind(':endorse_to',$endorse_to);
    $add_log->execute();


}


function updateWorklog($ic_no){

    $update_log = new Report();

    $update_log->query("Select Max(wrklg_id) from wrklg where ic_id = :ic_id");
    $update_log->bind(':ic_id',$ic_no);
    $update_log->execute();

    if ($update_log->rowCount() > 0) {
        // code...
        $row = $update_log->single();
    }

    $update_log->query("Update wrklg set wrklg_seen = '1'");
    $update_log->execute();

}

function viewWorklog($ic_no){

    $view_query = new Report();

    $view_query->query("Select * from wrklg where ic_id=:ic_id order by wrklg_id DESC");
    $view_query->bind(':ic_id',$ic_no);
    $view_query->execute();

    if($view_query->rowCount() > 0){

        $row = $view_query->resultset();

        foreach ($row as $rowDtls) {
            // code...
            //echo $rowDtls['wrklg_dtls']."<br>";

            if(!empty($rowDtls['wrklg_status'])){
                $wrklg_status       = $rowDtls['wrklg_status'];
            }else{
                $wrklg_status       = "No Status yet";
            }

            if(!empty($rowDtls['wrklg_dtls'])){
                $wrklg_dtls         =   $rowDtls['wrklg_dtls'];
            }else{
                $wrklg_dtls         = "No Status yet";
            }

            $wrklg_date         =   $rowDtls['wrklg_date'];;

            $wrklg_personnel    =   $rowDtls['wrklg_personnel'];

            $endorse_to         =   $rowDtls['endorse_to'];

            //$worklog .= $wrklg_date."~".$wrklg_status."~".$wrklg_dtls."~".$wrklg_personnel."~".$endorse_to.";";

            $worklog[] = array( $wrklg_date, $wrklg_status, $wrklg_dtls, $wrklg_personnel, $endorse_to);
        }

        return $worklog;
    }

}

/**
 *
 */
class WorkLog_re {

    private $conn;
    private $table_name = "wrklg";

    public $id;
    public $ic_no;
    public $date_log;
    public $status;
    public $worklog_message;
    public $personnel;
    public $endorse_to;

    public function __construct($db){
        // code...
        $this->conn = $db;
    }

    function addWorklog(){

        $query = "Insert into ".$this->table_name." (ic_id, wrklg_date, wrklg_status, wrklg_dtls, wrklg_personnel, endorse_to)VALUES(:ic_id, :wrklg_date, :wrklg_status, :wrklg_dtls, :wrklg_personnel, :endorse_to)";

        $stmnt = $this->conn->prepare($query);

        $this->ic_no = htmlspecialchars(strip_tags($this->ic_no));
        $this->date_log = htmlspecialchars(strip_tags($this->date_log));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->update_message = htmlspecialchars(strip_tags($this->worklog_message));
        $this->personnel = htmlspecialchars(strip_tags($this->personnel));
        $this->endorse_to = htmlspecialchars(strip_tags($this->endorse_to));

        $stmnt->bindParam(":ic_id", $this->ic_no);
        $stmnt->bindParam(":wrklg_date", $this->date_log);
        $stmnt->bindParam(":wrklg_status", $this->status);
        $stmnt->bindParam(":wrklg_dtls", $this->worklog_message);
        $stmnt->bindParam(":wrklg_personnel", $this->personnel);
        $stmnt->bindParam(":endorse_to", $this->endorse_to);

        if ($stmnt->execute()) {
            // code...
            $this->id = $this->conn->lastInsertId();
            return true;
        }else {
            // code...
            return false;
        }
    }
}

 ?>
